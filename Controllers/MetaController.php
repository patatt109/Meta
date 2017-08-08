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
 * @date 08/08/17 10:36
 */
namespace Modules\Meta\Controllers;

use Phact\Controller\Controller;
use Phact\Main\Phact;

class MetaController extends Controller
{
    public function robots()
    {
        header("Content-Type: text/plain");
        echo Phact::app()->settings->get('Meta.robots');
    }
}