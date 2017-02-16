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
use Modules\Meta\Models\MetaTemplate;
use Modules\Meta\Models\MetaUrl;

class MetaTemplateAdmin extends Admin
{
    public function getSearchColumns()
    {
        return ['title', 'keywords', 'description', 'key'];
    }
    
    public function getModel()
    {
        return new MetaTemplate;
    }
    
    public static function getName()
    {
        return 'Шаблоны мета';
    }

    public static function getItemName()
    {
        return 'Шаблон мета';
    }
}