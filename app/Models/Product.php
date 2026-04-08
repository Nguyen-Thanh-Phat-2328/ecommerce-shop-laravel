<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;
    protected $fillable = [
        'name',
        'price',
        'id_category',
        'id_brand',
        'detail',
        'id_user',
        'image',
        'status',
        'sale',
        'image',
    ];
    protected $table = 'products';
    public $timestamps = true;
}
