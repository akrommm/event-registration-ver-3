<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use App\Models\Admin\Logo;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Log;

class RegistrasiController extends Controller
{
    function index()
    {
        $list_event = Event::where('status', 1)->get();
        return view('admin.registrasi.index', compact('list_event'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'photo' => 'required|image|max:2048',
            'id_event' => 'required',
        ], [
            'nama.required' => 'Nama Harus Diisi',
            'nama.string' => 'Nama Harus Berupa Kalimat',
            'nama.max' => 'Nama Maksimal 255 Karakter',
            'photo.image' => 'Gambar Harus Berupa Image',
            'photo.mimes' => 'Gambar Harus Berekstensi png, jpg, atau jpeg',
            'photo.max' => 'Gambar Tidak Boleh Lebih Dari 2 MB',
            'no_hp.required' => 'No Handphone Harus Diisi',
            'no_hp.max' => 'No Handphone Maksimal 15 Karakter',
            'id_event.required' => 'Event Harus Dipilih',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan foto peserta di folder 'public/participants'
        $photoPath = $request->file('photo')->store('participants', 'public');

        do {
            $participantId = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $isUnique = !Registration::where('id_peserta', $participantId)->exists();
        } while (!$isUnique);

        // Gunakan QRCodeGenerator untuk membuat QR Code
        $qrCodeFileName = Str::uuid() . '.png';
        $qrCodeFilePath = $this->generateQRCode($participantId, $qrCodeFileName);

        // Simpan data registrasi peserta ke database tanpa menyertakan foto
        $registration = new Registration();
        $registration->id_event = $request->id_event;
        $registration->id_peserta = $participantId;
        $registration->nama_peserta = $request->nama;
        $registration->no_hp = $request->no_hp;
        $registration->role = 'Peserta';
        $registration->qr_code = 'app/QR/' . $qrCodeFileName;

        // Simpan data registrasi dan upload foto menggunakan handleUploadImg
        $registration->save();  // Simpan data peserta terlebih dahulu
        $registration->handleUploadImg();  // Upload foto setelah data peserta disimpan

        // Redirect ke halaman sukses dengan ID registrasi
        return redirect()->route('admin.registrasi.success', ['id' => $registration->id])
            ->with('success', 'Registrasi Berhasil');
    }

    public function generateQRCode($data, $fileName)
    {
        // Build QR code
        $builder = new Builder(
            writer: new PngWriter(),
            writerOptions: [],
            validateResult: false,
            data: $data,  // Data for QR code
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,  // High error correction
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin
        );

        // Build the QR code
        $result = $builder->build();

        // Define the path to save the QR code
        $qrCodeFilePath = public_path('app/QR/' . $fileName);

        // Ensure the directory exists
        if (!file_exists(public_path('app/QR'))) {
            mkdir(public_path('app/QR'), 0775, true);
        }

        // Save the QR code to a file
        file_put_contents($qrCodeFilePath, $result->getString());

        return $qrCodeFilePath;
    }

    public function success($id)
    {
        // Mengambil data registrasi berdasarkan ID yang diterima dari URL
        $registration = Registration::findOrFail($id);

        // Mengirimkan data registrasi ke view
        return view('admin.registrasi.success', compact('registration'));
    }


    public function downloadIdCard($id)
    {
        // Ambil data registrasi berdasarkan ID
        $registration = Registration::find($id);
        $logo = Logo::latest()->first();

        return view('admin.pdf.idcard', compact('registration', 'logo'));
    }

    public function exportPDF($id)
    {
        $event = Event::find($id);
        // Ambil semua data peserta
        $peserta = Registration::where('id_event', $event->id)
            ->where('role', 'Peserta')
            ->get();


        return view('admin.pdf.export-peserta-pdf', compact('event', 'peserta'));
    }

    public function deletePeserta($id)
    {
        $peserta = Registration::find($id);
        $peserta->handleDeleteImg();
        $peserta->handleDeleteQR();
        $peserta->delete();

        return back()->with('danger', 'Data Berhasil Dihapus');
    }
}
