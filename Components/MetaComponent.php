<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 16/02/17 08:45
 */

namespace Modules\Meta\Components;

use Modules\Meta\Interfaces\ModelMetaInterface;
use Modules\Meta\Models\MetaBound;
use Modules\Meta\Models\MetaTemplate;
use Modules\Meta\Models\MetaUrl;
use Phact\Components\BreadcrumbsInterface;
use Phact\Components\Meta;
use Phact\Components\Settings;
use Phact\Orm\Fields\CharField;
use Phact\Orm\Fields\DateField;
use Phact\Orm\Fields\FileField;
use Phact\Orm\Fields\ForeignField;
use Phact\Orm\Fields\NumericField;
use Phact\Orm\Model;
use Phact\Request\HttpRequestInterface;

class MetaComponent extends Meta implements ModelMetaInterface
{
    public $templateUsed = false;

    public $modelUsed = false;

    public $breadcrumbsFallback = true;

    /**
     * @var HttpRequestInterface
     */
    protected $_request;

    /**
     * @var Settings
     */
    protected $_settings;

    /**
     * @var BreadcrumbsInterface
     */
    protected $_breadcrumbs;

    /**
     * @var string
     */
    protected $_url;

    public function __construct(
        HttpRequestInterface $request = null,
        Settings $settings = null,
        BreadcrumbsInterface $breadcrumbs = null
    )
    {
        $this->_request = $request;
        $this->_settings = $settings;
        $this->_breadcrumbs = $breadcrumbs;
    }

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

    /**
     * Fetch model-based metadata
     * @param Model $model
     * @return mixed
     */
    public function useModel(Model $model)
    {
        $bound = MetaBound::fetch($model);
        if ($bound) {
            $this->modelUsed = true;
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
        if ($this->_title) {
            return $this->decorateTitle($this->_title);
        }
        return null;
    }

    protected function decorateTitle($title)
    {
        $postfix = '';
        $delimiter = ' - ';
        if ($this->_settings) {
            $postfix = $this->_settings->get('Meta.postfix') ?: '';
            $delimiter = $this->_settings->get('Meta.delimiter') ?: '';
        }
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

    public function setUrl($url)
    {
        $this->_url = $url;
    }

    public function getData()
    {
        $fallback = !$this->templateUsed && !$this->modelUsed;
        $url = $this->_url;
        if (!$url && $this->_request) {
            $url = $this->_request->getPath();
        }
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
            if ($this->_breadcrumbs) {
                $list = $this->_breadcrumbs->get();
                $items = [];
                foreach ($list as $item) {
                    $items[] = $item['name'];
                }
                $items = array_reverse($items);
                $delimiter = $this->_settings ? $this->_settings->get('Meta.delimiter') : ' - ';
                $this->setTitle(implode($delimiter, $items));
            }
        }
        return parent::getData();
    }
}
