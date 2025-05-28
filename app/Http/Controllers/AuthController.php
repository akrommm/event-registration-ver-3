<?php

namespace App\Http\Controllers;

use illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    function showRegis()
    {
        return view('auth.regis');
    }

    public function loginProcess()
    {
        $credential = [
            'email' => request('email'),
            'password' => request('password')
        ];

        if (auth()->attempt($credential)) {
            $user = auth()->user();
            if ($user->type == 'ADMIN') {
                return redirect('admin/dashboard')->with('success', 'Login Berhasil');
            } else {
                return redirect('beranda')->with('success', 'Login Berhasil');
            }
        } else {
            return back()->with('danger', 'Login Gagal, Silahkan Cek Email dan Password');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect('login');
    }
}
