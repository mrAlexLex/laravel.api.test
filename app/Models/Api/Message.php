<?php


namespace App\Models\Api;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'message';

    protected $fillable = [
        'id',
        'author',
        'content'
    ];

    protected $visible = [
        'author',
        'content',
        'created_at',
        'update_at',
    ];
}
