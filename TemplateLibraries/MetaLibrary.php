<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 16/02/17 13:03
 */
namespace Modules\Meta\TemplateLibraries;

use Phact\Components\MetaInterface;
use Phact\Di\ComponentFetcher;
use Phact\Template\RendererInterface;
use Phact\Template\TemplateLibrary;

class MetaLibrary extends TemplateLibrary
{
    use ComponentFetcher;

    /**
     * @name render_meta
     * @kind function
     * @return string
     */
    public static function renderMeta($params)
    {
        /**
         * @var $renderer RendererInterface
         * @var $meta MetaInterface
         */
        if (($renderer = self::fetchComponent(RendererInterface::class)) && ($meta = self::fetchComponent(MetaInterface::class))) {
            $template = isset($params['template']) ? $params['template'] : 'meta/default.tpl';
            return $renderer->render($template, $meta->getData());
        }
    }
}