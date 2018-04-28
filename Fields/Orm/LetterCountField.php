<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 28/04/18 13:34
 */

namespace Modules\Meta\Fields\Orm;

use Modules\Meta\Fields\Form\LetterCountField as LetterCountFormField;
use Phact\Orm\Fields\CharField;

class LetterCountField extends CharField
{
    public function getFormField()
    {
        $config = parent::getFormField();
        $config['class'] = LetterCountFormField::class;
        return $config;
    }
}