<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use App\Models\Admin\Pengumuman;
use App\Models\Admin\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::all();
        $list_event = Event::where('status', 1)->get();
        return view('admin.pengumuman.index', compact('pengumuman', 'list_event'));
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'judul_pesan' => 'required|string',
            'pesan' => 'required|string',
            'id_event' => 'required', // Pastikan id_event dikirim dari form
        ]);

        $pesan = $request->input('pesan');

        // Ambil semua peserta dari event tertentu
        $peserta = Registration::where('id_event', $request->id_event)->get();

        $phoneNumbers = [];

        foreach ($peserta as $item) {
            $phoneNumber = $item->no_hp;
            $phoneNumbers[] = $phoneNumber;

            // Kirim pesan WhatsApp
            $this->sendWhatsAppMessage($phoneNumber, $pesan);
        }

        $pengumuman = new Pengumuman();
        $pengumuman->judul_pesan = $request->judul_pesan;
        $pengumuman->tanggal = now();
        $pengumuman->pesan = $pesan;
        $pengumuman->save();

        return redirect('admin/pengumuman')->with('success', 'Pengumuman Berhasil Dikirim');
    }

    public function sendWhatsAppMessage($phoneNumber, $message)
    {
        $token = "drUesCtgAo9UQcnqYUkv";
        $target = "$phoneNumber";

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
                'target' => $target,
                'message' => $message,
                'delay' => '5-10',
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            Log::error('Error sending WhatsApp message: ' . $error_msg);
            // Tampilkan pesan error kepada pengguna atau lakukan tindakan lain sesuai kebutuhan aplikasi Anda
        }
        curl_close($curl);

        // Jika tidak ada kesalahan, tidak perlu melakukan apa pun karena pesan sudah berhasil dikirim

        return $response; // Mengembalikan respons dari API WhatsApp
    }

    function destroy($id)
    {
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();

        return back()->with('danger', 'Data Berhasil Dihapus');
    }
}
