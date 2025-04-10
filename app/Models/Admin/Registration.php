<?php

namespace App\Models\Admin;

use App\Models\ModelAuthenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Registration extends ModelAuthenticate
{
    use HasFactory;

    protected $table = 'registrasi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_peserta',
        'photo',
        'no_hp',
        'id_event',
        'qr_code',
        'id_peserta',
        'checked',
        'role'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'id_event', 'id');
    }

    function handleUploadImg()
    {
        $this->handleDeleteImg();
        if (request()->hasFile('photo')) {
            $photo = request()->file('photo');
            $destination = "assets/img/registration";
            $randomStr = Str::random(5);
            $filename = $this->id . "-" . time() . "-" . $randomStr . "." . $photo->extension();
            $url = $photo->storeAs($destination, $filename);
            $this->photo = "app/" . $url;
            $this->save();
        }
    }

    function handleDeleteImg()
    {
        $photo = $this->photo;
        if ($photo) {
            $path = public_path($photo);
            if (file_exists($path)) {
                unlink($path);
            }
            return true;
        }
    }

    function handleDeleteQR()
    {
        $qr_code = $this->qr_code;
        if ($qr_code) {
            $path = public_path($qr_code);
            if (file_exists($path)) {
                unlink($path);
            }
            return true;
        }
    }
}
