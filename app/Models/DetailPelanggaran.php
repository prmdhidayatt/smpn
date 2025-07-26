<?php
// app/Models/DetailPelanggaran.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisPelanggaran;

class DetailPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'tb_detailpelanggaran';
    protected $primaryKey = 'id_detail';
    // protected $fillable = [
    //     'id_kasus', 'id_jenispelanggaran','tanggal','bukti'
    // ];
    protected $fillable = [
        'id_kasus', 
        'id_jenispelanggaran', 
        'tanggal', 
        'bukti',
    ];
    

    public function kasusPelanggaran()
    {
        return $this->belongsTo(KasusPelanggaran::class, 'id_kasus', 'id_kasus');
    }

    // public function jenisPelanggaran()
    // {
    //     return $this->belongsTo(JenisPelanggaran::class, 'id_jenispelanggaran', 'id_jenispelanggaran');
    // }
    public function jenis_pelanggaran()
    {
        return $this->belongsTo(JenisPelanggaran::class, 'id_jenispelanggaran', 'id_jenispelanggaran');
    }

    

    
}
