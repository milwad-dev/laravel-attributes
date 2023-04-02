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
     * Get attributes.
     *
     * @return MorphMany
     */
    public function attributes()
    {
        return $this->morphMany(Attribute::class, 'attributable', 'attributable');
    }

    /**
     * Attach attribute.
     *
     * @return Builder|Model
     */
    public function attachAttribute(string $title, string $value)
    {
        $attributes = [
            'title'           => $title,
            'value'           => $value,
            'attributable_id' => $this->getKey(),
            'attributable'    => get_class($this),
        ];

        return Attribute::query()->create($attributes);
    }

    /**
     * Attach multiple attributes.
     *
     * @return bool
     */
    public function attachAttributes(array $values)
    {
        return Attribute::query()->insert($values);
    }

    /**
     * Check attribute have special value.
     *
     * @return bool
     */
    public function hasAttributeValue(string $value)
    {
        return $this->getAttributeWhere()
            ->where('value', $value)
            ->exists();
    }

    /**
     * Check attribute have special title.
     *
     * @return bool
     */
    public function hasAttributeTitle(string $title)
    {
        return $this->getAttributeWhere()
            ->where('title', $title)
            ->exists();
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
     */
    private function getAttributeWhere(): MorphMany
    {
        return $this->attributes()
            ->where('attributable_id', $this->getKey())
            ->where('attributable', get_class($this));
    }
}
