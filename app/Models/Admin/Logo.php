<?php

namespace App\Models\Admin;

use App\Models\ModelAuthenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Logo extends ModelAuthenticate
{
    use HasFactory;

    protected $table = 'logo';
    protected $primaryKey = 'id';

    protected $fillable = [
        'logo',
        'logo_event',
        'background'
    ];

    function handleUploadLogo()
    {
        $this->handleDeleteLogo();
        if (request()->hasFile('logo')) {
            $logo = request()->file('logo');
            $destination = "assets/img/logo";
            $randomStr = Str::random(5);
            $filename = $this->id . "-" . time() . "-" . $randomStr . "." . $logo->extension();
            $url = $logo->storeAs($destination, $filename);
            $this->logo = "app/" . $url;
            $this->save();
        }
    }

    function handleDeleteLogo()
    {
        $logo = $this->logo;
        if ($logo) {
            $path = public_path($logo);
            if (file_exists($path)) {
                unlink($path);
            }
            return true;
        }
    }

    function handleUploadLogoEvent()
    {
        $this->handleDeleteLogoEvent();
        if (request()->hasFile('logo_event')) {
            $logo_event = request()->file('logo_event');
            $destination = "assets/img/logo";
            $randomStr = Str::random(5);
            $filename = $this->id . "-" . time() . "-" . $randomStr . "." . $logo_event->extension();
            $url = $logo_event->storeAs($destination, $filename);
            $this->logo_event = "app/" . $url;
            $this->save();
        }
    }

    function handleDeleteLogoEvent()
    {
        $logo_event = $this->logo_event;
        if ($logo_event) {
            $path = public_path($logo_event);
            if (file_exists($path)) {
                unlink($path);
            }
            return true;
        }
    }

    function handleUploadBackground()
    {
        $this->handleDeleteBackground();
        if (request()->hasFile('background')) {
            $background = request()->file('background');
            $destination = "assets/img/logo";
            $randomStr = Str::random(5);
            $filename = $this->id . "-" . time() . "-" . $randomStr . "." . $background->extension();
            $url = $background->storeAs($destination, $filename);
            $this->background = "app/" . $url;
            $this->save();
        }
    }

    function handleDeleteBackground()
    {
        $background = $this->background;
        if ($background) {
            $path = public_path($background);
            if (file_exists($path)) {
                unlink($path);
            }
            return true;
        }
    }
}
