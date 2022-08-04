<?php

namespace Milwad\LaravelAttributes\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Milwad\LaravelAttributes\Attribute;

trait Attributable
{
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

        return Attribute::query()->firstOrCreate($attributes);
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
        return (bool) $this->getAttributeWhere()
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
        return (bool) $this->getAttributeWhere()
            ->where('title', $title)
            ->first();
    }

    /**
     * Delete all attributes.
     *
     * @return Attributable
     */
    public function deleteAllAttribute()
    {
        $attributes = $this->getAttributeWhere()->get();

        foreach ($attributes as $attribute) {
            $attribute->delete();
        }

        return $this;
    }

    /**
     * Delete special attribute.
     *
     * @param  string $title
     * @param  string $value
     * @return int
     */
    public function deleteAttribute(string $title, string $value)
    {
        return $this->getAttributeWhere()
            ->where('title', $title)
            ->where('value', $value)
            ->delete();
    }

    /**
     * Get attribute with this (model).
     *
     * @return MorphMany
     */
    private function getAttributeWhere(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->attributes()
            ->where('attributable_id', $this->getKey())
            ->where('attributable', get_class($this));
    }
}
