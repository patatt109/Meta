<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 08/08/17 10:36
 */
namespace Modules\Meta\Controllers;

use Phact\Components\Settings;
use Phact\Controller\Controller;

class MetaController extends Controller
{
    public function robots(Settings $settings)
    {
        header('Content-Type: text/plain');
        echo $settings->get('Meta.robots');
    }
}