<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    protected $fillable = ['nama_role'];
    // Table does not include Laravel default timestamp columns
    public $timestamps = false;

    public function roleUsers()
    {
        return $this->hasMany(roleUser::class, 'idrole', 'idrole');
    }
}