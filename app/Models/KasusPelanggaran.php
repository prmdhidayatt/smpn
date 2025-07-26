<?php
// app/Models/KasusPelanggaran.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPelanggaran;
class KasusPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'tb_kasuspelangaran';
    protected $primaryKey = 'id_kasus';
    // protected $fillable = [
    //     'id', 'id_siswa', 'tahun_ajaran', 'total_poin'
    // ];
    protected $fillable = [
        'id_siswa',
        'tahun_ajaran',
        'id',
        'total_poin',
        
    ];


    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function detailPelanggaran()
    {
        return $this->hasMany(DetailPelanggaran::class, 'id_kasus', 'id_kasus');
    }

    public function details()
    {
        return $this->hasMany(DetailPelanggaran::class, 'id_kasus');
    }

    public function detailstombol()
    {
        return $this->hasMany(DetailPelanggaran::class, 'id_jenispelanggaran');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

}
