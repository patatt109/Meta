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
 * @date 16/02/17 08:45
 */

namespace Modules\Meta\Components;

use Modules\Meta\Models\MetaBound;
use Modules\Meta\Models\MetaTemplate;
use Modules\Meta\Models\MetaUrl;
use Phact\Components\Meta;
use Phact\Main\Phact;
use Phact\Orm\Fields\CharField;
use Phact\Orm\Fields\DateField;
use Phact\Orm\Fields\FileField;
use Phact\Orm\Fields\ForeignField;
use Phact\Orm\Fields\NumericField;
use Phact\Orm\Model;

class MetaComponent extends Meta
{
    public $templateUsed = false;

    public $breadcrumbsFallback = true;

    public function useTemplate($key, $params = [])
    {
        $template = MetaTemplate::objects()->filter([
            'key' => $key
        ])->get();
        if ($params instanceof Model) {
            $params = $this->prepareModelParams($params);
        }
        if ($template) {
            $this->templateUsed = true;
            foreach (['title', 'description', 'keywords'] as $name) {
                $this->{$name} = strtr($template->{$name}, $params);
            }
        }
    }

    public function useModel(Model $model)
    {
        $bound = MetaBound::fetch($model);
        if ($bound) {
            foreach (['title', 'description', 'keywords'] as $name) {
                $this->{$name} = $bound->{$name};
            }
        }
        if (method_exists($model, 'getAbsoluteUrl')) {
            $this->setCanonical($model->getAbsoluteUrl());
        }
    }

    /**
     * @param $model Model
     * @return array
     */
    public function prepareModelParams($model)
    {
        $fields = $model->getInitFields();
        $params = [];
        foreach ($fields as $field) {
            if (
                (
                    $field instanceof CharField ||
                    $field instanceof NumericField ||
                    $field instanceof DateField ||
                    $field instanceof ForeignField
                ) && !(
                    $field instanceof FileField
                )
            ) {
                $label = $field->label;
                if ($label) {
                    $label = '{' . mb_strtoupper($label, 'UTF-8') . '}';
                    $name = '{' . mb_strtoupper($field->name, 'UTF-8') . '}';
                    $value = $field->getValue();
                    if (is_object($value)) {
                        try {
                            $value = (string) $value;
                        } catch (\Exception $e) {
                            $value = '';
                        }
                    }
                    $params[$label] = $value;
                    $params[$name] = $value;
                }
            }
        }
        return $params;
    }

    public function getTitle()
    {
        $postfix = Phact::app()->settings->get('Meta.postfix') ?: '';
        $delimiter = Phact::app()->settings->get('Meta.delimiter')?: '';
        $title = $this->_title;
        if ($postfix) {
            $title .= $delimiter . $postfix;
        }
        return $title;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getKeywords()
    {
        return $this->_keywords;
    }

    public function getCanonical()
    {
        return $this->_canonical;
    }

    public function getData()
    {
        $fallback = !$this->templateUsed;
        $url = Phact::app()->request->getPath();
        $meta = MetaUrl::objects()->filter([
            'url' => $url
        ])->get();
        if ($meta) {
            $fallback = false;
            foreach (['title', 'description', 'keywords'] as $name) {
                $this->{$name} = $meta->{$name};
            }
        }
        if ($fallback && $this->breadcrumbsFallback && !$this->getTitle()) {
            $breadcrumbs = Phact::app()->hasComponent('breadcrumbs') ? Phact::app()->breadcrumbs : null;
            if ($breadcrumbs) {
                $list = $breadcrumbs->get();
                $items = [];
                foreach ($list as $item) {
                    $items[] = $item['name'];
                }
                $items = array_reverse($items);
                $delimiter = Phact::app()->settings->get('Meta.delimiter');
                $this->setTitle(implode($delimiter, $items));
            }
        }
        return parent::getData();
    }
}