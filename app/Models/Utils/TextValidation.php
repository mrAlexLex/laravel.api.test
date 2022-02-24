<?php


namespace App\Models\Utils;


/**
 * Class TextValidation
 * @package App\Models\Utils
 */
class TextValidation
{
    /**
     * @var string[]
     */
    protected $del_ = [
        'test',
        'tests'
    ];

    /**
     * @var string
     */
    protected $str = '';

    /**
     * TextValidation constructor.
     * @param string $str
     */
    public function __construct(string $str)
    {
        $this->str = $str;
    }

    /**
     * @return $this
     */
    public function clearProfanity(): TextValidation
    {
        $this->str = preg_replace("~\b(".implode('|',$this->del_).")\b~uis",'',$this->str);

        return $this;
    }

    /**
     * @return $this
     */
    public function clearTags(): TextValidation
    {
        $this->str = strip_tags($this->str);

        return $this;
    }

    /**
     * @return string
     */
    public function getStr(): string
    {
        return $this->str;
    }

}
