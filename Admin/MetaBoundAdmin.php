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

use Modules\Admin\Contrib\BoundAdmin;
use Modules\Meta\Forms\MetaBoundForm;
use Modules\Meta\Interfaces\DefaultMetaInterface;
use Modules\Meta\Models\MetaBound;
use Phact\Form\ModelForm;

class MetaBoundAdmin extends BoundAdmin
{
    public static $ownerAttribute = 'bound';

    public function getSearchColumns()
    {
        return ['title', 'keywords', 'description'];
    }
    
    public function getModel()
    {
        return new MetaBound;
    }
    
    public static function getName()
    {
        return 'Метаданные';
    }

    public static function getItemName()
    {
        return 'Метаданные';
    }

    public function fetchModel($ownerInstance)
    {
        return MetaBound::getOrCreate($ownerInstance);
    }

    public function getForm()
    {
        return new MetaBoundForm();
    }

    /**
     * @param ModelForm $form
     * @param $ownerInstance
     */
    public function save($form, $ownerInstance)
    {
        $safe = [
            'object_pk' => $ownerInstance->pk,
            'object_class' => $ownerInstance->className()
        ];
        if (!$form->getField('title')->getValue()) {
            if ($ownerInstance instanceof DefaultMetaInterface) {
                $safe['title'] = $ownerInstance->getMetaTitle();
                if (!$form->getField('description')->getValue()) {
                    $safe['description'] = $ownerInstance->getMetaDescription();
                }
                if (!$form->getField('keywords')->getValue()) {
                    $safe['keywords'] = $ownerInstance->getMetaKeywords();
                }
            } else {
                $safe['title'] = (string) $ownerInstance;
            }
        }
        $form->save($safe);
    }
}