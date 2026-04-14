# Laravel Attributes

<img src="https://banners.beyondco.de/Laravel%20Attributes.png?theme=dark&packageManager=composer+require&packageName=milwad%2Flaravel-attributes&pattern=boxes&style=style_2&description=Make+attributes+easy+for+Laravel&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="Laravel-Attributes">

[![Latest Stable Version](https://img.shields.io/packagist/v/milwad/laravel-attributes.svg?style=flat-square)](https://packagist.org/packages/milwad/laravel-attributes)
[![Total Downloads](https://img.shields.io/packagist/dt/milwad/laravel-attributes.svg?style=flat-square)](https://packagist.org/packages/milwad/laravel-attributes)
[![License](https://img.shields.io/packagist/l/milwad/laravel-attributes)](https://packagist.org/packages/milwad/laravel-attributes)
[![Passed Tests](https://github.com/milwad-dev/laravel-attributes/actions/workflows/run-tests.yml/badge.svg)](https://github.com/milwad-dev/laravel-attributes/actions/workflows/run-tests.yml)
[![PHP Version Require](https://img.shields.io/packagist/dependency-v/milwad/laravel-attributes/php)](https://packagist.org/packages/milwad/laravel-attributes)
***
The `laravel-attributes` package is a tool designed to help Laravel developers easily manage and implement custom attributes in their projects. It enables you to define attributes directly on Eloquent models, making it simpler to handle dynamic or calculated properties without directly modifying the database schema. With this package, you can create and configure attribute sets for models, making it easier to organize and extend data handling in Laravel applications. It's especially useful for projects that require customizable and flexible data models. <br>
You don't have any stress for attributes! You can create attributes for any model and display like drink water :)

# Requirements
***

- `PHP: ^8.0`
- `Laravel Framework: ^9.0`

| Attributes | L9                 | L10                | L11                | L12                | L13                |
|------------|--------------------|--------------------|--------------------|--------------------|--------------------|
| 1.0        | :white_check_mark: | :white_check_mark: | :x:                | :x:                | :x:                |
| 1.1        | :white_check_mark: | :white_check_mark: | :x:                | :x:                | :x:                |
| 1.2        | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                | :x:                |
| 1.3        | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                |
| 1.3        | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :x:                |
| 1.4        | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: | :white_check_mark: |

# Installation
***
```
composer require milwad/laravel-attributes
```
After publish config files.<br>
```bash
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

After, you have access to `attributes` relation and etc... .

## Save attribute

If you want to attach attribute to a model, you can use `attachAttribute` method. <br>
`attachAttribute` method take a `title` and `value`.

```php
$product = Product::query()->create([
    'name' => 'milwad',
    'content' => 'laravel attributes',
]);

$product->attachAttribute('age', '17');
```

## Save attribute multiple

If you have multiple attributes you can use `attachAttributes` method to save attributes for a model.

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

$product->attachAttributes($data);
```

## Get attributes with query

If you want to retrieve attributes from relation you can use `attributes`.

```php
$product = Product::query()->with('attributes')->get();

$product->attributes
```

## Check attribute value is exists

Maybe you want to check one model has an attribute value you can use `hasAttributeValue` method.

```php
if ($product->hasAttributeValue('17')) {
    return 'attribute value';
}

return 'no attribute value';
```

## Check attribute value is exists

Maybe you want to check one model has an attribute title you can use `hasAttributeTitle` method.

```php
if ($product->hasAttributeTitle('milwad')) {
    return 'attribute title';
}

return 'no attribute title';
```

## Delete all attributes

If you want to delete all attributes of one model you can use `deleteAllAttribute` method.

```php
$product->deleteAllAttribute();
```

## Delete special attributes

If you want to delete specific attribute of a model you can use `deleteAttribute` method.

```php
$product->deleteAttribute('title', 'value');
```

## Delete special attributes by title

If you want to delete specific attribute by title you can use `deleteAttributeByTitle` method. <br>
> Maybe you have two attributes with same title, if you delete with this method, will be deleted two attributes

```php
$product->deleteAttributeByTitle('title');
```

## Delete special attributes by value

If you want to delete specific attribute by value you can use `deleteAttributeByValue` method. <br>
> Maybe you have two attributes with same value, if you delete with this method, will be deleted two attributes

```php
$product->deleteAttributeByValue('value');
```

## Testing

Run the tests with:

``` bash
vendor/bin/pest
composer test
composer test-coverage
```

## Customize

If you want change migration table name or change default model you can use `laravel-attributes` config that exists in `config` folder.

```php
<?php

return [
    /*
     * Table config
     *
     * Here it's a config of migrations.
     */
    'tables' => [
        /*
         * Get table name of migration.
         */
        'name' => 'attributes',

        /*
         * Use uuid as primary key.
         */
        'uuids' => false, // Also in beta !!!
    ],

    /*
     * Model class name for attributes table.
     */
    'attributes_model' => \Milwad\LaravelAttributes\Attribute::class,
];
```

# License
* This package is created and modified by <a href="https://github.com/milwad-dev" target="_blank">Milwad Khosravi</a> for Laravel >= 9 and is released under the MIT License.

## Contributing

This project exists thanks to all the people who
contribute. [CONTRIBUTING](https://github.com/milwad-dev/laravel-attributes/graphs/contributors)

<a href="https://github.com/milwad-dev/laravel-attributes/graphs/contributors"><img src="https://opencollective.com/laravel-attributes/contributors.svg?width=890&button=false" /></a>

## Security

If you've found a bug regarding security please mail [milwad.dev@gmail.com](mailto:milwad.dev@gmail.com) instead of
using the issue tracker.

## Donate

If this package is helpful for you, you can buy a coffee for me :) ❤️

- Iraninan Gateway: https://daramet.com/milwad_khosravi
- Paypal Gateway: SOON
- MetaMask Address: `0xf208a562c5a93DEf8450b656c3dbc1d0a53BDE58`
