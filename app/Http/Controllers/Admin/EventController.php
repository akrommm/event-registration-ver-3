<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use App\Models\Admin\Registration;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Ulasan;
use App\Models\Admin\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        $peserta = Registration::where('id_event', $event->id)
            ->where('role', 'Peserta')
            ->get();
        $terdaftar = Registration::where('id_event', $event->id)->where('role', 'Peserta')->count();
        // Peserta hadir (checked tidak null)
        $hadir = Registration::where('id_event', $event->id)
            ->where('role', 'Peserta')
            ->whereNotNull('checked')
            ->count();

        // Peserta tidak hadir (checked null)
        $tidakHadir = Registration::where('id_event', $event->id)
            ->where('role', 'Peserta')
            ->whereNull('checked')
            ->count();
        return view('admin.event.show', compact('event', 'peserta', 'terdaftar', 'hadir', 'tidakHadir'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'waktu' => 'required',
            'gambar' => 'image|mimes:png,jpg,jpeg|max:5120',
            'status' => 'required',
            'tempat' => 'required',
        ], [
            'nama.required' => 'Nama Event Harus Diisi',
            'nama.string' => 'Nama Event Harus Berupa Kalimat',
            'nama.max' => 'Nama Event Maksimal 255 Karakter',
            'deskripsi.required' => 'Deskripsi Harus Diisi',
            'waktu.required' => 'Waktu Harus Dipilih',
            'waktu.integer' => 'Waktu Harus Dipilih',
            'gambar.image' => 'Gambar Harus Berupa Image',
            'gambar.mimes' => 'Gambar Harus Berekstensi png, jpg, atau jpeg',
            'gambar.max' => 'Gambar Tidak Boleh Lebih Dari 5 MB',
            'status.required' => 'Status Event Harus Diisi',
            'tempat.required' => 'Tempat Event Harus Diisi',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $event = new Event();
        $event->nama = request('nama');
        $event->waktu = request('waktu');
        $event->tempat = request('tempat');
        $event->status = request('status');
        $event->deskripsi = request('deskripsi');
        $event->save();

        $event->handleUploadImg();

        return redirect('admin/event')->with('success', 'Event Berhasil Ditambahkan');
    }

    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'waktu' => 'required',
            'gambar' => 'image|mimes:png,jpg,jpeg|max:5120',
            'tempat' => 'required',
        ], [
            'nama.required' => 'Nama Event Harus Diisi',
            'nama.string' => 'Nama Event Harus Berupa Kalimat',
            'nama.max' => 'Nama Event Maksimal 255 Karakter',
            'deskripsi.required' => 'Deskripsi Harus Diisi',
            'waktu.required' => 'Waktu Harus Dipilih',
            'waktu.integer' => 'Waktu Harus Dipilih',
            'gambar.image' => 'Gambar Harus Berupa Image',
            'gambar.mimes' => 'Gambar Harus Berekstensi png, jpg, atau jpeg',
            'gambar.max' => 'Gambar Tidak Boleh Lebih Dari 5 MB',
            'tempat.required' => 'Tempat Event Harus Diisi',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $event = Event::find($id);
        if (request('nama')) $event->nama = request('nama');
        if (request('waktu')) $event->waktu = request('waktu');
        if (request('tempat')) $event->tempat = request('tempat');
        if (request('status')) $event->status = request('status');
        if (request('deskripsi')) $event->deskripsi = request('deskripsi');
        $event->save();

        if (request('gambar')) $event->handleUploadImg();

        return redirect('admin/event')->with('success', 'Event Berhasil di Edit');
    }

    function destroy($id)
    {
        $event = Event::find($id);

        $peserta = $event->registration;

        foreach ($peserta as $participant) {
            // Periksa apakah file QR code ada
            if ($participant->qr_code) {
                $path = public_path($participant->qr_code);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        $event->handleDeleteImg();

        $event->delete();

        return redirect('admin/event')->with('danger', 'Event Berhasil Dihapus');
    }
}
