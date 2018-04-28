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

namespace Modules\Meta\Fields\Form;

use Phact\Form\Fields\CharField;

class LetterCountField extends CharField
{
    public $hintTemplate = 'forms/field/letter_count/hint.tpl';
}