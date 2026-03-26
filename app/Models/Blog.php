<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Blog extends Model
{
    use Notifiable;
    protected $table = 'blogs';
    public $timestamps = true;
    protected $fillable = [
        'title', 'image', 'description', 'content', 'id_user'
    ];
}
