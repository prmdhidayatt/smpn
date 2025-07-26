<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Kesiswaan extends Model
{
    use HasFactory;

    protected $table = 'tb_kesiswaan';
    protected $primaryKey = 'id_kesiswaan'; // Tentukan kolom primary key
    public $incrementing = true; // Set true jika auto-increment, false jika tidak
    protected $fillable = [
        'nip',
        'nama_kesiswaan',
        'jk_kesiswaan',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
