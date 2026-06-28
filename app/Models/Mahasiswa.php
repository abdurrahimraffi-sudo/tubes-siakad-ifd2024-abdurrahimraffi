<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'email',
        'no_hp',
        'alamat',
        'semester',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    public function totalSks()
    {
        return $this->krs()
            ->with('jadwal.mataKuliah')
            ->get()
            ->sum(fn ($krs) => $krs->jadwal->mataKuliah->sks ?? 0);
    }
}
