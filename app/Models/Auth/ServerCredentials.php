<?php


namespace App\Models\Auth;


use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;

class ServerCredentials extends User
{
    public $table = 'users';

    protected $fillable = [
        'ftp_login',
        'ftp_password',
        'auth_token',
        'access',
    ];

    protected $visible = [
        'ftp_login',
        'ftp_password',
        'auth_token',
        'access'
    ];

    public function setFtpLoginAttribute($ftp_login)
    {
        $this->attributes['ftp_login'] =  hash('sha256', $ftp_login);
    }

    public function setFtpPasswordAttribute($ftp_password)
    {
        $this->attributes['ftp_password'] = hash('sha256', $ftp_password);
    }

    public function setAuthTokenAttribute()
    {
        $token = Str::random(80);
        $this->attributes['auth_token'] = hash('sha256', $token);
    }

}
