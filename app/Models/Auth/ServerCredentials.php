<?php


namespace App\Models\Auth;


use App\Models\Api\Message;
use App\Models\Api\Ticket;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;

/**
 * Class ServerCredentials
 * @package App\Models\Auth
 */
class ServerCredentials extends User
{
    /**
     * @var string
     */
    public $table = 'users';

    /**
     * @var string[]
     */
    protected $fillable = [
        'ftp_login',
        'ftp_password',
        'auth_token',
        'access',
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'ftp_login',
        'ftp_password',
        'auth_token',
        'access'
    ];

    /**
     * @param $ftp_login
     */
    public function setFtpLoginAttribute($ftp_login)
    {
        $this->attributes['ftp_login'] =  hash('sha256', $ftp_login);
    }

    /**
     * @param $ftp_password
     */
    public function setFtpPasswordAttribute($ftp_password)
    {
        $this->attributes['ftp_password'] = hash('sha256', $ftp_password);
    }

    /**
     *
     */
    public function setAuthTokenAttribute()
    {
        $token = Str::random(80);
        $this->attributes['auth_token'] = hash('sha256', $token);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function message()
    {
        return $this->hasOne(Message::class, 'id','server_credentials');
    }

}
