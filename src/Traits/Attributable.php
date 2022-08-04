<?php

namespace Milwad\LaravelAttributes\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Milwad\LaravelAttributes\Attribute;

trait Attributable
{
    use HasRelationships;

    /**
     * First or create attributes.
     *
     * @param  string $title
     * @param  string $value
     * @param  Model $model
     * @return Builder|Model
     */
    public function attachAttribute(string $title, string $value, Model $model)
    {
        $attributes = [
            'title' => $title,
            'value' => $value,
            'attributable_id' => $model->getKey(),
            'attributable' => get_class($model),
        ];

        return Attribute::query()->create($attributes);
    }

    /**
     * Get attributes
     *
     * @return MorphMany
     */
    public function attributes()
    {
        return $this->morphMany(Attribute::class , 'attributable', 'attributable');
    }

    /**
     * Check attribute have special value.
     *
     * @param  string $value
     * @return bool
     */
    public function hasAttributeValue(string$value)
    {
        return (bool) $this->getAttribute()
            ->where('value', $value)
            ->first();
    }

    /**
     * Check attribute have special title.
     *
     * @param  string $title
     * @return bool
     */
    public function hasAttributeTitle(string $title)
    {
        return (bool) $this->getAttribute()
            ->where('title', $title)
            ->first();
    }

    /**
     * Get attribute with this (model).
     *
     * @return MorphMany
     */
    private function getAttribute(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->attributes()
            ->where('attributable_id', $this->getKey())
            ->where('attributable', get_class($this));
    }
}
