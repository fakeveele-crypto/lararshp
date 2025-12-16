<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pet; // Wajib diimpor jika tidak berada di namespace yang sama
use App\Models\Dokter; // Wajib diimpor
use App\Models\ReservasiDokter; // <--- TAMBAHKAN INI

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    protected $fillable = ['created_at', 'anamnesa', 'temuan_klinis', 'diagnosa', 'idpet', 'idreservasi_dokter'];
    public $timestamps = false;
    
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'iddokter', 'iddokter');
    }

    public function reservasi()
    {
    return $this->belongsTo(ReservasiDokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }

    public function details()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }
}