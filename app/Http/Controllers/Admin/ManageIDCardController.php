<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use App\Models\Admin\Registration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Str;

class ManageIDCardController extends Controller
{
    public function index()
    {
        $list_event = Event::where('status', 1)->get();
        $peserta = Registration::where('role', '!=', 'Peserta')->get();
        return view('admin.manage-idcard.index', compact('list_event', 'peserta'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_event' => 'required',
            'role' => 'required',
        ], [

            'id_event.required' => 'Event Harus Dipilih',
            'role.required' => 'Role Harus Dipilih',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

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
        $registration->role = $request->role;
        $registration->qr_code = 'app/QR/' . $qrCodeFileName;

        // Simpan data registrasi dan upload foto menggunakan handleUploadImg
        $registration->save();  // Simpan data peserta terlebih dahulu

        // Redirect ke halaman sukses dengan ID registrasi
        return redirect()->route('admin.manage-idcard.success', ['id' => $registration->id])
            ->with('success', 'Pembuatan ID card Berhasil');
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
        return view('admin.manage-idcard.success', compact('registration'));
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
