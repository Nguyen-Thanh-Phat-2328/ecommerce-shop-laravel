<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class History extends Model
{
    use Notifiable;
    protected $table = 'history';
    protected $fillable = [
        'email',
        'name',
        'phone',
        'id_user',
        'price'
    ];
    public $timestamps = true;
}
