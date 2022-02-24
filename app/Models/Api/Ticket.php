<?php


namespace App\Models\Api;


use App\Models\Utils\TextValidation;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * @package App\Models\Api
 */
class Ticket extends Model
{

    /**
     * @var string
     */
    protected $table = 'ticket';

    /**
     * @var string[]
     */
    protected $fillable = [
        'uid',
        'subject',
        'user_name',
        'user_email'
    ];

    /**
     * @var string[]
     */
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

    /**
     * @param $subject
     */
    public function setSubjectAttribute($subject)
    {
        $this->attributes['subject'] = (new TextValidation($subject))
            ->clearProfanity()
            ->clearTags()
            ->getStr();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'ticket_id', 'uid');
    }
}
