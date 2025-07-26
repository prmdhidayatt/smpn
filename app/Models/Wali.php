<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    use HasFactory;

    protected $table = 'tb_wali';

    // Define the primary key column if it's not the default 'id'
    protected $primaryKey = 'id_wali';

    // Disable auto-incrementing if needed (not applicable in this case)
    public $incrementing = true;


    protected $fillable = [
        'id_siswa',
        'nama_wali',
        'no_wa',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
