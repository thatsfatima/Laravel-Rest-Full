<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
         'libelle', 
         'price', 
         'quantity', 
        ];

    protected $dates = ['deleted_at'];
}
