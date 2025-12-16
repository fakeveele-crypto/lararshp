<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeTindakanTerapi extends Model
{
    protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi';
    protected $fillable = ['kode', 'deskripsi_tindakan_terapi', 'nama_tindakan', 'biaya', 'idkategori', 'idkategori_klinis'];
    public $timestamps = false;

    public function kategoriKlinis()
    {
        return $this->belongsTo(\App\Models\KategoriKlinis::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}