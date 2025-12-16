<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // WAJIB: Tentukan nama tabel yang benar (tunggal)
    protected $table = 'user'; 

    // WAJIB: Tentukan primary key yang benar
    protected $primaryKey = 'iduser'; 
    
    // Table does not have Laravel's default timestamps columns
    public $timestamps = false;
    
    protected $fillable = [
        'nama',
        'email',
        'password',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // RELASI UNTUK MENGAMBIL DATA DI VIEW

    // Relasi Many-to-Many via roleUser
    public function roleUsers()
    {
        return $this->hasMany(roleUser::class, 'iduser', 'iduser');
    }

    // Relasi One-to-One ke Model Pemilik
    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    // Relasi One-to-One ke Model Dokter
    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'id_user', 'iduser');
    }

    // Relasi One-to-One ke Model Perawat
    public function perawat()
    {
        return $this->hasOne(Perawat::class, 'id_user', 'iduser');
    }

    // Relasi One-to-Many ke TemuDokter (sebagai dokter)
    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'iddokter', 'iduser');
    }
}