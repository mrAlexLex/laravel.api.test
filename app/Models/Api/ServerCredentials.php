<?php


namespace App\Models\Api;


use Illuminate\Database\Eloquent\Model;

class ServerCredentials extends Model
{

    protected $table = 'server_credentials';

    protected $fillable = [
        'id',
        'ftp_login',
        'ftp_password',
        'auth_token'
    ];

    protected $visible = [
        'ftp_login',
        'ftp_password',
        'auth_token'
    ];
}
