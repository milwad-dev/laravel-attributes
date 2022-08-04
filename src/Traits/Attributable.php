<?php

namespace Milwad\LaravelAttributes\Traits;

use Illuminate\Database\Eloquent\Model;

trait Attributable
{
    /**
     * First or create attributes.
     */
    public function attachAttribute(string $title, string $value, Model $model)
    {
        $attributes = [
            'title' => $title,
            'value' => $value,
            'attributable_id' => $model->getKey(),
            'attributable' => get_class($model),
        ];

        return config('laravel-attributes.model')->create($attributes);
    }
}
