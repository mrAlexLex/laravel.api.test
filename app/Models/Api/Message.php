<?php


namespace App\Models\Api;


use App\Models\Auth\ServerCredentials;
use App\Models\Utils\TextValidation;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package App\Models\Api
 */
class Message extends Model
{
    /**
     * @var string
     */
    protected $table = 'message';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'author',
        'content',
        'ticket_id',
        'server_credentials'
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'author',
        'content',
        'ticket_id',
        'server_credentials',
        'created_at',
        'update_at',
    ];

    /**
     * @param $content
     */
    public function setContentAttribute($content)
    {
        $this->attributes['content'] = (new TextValidation($content))
            ->clearProfanity()
            ->clearTags()
            ->getStr();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'uid','ticket_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serverCredentials()
    {
        return $this->hasMany(ServerCredentials::class, 'server_credentials','id');
    }
}
