<?php


namespace App\Models\Api;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{

    protected $table = 'ticket';

    protected $fillable = [
        'uid',
        'subject',
        'user_name',
        'user_email'
    ];

    protected $visible = [
        'id',
        'uid',
        'subject',
        'user_name',
        'user_email',
        'created_at',
        'updated_at',
    ];
}
