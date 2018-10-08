<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 16/02/17 13:34
 */
namespace Modules\Meta\Models;

use Phact\Orm\Fields\CharField;
use Phact\Orm\Fields\TextField;
use Phact\Orm\Model;
use Phact\Translate\Translator;

class MetaSettings extends Model
{
    use Translator;

    public static function getFields() 
    {
        return [
            'postfix' => [
                'class' => CharField::class,
                'label' => self::t('Meta.main', 'Last segment of title'),
                'null' => true
            ],
            'delimiter' => [
                'class' => CharField::class,
                'label' => self::t('Meta.main', 'Title segments delimiter'),
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