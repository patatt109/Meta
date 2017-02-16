# Мета (SEO) модуль для Phact

## Компонент

```php
'meta' => [
    'class' => \Modules\Meta\Components\MetaComponent::class
],
```

## Использование

Простая установка параметров

```
Phact::app()->meta->setTitle("Заголовок");
Phact::app()->meta->setDescription("Описание");
```

Использование шаблона 

```
Phact::app()->meta->useTemplate("TEMPLATE_KEY", $model);
```

или

```
Phact::app()->meta->useTemplate("TEMPLATE_KEY", [
    '{ПАРАМЕТР}' => 'Значение'
]);
```

В первом случае в параметрах шаблона будут доступны поля по названию в фигурных скобках, 
например, для модели с полями: 

```php
'name' => [
    'class' => CharField::class,
    'label' => 'Наименование'
],
'slug' => [
    'class' => SlugField::class,
    'label' => "Url"
],
```

В шаблоне будут доступны две переменные: **{НАИМЕНОВАНИЕ}** и **{URL}**

Вывод в шаблоне

```smarty
{render_meta:raw}
```