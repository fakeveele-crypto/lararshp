<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class roleUser extends Model
{
    protected $table = 'role_user'; // Pastikan nama tabel perantara ini benar di DB
    protected $primaryKey = 'idroleuser'; // Ganti dengan primary key yang benar
    public $timestamps = false; // Asumsi tidak ada timestamps
    protected $fillable = ['iduser','idrole'];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idreservasi_dokter', 'idrole_user');
    }
}