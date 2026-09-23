<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = ['nama', 'nis_nip', 'alamat', 'no_hp'];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
