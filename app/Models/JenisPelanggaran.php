<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPelanggaran extends Model
{
    use HasFactory;
    protected $table = 'tb_jenispelanggaran';
    protected $primaryKey = 'id_jenispelanggaran';
    public $timestamps = true;

    protected $fillable = [
        'nama_pelanggaran',
        'kategori',
        'poin',
        'sanksi'
    ];
    // public function jenis_pelanggaran()
    // {
    //     return $this->belongsTo(JenisPelanggaran::class, 'id_jenispelanggaran');
    // }
    public function jenis_pelanggaran()
    {
        return $this->belongsTo(JenisPelanggaran::class, 'id_jenispelanggaran');
    }

}
