<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'tb_kelas';

    // Define the primary key column if it's not the default 'id'
    protected $primaryKey = 'id_kelas';

    // Disable auto-incrementing if needed (not applicable in this case)
    public $incrementing = true;

    // Define the fillable fields
    protected $fillable = [
        'nama_kelas',
        'id_walikelas',
        'id_tahunajaran',
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahunajaran');
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id_kelas');
    }


    public function walikelas()
    {
        return $this->hasMany(Walikelas::class, 'id_kelas');
    }
}
