<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    // Menentukan nama tabel jika tidak sesuai dengan konvensi penamaan
    protected $table = 'tb_tahunajaran';

    // Menentukan primary key yang bukan 'id'
    protected $primaryKey = 'id_tahunajaran';

    // Menentukan atribut yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama',
        'status'
    ];

    // Menentukan atribut yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Jika menggunakan timestamps, uncomment baris berikut
    // public $timestamps = true;
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_tahunajaran');
    }
}
