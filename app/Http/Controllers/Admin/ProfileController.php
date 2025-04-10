<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $data['user'] = Auth::user();
        return view('admin.profile.index', $data);
    }

    public function edit($id)
    {
        return view('admin.profile.edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|regex:/^[\pL\s\-]+$/u',
            'email' => 'email',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'email.email' => 'Alamat email tidak valid.',
            'name.regex' => 'Kolom nama hanya boleh mengandung huruf, spasi, dan tanda hubung.',
            'name.string' => 'Kolom nama harus huruf semua',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Avatar harus dalam format JPEG, PNG, JPG, atau GIF.',
            'avatar.max' => 'Avatar Maksimal 2 MB'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($id);
        if (request('nama')) $user->nama = request('nama');
        if (request('username')) $user->username = request('username');
        if (request('email')) $user->email = request('email');
        if (request('password')) $user->password = request('password');
        $user->save();
        if (request('foto')) $user->handleUploadFoto();

        return redirect('admin/profile')->with('success', 'Profile Berhasil di Edit');
    }
}
