<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    protected $table = 'tb_kasuspelangaran'; // <- ini penting

    protected $primaryKey = 'id_kasus';

    protected $fillable = [
        'id',
        'id_siswa',
        'tahun_ajaran',
        'total_poin',
        'created_at',
        'updated_at'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function details()
    {
        return $this->hasMany(DetailPelanggaran::class, 'id_kasus');
    }
    // Tambahkan relasi jika ada tabel detail kasus, dll.

}
