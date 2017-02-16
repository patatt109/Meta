# Мета (SEO) модуль для Phact

## Компонент

```php
'meta' => [
    'class' => \Modules\Meta\Components\MetaComponent::class
],
```

## Использование

### Простая установка параметров. 

Имеет наименьший приоритет.

Пример:

```
Phact::app()->meta->setTitle("Заголовок");
Phact::app()->meta->setDescription("Описание");
```

### Использование шаблона

Имеет средний приоритет.

Примеры:

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

### Мета по Url

Имеет наивысший приоритет, задается интуитивно-понятно через модель MetaUrl

## Вывод в Мета шаблоне

```smarty
{render_meta:raw}
```
