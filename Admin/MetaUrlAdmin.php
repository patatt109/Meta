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
 * @date 16/02/17 13:37
 */
namespace Modules\Meta\Admin;

use Modules\Admin\Contrib\Admin;
use Modules\Meta\Models\MetaUrl;

class MetaUrlAdmin extends Admin
{
    public function getSearchColumns()
    {
        return ['title', 'keywords', 'description', 'url'];
    }
    
    public function getModel()
    {
        return new MetaUrl;
    }
    
    public static function getName()
    {
        return 'Мета по Url';
    }

    public static function getItemName()
    {
        return 'Мета по Url';
    }
}