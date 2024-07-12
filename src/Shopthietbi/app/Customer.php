<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'address_id', 'customer_name','customer_email', 'customer_password','customer_phone'
    ];
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customers';
}
