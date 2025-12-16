<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pet; // Wajib diimpor jika tidak berada di namespace yang sama
use App\Models\Dokter; // Wajib diimpor
use App\Models\TemuDokter;
use App\Models\DetailRekamMedis;

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
        // RekamMedis stores foreign key as `iddokter`, Dokter primary key is `id_dokter`
        return $this->belongsTo(Dokter::class, 'iddokter', 'id_dokter');
    }

    public function reservasi()
    {
        // Link to TemuDokter (appointment) — RekamMedis.idreservasi_dokter -> temu_dokter.idtemu_dokter
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter', 'idtemu_dokter');
    }

    public function details()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    protected static function booted()
    {
        static::deleting(function ($rekam) {
            // delete related detail_rekam_medis rows to avoid FK constraint error
            $rekam->details()->delete();
        });
    }
}