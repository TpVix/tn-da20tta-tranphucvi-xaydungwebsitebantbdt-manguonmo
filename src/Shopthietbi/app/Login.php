<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    protected $table = 'tbl_admin';
    protected $primaryKey = 'admin_id';
    public $timestamps = true;

    protected $fillable = [
        'role_id', 'admin_name', 'admin_password', 'admin_phone'
    ];

    protected $hidden = [
        'admin_password', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->admin_password;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    
}
