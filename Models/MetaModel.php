<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 16/02/17 12:12
 */
namespace Modules\Meta\Models;

use Modules\Meta\Fields\Orm\LetterCountField;
use Phact\Orm\Model;
use Phact\Translate\Translator;

abstract class MetaModel extends Model
{
    use Translator;

    public static function getFields() 
    {
        return [
            'title' => [
                'class' => LetterCountField::class,
                'label' => self::t('Meta.main', 'Title'),
                'hint' => self::t('Meta.main', 'Tag title'),
            ],
            'description' => [
                'class' => LetterCountField::class,
                'label' => self::t('Meta.main', 'Description'),
                'hint' => self::t('Meta.main', 'Tag meta description'),
                'null' => true
            ],
            'keywords' => [
                'class' => LetterCountField::class,
                'label' => self::t('Meta.main', 'Keywords'),
                'hint' => self::t('Meta.main', 'Tag meta keywords'),
                'null' => true
            ]
        ];
    }
    
    public function __toString() 
    {
        return (string) $this->title;
    }

    public function beforeSave()
    {
        parent::beforeSave();
        $this->title = $this->cut($this->title);
        $this->description = $this->cut($this->description);
        $this->keywords = $this->cut($this->keywords);
    }

    public function cut($text)
    {
        return mb_substr($text, 0, 250, 'UTF-8') . (mb_strlen($text, 'UTF-8') > 250 ? '...' : '');
    }
} 