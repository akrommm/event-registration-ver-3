<?php

namespace App\Models\Admin;

use App\Models\ModelAuthenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pengumuman extends ModelAuthenticate
{
    use HasFactory;

    protected $table = "pengumuman";
    protected $fillable = [
        'judul_pesan',
        'tanggal',
        'pesan',
    ];

    public function getTanggalStringAttribute()
    {
        return Carbon::parse($this->attributes['tanggal'])->translatedFormat('l, d F Y');
    }
}
