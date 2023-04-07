<?php

namespace Milwad\LaravelAttributes;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string     $title
 * @property string     $value
 * @property string     $attributable
 * @property string|int $attributable_id
 */
class Attribute extends Model
{
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        $this->table = config('laravel-attributes.tables.name', 'attributes');

        parent::__construct($attributes);
    }
}
