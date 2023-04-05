<?php

namespace Milwad\LaravelAttributes\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Milwad\LaravelAttributes\Tests\SetUp\Models\Product;

use function Pest\Laravel\assertDatabaseCount;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertNotEmpty;

uses(RefreshDatabase::class);

test('test can attach attributes to model', function () {
    $product = Product::query()->create(['title' => 'milwad-dev']);
    $product->attachAttribute('name', 'implicit value');

    assertDatabaseCount('products', 1);
});

test('test can attach multiple attributes to model', function () {
    $product = Product::query()->create(['title' => 'milwad-dev']);
    $product->attachAttributes([
        [
            'title' => 'milwad',
            'value' => 'developer',
        ],
        [
            'title' => 'framework',
            'value' => 'laravel',
        ],
    ]);

    assertDatabaseCount('products', 1);
});

test('test attributes can retrieve in model relation', function () {
    Product::query()->create(['title' => 'milwad-dev']);
    $product = Product::query()->with('attributes')->first();

    assertEmpty($product->attributes()->get());
});

test('test product has attribute value', function () {
    $product = Product::query()->create(['title' => 'milwad-dev']);
    $product->attachAttribute('role', $value = 'developer');

    assertDatabaseCount('products', 1);
    assertNotEmpty($product->hasAttributeValue($value));
});
