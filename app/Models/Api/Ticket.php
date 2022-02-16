<?php


namespace App\Models\Api;


use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $table = 'ticket';

    protected $fillable = [
        'id',
        'uid',
        'subject',
        'user_name',
        'user_email'
    ];

    protected $visible = [
        'uid',
        'subject',
        'user_name',
        'user_email',
        'created_at',
        'updated_at',
    ];
}
