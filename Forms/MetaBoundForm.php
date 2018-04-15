<?php

/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @company OrderTarget
 * @site http://ordertarget.ru
 * @date 15/04/18 17:00
 */
namespace Modules\Meta\Forms;

use Phact\Form\ModelForm;
use Modules\Meta\Models\MetaBound;

class MetaBoundForm extends ModelForm
{
    public function getModel()
    {
        return new MetaBound;
    }
}