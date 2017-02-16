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
 * @date 16/02/17 08:44
 */
namespace Modules\Meta;

use Modules\Meta\Models\MetaSettings;
use Phact\Module\Module;
use Modules\Admin\Traits\AdminTrait;

class MetaModule extends Module
{
    use AdminTrait;

    public static function getSettingsModel()
    {
        return new MetaSettings;
    }

    public static function getVerboseName()
    {
        return "Мета-данные";
    }
}