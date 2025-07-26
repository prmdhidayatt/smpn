<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'tb_siswa';

    // Define the primary key column if it's not the default 'id'
    protected $primaryKey = 'id_siswa';

    // Disable auto-incrementing if needed (not applicable in this case)
    public $incrementing = true;

    // Define the fillable fields
    protected $fillable = [
        'nisn',
        'nama_siswa',
        'jk_siswa',
        'id_kelas',
        'alamat',
        'tahun_ajaran',
    ];

    // Define the relationship with the Kelas model
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function wali()
    {
        return $this->hasOne(Wali::class, 'id_siswa');
    }

    public function kasusPelanggaran()
    {
        return $this->hasMany(KasusPelanggaran::class, 'id_siswa');
    }
}
