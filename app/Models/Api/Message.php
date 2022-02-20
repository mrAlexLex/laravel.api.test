<?php


namespace App\Models\Api;


use App\Models\Utils\TextValidation;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';

    protected $fillable = [
        'id',
        'author',
        'content',
        'ticket_id'
    ];

    protected $visible = [
        'author',
        'content',
        'ticket_id',
        'created_at',
        'update_at',
    ];

    public function setContentAttribute($content)
    {
        $this->attributes['content'] = (new TextValidation($content))
            ->clearProfanity()
            ->clearTags()
            ->getStr();
    }
}
