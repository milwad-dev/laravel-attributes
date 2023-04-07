# Laravel Attributes

[![Latest Stable Version](http://poser.pugx.org/milwad/laravel-attributes/v)](https://packagist.org/packages/milwad/laravel-attributes)
[![Total Downloads](http://poser.pugx.org/milwad/laravel-attributes/downloads)](https://packagist.org/packages/milwad/laravel-attributes)
[![License](http://poser.pugx.org/milwad/laravel-attributes/license)](https://packagist.org/packages/milwad/laravel-attributes)
[![Passed Tests](https://github.com/milwad-dev/laravel-attributes/actions/workflows/run-tests.yml/badge.svg)](https://github.com/milwad-dev/laravel-attributes/actions/workflows/run-tests.yml)
[![PHP Version Require](http://poser.pugx.org/milwad/laravel-attributes/require/php)](https://packagist.org/packages/milwad/laravel-attributes)
***
Laravel attributes is a package for create attributes easy. <br>
With laravel attributes you can make attributes for all model (Polymorphic). <br>
You don't have any stress for attributes! You can create attributes for any model and display like drink water :)

# Requirements
***

- `PHP: ^8.0`
- `Laravel ramework: ^9.0`

| Attributes | L9                 | L10                |
|------------|--------------------|--------------------|
| 1.0        | :white_check_mark: | :white_check_mark: |

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
