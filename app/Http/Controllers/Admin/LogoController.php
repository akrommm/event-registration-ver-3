<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogoController extends Controller
{
    public function index()
    {
        $logo = Logo::all();
        return view('admin.logo.index', compact('logo'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'image|mimes:png,jpg,jpeg|max:5120',
            'logo_event' => 'image|mimes:png,jpg,jpeg|max:5120',
            'background' => 'image|mimes:png,jpg,jpeg|max:5120',
        ], [
            'logo.image' => 'Logo Harus Berupa Image',
            'logo.mimes' => 'Logo Harus Berekstensi png, jpg, atau jpeg',
            'logo.max' => 'Logo Tidak Boleh Lebih Dari 5 MB',
            'logo_event.image' => 'Logo Event Harus Berupa Image',
            'logo_event.mimes' => 'Logo Event Harus Berekstensi png, jpg, atau jpeg',
            'logo_event.max' => 'Logo Event Tidak Boleh Lebih Dari 5 MB',
            'background.image' => 'Background Harus Berupa Image',
            'background.mimes' => 'Background Harus Berekstensi png, jpg, atau jpeg',
            'background.max' => 'Background Tidak Boleh Lebih Dari 5 MB',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $logo = new Logo();
        $logo->save();

        $logo->handleUploadLogo();
        $logo->handleUploadLogoEvent();
        $logo->handleUploadBackground();

        return redirect('admin/logo-idcard')->with('success', 'Logo Berhasil Ditambahkan');
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'image|mimes:png,jpg,jpeg|max:5120',
            'logo_event' => 'image|mimes:png,jpg,jpeg|max:5120',
            'background' => 'image|mimes:png,jpg,jpeg|max:5120',
        ], [
            'logo.image' => 'Logo Harus Berupa Image',
            'logo.mimes' => 'Logo Harus Berekstensi png, jpg, atau jpeg',
            'logo.max' => 'Logo Tidak Boleh Lebih Dari 5 MB',
            'logo_event.image' => 'Logo Event Harus Berupa Image',
            'logo_event.mimes' => 'Logo Event Harus Berekstensi png, jpg, atau jpeg',
            'logo_event.max' => 'Logo Event Tidak Boleh Lebih Dari 5 MB',
            'background.image' => 'Background Harus Berupa Image',
            'background.mimes' => 'Background Harus Berekstensi png, jpg, atau jpeg',
            'background.max' => 'Background Tidak Boleh Lebih Dari 5 MB',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        $logo = Logo::find($id);
        $logo->save();

        if (request('logo')) $logo->handleUploadLogo();
        if (request('logo_event')) $logo->handleUploadLogoEvent();
        if (request('background')) $logo->handleUploadBackground();

        return redirect('admin/logo-idcard')->with('success', 'Logo Berhasil di Edit');
    }

    function destroy($id)
    {
        $logo = Logo::find($id);

        $logo->handleDeleteLogo();
        $logo->handleDeleteLogoEvent();
        $logo->handleDeleteBackground();

        $logo->delete();

        return redirect('admin/logo-idcard')->with('danger', 'Logo Berhasil Dihapus');
    }
}
