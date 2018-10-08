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
    
    public function getName()
    {
        return $this->t('Meta.main', 'Meta by URL');
    }

    public function getItemName()
    {
        return $this->t('Meta.main', 'Meta by URL');
    }
}