<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Registration; // Menambahkan model Registration
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CheckInController extends Controller
{
    // Halaman check-in yang menampilkan QR Code scanner
    public function index()
    {
        return view('admin.check-in.index');
    }

    // Validasi check-in peserta berdasarkan QR Code
    public function validateCheckIn(Request $request)
    {
        $participantId = $request->input('participant_id');

        // Cari data peserta berdasarkan ID
        $registration = Registration::where('id_peserta', $participantId)->first();

        if ($registration) {
            // Cek apakah peserta sudah check-in
            if ($registration->checked !== null) {
                session()->flash('danger', 'Peserta dengan ID ini sudah check-in sebelumnya!');
                // return response()->json([
                //     'success' => false,
                //     'message' => 'Peserta dengan ID ini sudah check-in sebelumnya!',
                // ]);
            }

            // Jika belum check-in, proses check-in
            $registration->update(['checked' => now()]);
            session()->flash('success', 'Check-in berhasil!');
            return response()->json([
                'success' => true,
                'message' => 'Check-in berhasil!',
                'data' => $registration,
            ]);
        } else {
            // Jika peserta tidak ditemukan
            session()->flash('danger', 'Peserta tidak ditemukan!');
            // return response()->json([
            //     'success' => false,
            //     'message' => 'Peserta tidak ditemukan!',
            // ]);
        }
    }

    public function getParticipant($id_peserta)
    {
        $participant = Registration::where('id_peserta', $id_peserta)->first();

        if ($participant) {
            return response()->json(
                [
                    'success' => true,
                    "message" => "getData success",
                    "data" => [
                        "id" => $participant->id,
                        "id_event" => $participant->id_event,
                        "id_peserta" => $participant->id_peserta,
                        "nama_peserta" => $participant->nama_peserta,
                        "no_hp" => $participant->no_hp,
                        "photo" => $participant->photo,
                        "role" => $participant->role,
                        "qr_code" => $participant->qr_code,
                        "checked" => $participant->checked,
                        "created_at" => $participant->created_at,
                        "updated_at" => $participant->updated_at,
                    ]
                ],
                200
            );
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Peserta tidak ditemukan'
            ]);
        }
    }
}
