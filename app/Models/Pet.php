<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    protected $fillable = ['idpemilik', 'nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idras_hewan'];
    public $timestamps = false;
    
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idpet', 'idpet');
    }

    public function ras()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    // Return the related JenisHewan through the RasHewan relationship
    public function jenisHewan()
    {
        return $this->hasOneThrough(
            JenisHewan::class,
            RasHewan::class,
            'idras_hewan',    // Foreign key on ras_hewan table... (local key on Pet -> idras_hewan)
            'idjenis_hewan',  // Foreign key on jenis_hewan table
            'idras_hewan',    // Local key on pet table
            'idjenis_hewan'   // Local key on ras_hewan table
        );
    }
}