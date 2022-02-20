<?php


namespace App\Models\Api;


use App\Models\Utils\TextValidation;
use Illuminate\Database\Eloquent\Model;

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
        'messages',
        'created_at',
        'updated_at',
    ];

    public function setSubjectAttribute($subject)
    {
        $this->attributes['subject'] = (new TextValidation($subject))
            ->clearProfanity()
            ->clearTags()
            ->getStr();
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'ticket_id', 'uid');
    }
}
