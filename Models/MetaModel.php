<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @company HashStudio
 * @site http://hashstudio.ru
 * @date 16/02/17 12:12
 */
namespace Modules\Meta\Models;

use Modules\Meta\Fields\Orm\LetterCountField;
use Phact\Orm\Fields\CharField;
use Phact\Orm\Model;

abstract class MetaModel extends Model
{
    public static function getFields() 
    {
        return [
            'title' => [
                'class' => LetterCountField::class,
                'label' => 'Заголовок'
            ],
            'description' => [
                'class' => LetterCountField::class,
                'label' => 'Описание',
                'null' => true
            ],
            'keywords' => [
                'class' => LetterCountField::class,
                'label' => 'Ключевые слова',
                'null' => true
            ]
        ];
    }
    
    public function __toString() 
    {
        return $this->title;
    }
} 