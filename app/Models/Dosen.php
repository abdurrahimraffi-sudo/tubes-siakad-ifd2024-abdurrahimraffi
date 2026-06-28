<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'nidn',
        'nama_dosen',
        'email',
        'no_hp',
        'alamat',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
