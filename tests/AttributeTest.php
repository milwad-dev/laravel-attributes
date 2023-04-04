<?php

namespace Milwad\LaravelAttributes\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Milwad\LaravelAttributes\Tests\SetUp\Models\Product;

use function Pest\Laravel\assertDatabaseCount;

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
        ]
    ]);

    assertDatabaseCount('products', 1);
});
