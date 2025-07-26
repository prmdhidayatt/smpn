<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walikelas extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'tb_walikelas';

    // Define the primary key column if it's not the default 'id'
    protected $primaryKey = 'id_walikelas';

    // Disable auto-incrementing if needed (not applicable in this case)
    public $incrementing = true;

    // Define the fillable fields

    protected $fillable = [
        'nip_walikelas',
        'nama_walikelas',
        'jabatan',
        'jk_walikelas',
        'tahun_ajaran',
        'id_kelas',
    ];

    // Define the relationship with the Kelas model
    // public function kelas()
    // {
    //     return $this->hasMany(Kelas::class, 'id_walikelas', 'id_walikelas');
    // }

    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
