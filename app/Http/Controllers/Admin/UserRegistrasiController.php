<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use App\Models\Admin\Logo;
use App\Models\Admin\Registration;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserRegistrasiController extends Controller
{
    function index()
    {
        $list_event = Event::where('status', 1)->paginate(6);
        return view('user.registrasi.index', compact('list_event'));
    }

    public function show($slug)
    {
        // Mencari artikel berdasarkan slug
        $event = Event::where('slug', $slug)->firstOrFail();

        // Mengembalikan view dengan artikel yang ditemukan
        return view('user.registrasi.show', compact('event'));
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

        // Cek apakah nama dan no_hp sudah terdaftar pada event yang sama
        $isExist = Registration::where('id_event', $request->id_event)
            ->where('nama_peserta', $request->nama)
            ->exists();

        if ($isExist) {
            return redirect()->back()
                ->withErrors(['nama' => 'Peserta dengan nama ini sudah terdaftar di event ini.'])
                ->withInput();
        }

        $isExist = Registration::where('id_event', $request->id_event)
            ->where('no_hp', $request->no_hp)
            ->exists();

        if ($isExist) {
            return redirect()->back()
                ->withErrors(['no_hp' => 'Peserta dengan nomor whatapps ini sudah terdaftar di event ini.'])
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

        // Kirim Pesan WhatsApp ke peserta
        $pesanWA = "*📢 Pendaftaran Berhasil!*\n\n" .
            "*Nama:* {$registration->nama_peserta}\n" .
            "*ID Peserta:* {$registration->id_peserta}\n" .
            "*Event:* " . Event::find($request->id_event)->nama . "\n\n" .
            "Simpan pesan ini sebagai bukti pendaftaran.\n\n" .
            "Terima kasih 🙏";

        $this->sendWhatsAppMessage($this->convertToIndonesianPhoneNumber($registration->no_hp), $pesanWA);

        // Redirect ke halaman sukses dengan ID registrasi
        return redirect()->route('user.registrasi.success', ['id' => $registration->id])
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

    public function sendWhatsAppMessage($phoneNumber, $message)
    {
        $token = "drUesCtgAo9UQcnqYUkv";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $phoneNumber,
                'message' => $message,
                'delay' => '3-7',
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            Log::error('Error sending WhatsApp message: ' . curl_error($curl));
        } else {
            $result = json_decode($response, true);
            if (!isset($result['status']) || $result['status'] != true) {
                Log::error('Gagal kirim WA: ' . $response);
            }
        }

        curl_close($curl);
    }

    public function convertToIndonesianPhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        }

        return $phoneNumber;
    }


    public function success($id)
    {
        // Mengambil data registrasi berdasarkan ID yang diterima dari URL
        $registration = Registration::findOrFail($id);

        // Mengirimkan data registrasi ke view
        return view('user.registrasi.success', compact('registration'));
    }


    public function downloadIdCard($id)
    {
        // Ambil data registrasi berdasarkan ID
        $registration = Registration::find($id);
        $logo = Logo::latest()->first();

        return view('admin.pdf.idcard', compact('registration', 'logo'));
    }
}
