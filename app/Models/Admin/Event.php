<?php

namespace App\Models\Admin;

use App\Models\ModelAuthenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends ModelAuthenticate
{
    use HasFactory;

    protected $table = 'event';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'waktu',
        'status',
        'gambar'
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];


    function handleUploadImg()
    {
        $this->handleDeleteImg();
        if (request()->hasFile('gambar')) {
            $gambar = request()->file('gambar');
            $destination = "assets/img/event";
            $randomStr = Str::random(5);
            $filename = $this->id . "-" . time() . "-" . $randomStr . "." . $gambar->extension();
            $url = $gambar->storeAs($destination, $filename);
            $this->gambar = "app/" . $url;
            $this->save();
        }
    }

    function handleDeleteImg()
    {
        $gambar = $this->gambar;
        if ($gambar) {
            $path = public_path($gambar);
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

    public function registration(): HasMany
    {
        return $this->hasMany(Registration::class, 'id_event', 'id');
    }
}
