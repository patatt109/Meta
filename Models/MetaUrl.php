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
 * @date 16/02/17 12:11
 */
namespace Modules\Meta\Models;

use Phact\Orm\Fields\CharField;

class MetaUrl extends MetaModel
{
    public static function getFields() 
    {
        return array_merge(parent::getFields(), [
            'url' => [
                'class' => CharField::class,
                'label' => 'Ссылка'
            ]
        ]);
    }
} 