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
 * @date 16/02/17 13:34
 */
namespace Modules\Meta\Models;

use Phact\Orm\Fields\CharField;
use Phact\Orm\Fields\TextField;
use Phact\Orm\Model;

class MetaSettings extends Model
{
    public static function getFields() 
    {
        return [
            'postfix' => [
                'class' => CharField::class,
                'label' => 'Последний сегмент заголовка',
                'null' => true
            ],
            'delimiter' => [
                'class' => CharField::class,
                'label' => 'Разделитель сегментов заголовка',
                'null' => true
            ],
            'robots' => [
                'class' => TextField::class,
                'label' => 'robots.txt',
                'null' => true
            ]
        ];
    }
} 