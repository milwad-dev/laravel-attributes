<?php

namespace Milwad\LaravelAttributes\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Milwad\LaravelAttributes\Tests\SetUp\Models\Product;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function PHPUnit\Framework\assertEmpty;
use function PHPUnit\Framework\assertNotEmpty;

uses(RefreshDatabase::class);

test('test can attach attributes to model', function () {
    $product = createProduct();
    $product->attachAttribute($title = 'name', $value = 'implicit value');

    assertDatabaseCount('products', 1);
    assertDatabaseHas('products', [
        'title' => 'milwad-dev'
    ]);

    assertDatabaseCount('attributes', 1);
    assertDatabaseHas('attributes', [
        'title' => $title,
        'value' => $value,
    ]);

    expect($product->hasAttributeValue($value))
        ->toBeTrue()
        ->and($product->hasAttributeTitle($title))
        ->toBeTrue();
});

test('test can attach multiple attributes to model', function () {
    $product = createProduct();
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
    assertDatabaseHas('products', [
        'title' => 'milwad-dev'
    ]);

    assertDatabaseCount('attributes', 2);
    assertDatabaseHas('attributes', [
        'title' => 'milwad',
        'value' => 'developer',
    ]);
    assertDatabaseHas('attributes', [
        'title' => 'framework',
        'value' => 'laravel',
    ]);

    expect($product->hasAttributeValue('developer'))
        ->toBeTrue()
        ->and($product->hasAttributeTitle('milwad'))
        ->toBeTrue()
        ->and($product->hasAttributeValue('laravel'))
        ->toBeTrue()
        ->and($product->hasAttributeTitle('framework'))
        ->toBeTrue();
});

test('test attributes can retrieve in model relation', function () {
    createProduct();
    $product = Product::query()->with('attributes')->first();

    assertEmpty($product->attributes()->get());

    $product->attachAttribute('milwad', 'developer');
    assertNotEmpty($product->attributes()->get());
});

test('test product has attribute value', function () {
    $product = createProduct();
    $product->attachAttribute('role', $value = 'developer');

    assertDatabaseCount('products', 1);
    assertDatabaseCount('attributes', 1);
    assertNotEmpty($product->hasAttributeValue($value));
});

test('test product has attribute title', function () {
    $product = createProduct();
    $product->attachAttribute($title = 'role', 'developer');

    assertDatabaseCount('products', 1);
    assertDatabaseCount('attributes', 1);
    assertNotEmpty($product->hasAttributeTitle($title));
});

test('test can attribute delete from model', function () {
    $product = createProduct();
    $product->attachAttribute($title = 'role', $value = 'developer');
    $product->deleteAttribute($title, $value);

    assertDatabaseCount('products', 1);
    assertDatabaseCount('attributes', 0);
});

test('test can delete all attributes of one model', function () {
    $product = createProduct();
    $product->attachAttribute('role', 'developer');
    $product->attachAttribute('stack', 'laravel');
    $product->deleteAllAttribute();

    assertDatabaseCount('products', 1);
});

/**
 * Create a product.
 *
 * @return Product
 */
function createProduct(): Product
{
    return Product::query()->create(['title' => 'milwad-dev']);
}
