# Laravel attributes
***
Laravel attributes is a package for create attributes easy. <br>
With laravel attributes you can make attributes for all model (Polymorphic)

# Requirements
***
- PHP >= 7.3

# Installation
***
```
composer require milwad/laravel-attributes
```
After publish config files.<br>
```
php artisan vendor:publish --provider="Milwad\LaravelAttributes\LaravelAttributesServiceProvider"
```
After publish, you migrate the migration file.
```
php artisan migrate
```

# Usage
First, you use trait in model.
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Milwad\LaravelAttributes\Traits\Attributable;

class Product extends Model
{
    use HasFactory, Attributable;
}
```

## Save attribute
```php
$product = Product::query()->create([
    'name' => 'milwad',
    'content' => 'laravel attributes',
]);

$product->attachAttribute('age', '17');
```

## Save attribute multiple
```php
$product = Product::query()->create([
    'name' => 'milwad',
    'content' => 'text',
]);

$data = [
    [
        'title' => 'milwad',
        'value' => 'developer',
    ],
    [
        'title' => 'milwad2',
        'value' => 'developer2',
    ],
    [
        'title' => 'milwad3',
        'value' => 'developer3',
    ],
    [
        'title' => 'milwad4',
        'value' => 'developer4',
    ],
    [
        'title' => 'milwad5',
        'value' => 'developer5',
    ],
    [
        'title' => 'milwad6',
        'value' => 'developer6',
    ],
];

foreach ($data as $content) {
    $product->attachAttribute($content['title'], $content['value']);
}
```

## Get attributes with query
```php
Product::query()->with('attributes')->get();
```

## Check attribute value is exists
```php
if ($product->hasAttributeValue('17')) {
    return 'attribute value';
}

return 'no attribute value';
```

## Check attribute value is exists
```php
if ($product->hasAttributeTitle('milwad')) {
    return 'attribute title';
}

return 'no attribute title';
```

## Delete all attributes
```php
$product->deleteAllAttribute();
```

## Delete special attributes
```php
$product->deleteAttribute('title', 'value');
```


# License
* This package is created and modified by <a href="https://github.com/milwad-dev" target="_blank">Milwad Khosravi</a> for Laravel >= 9 and is released under the MIT License.
