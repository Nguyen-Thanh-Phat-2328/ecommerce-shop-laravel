<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use Notifiable;
    protected $fillable = [
        'id_blog',
        'id_user',
        'level',
        'comment',
        'avatar_user',
        'name_user',
    ];
    public $timestamps = true;
    protected $table = 'comments';
}
