<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RasHewan extends Model
{
    use HasFactory;

    protected $table = 'ras_hewan'; // Pastikan nama tabel benar
    protected $primaryKey = 'idras_hewan'; // Pastikan primary key benar
    public $timestamps = false;
    protected $fillable = ['nama_ras', 'idjenis_hewan'];

    // Relasi ke JenisHewan (digunakan oleh Controller dan View)
    public function jenisHewan()
    {
        // Asumsi: Model JenisHewan.php ada di App\Models
        // Asumsi: foreign key di tabel 'ras_hewan' adalah 'idjenis_hewan'
        // Asumsi: primary key di tabel 'jenis_hewan' juga 'idjenis_hewan'
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'idras_hewan', 'idras_hewan');
    }
}