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

use Phact\Orm\Fields\CharField;
use Phact\Orm\Model;

abstract class MetaModel extends Model
{
    public static function getFields() 
    {
        return [
            'title' => [
                'class' => CharField::class,
                'label' => 'Заголовок'
            ],
            'description' => [
                'class' => CharField::class,
                'label' => 'Описание',
                'null' => true
            ]
        ];
    }
    
    public function __toString() 
    {
        return $this->title;
    }
} 