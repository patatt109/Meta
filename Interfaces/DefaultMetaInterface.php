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
 * @date 13/03/18 09:52
 */

namespace Modules\Meta\Interfaces;


interface DefaultMetaInterface
{
    public function getMetaTitle();

    public function getMetaDescription();

    public function getMetaKeywords();
}