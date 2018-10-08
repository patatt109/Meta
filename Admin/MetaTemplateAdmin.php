<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
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
    
    public function getName()
    {
        return $this->t('Meta.main', 'Meta templates');
    }

    public function getItemName()
    {
        return $this->t('Meta.main', 'Meta template');
    }
}