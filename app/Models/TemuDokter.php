<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idtemu_dokter';
    // Only DB columns should be fillable; keep accessor for backwards compatibility
    protected $fillable = ['idpet', 'id_dokter', 'tanggal', 'waktu', 'keluhan', 'status'];
    public $timestamps = false;

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    // Backwards-compatible accessor for controllers/views expecting ->iddokter
    public function getIddokterAttribute()
    {
        return $this->attributes['id_dokter'] ?? ($this->attributes['iddokter'] ?? null);
    }
}