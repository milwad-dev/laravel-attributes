<?php

namespace Milwad\LaravelAttributes\Tests\SetUp\Models;

use Illuminate\Database\Eloquent\Model;
use Milwad\LaravelAttributes\Traits\Attributable;

class Product extends Model
{
    use Attributable;

    protected $table = 'products';
    protected $fillable = ['title'];
}
