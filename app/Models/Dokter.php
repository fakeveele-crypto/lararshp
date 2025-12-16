<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    protected $fillable = ['alamat', 'no_hp', 'bidang_dokter', 'jenis_kelamin', 'id_user'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'iduser');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'iddokter', 'id_dokter');
    }

    // Backwards-compatible accessor for views/controllers using ->iddokter
    public function getIddokterAttribute()
    {
        return $this->attributes['id_dokter'] ?? null;
    }
}