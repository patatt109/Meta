<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 16/02/17 08:44
 */
namespace Modules\Meta;

use Modules\Admin\Contrib\AdminMenuInterface;
use Modules\Meta\Models\MetaSettings;
use Phact\Module\Module;
use Modules\Admin\Traits\AdminTrait;

class MetaModule extends Module implements AdminMenuInterface
{
    use AdminTrait;

    public function getSettingsModel()
    {
        return new MetaSettings;
    }

    public function getVerboseName()
    {
        return $this->t('Meta.main', 'Metadata');
    }
}