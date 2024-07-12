<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{  
    protected $fillable = [
        'category_parent','category_name','category_slug','category_status'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';

}
