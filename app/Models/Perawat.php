<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    protected $table = 'perawat';
    protected $primaryKey = 'id_perawat';
    protected $fillable = ['id_user', 'pendidikan', 'alamat', 'no_hp', 'jenis_kelamin'];
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'iduser');
    }

    // Backwards-compatible accessor for existing views/controllers
    // that reference $perawat->idperawat (without underscore).
    public function getIdperawatAttribute()
    {
        return $this->attributes['id_perawat'] ?? null;
    }
}