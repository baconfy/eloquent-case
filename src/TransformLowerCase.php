<?php

namespace Rdehnhardt\EloquentCase;

use Illuminate\Support\Str;

trait TransformLowerCase
{
    /**
     * Init auditing
     */
    public static function bootTransformLowerCase()
    {
        static::saving(function ($model) {
            $model->selfUpperCase();
        });

        static::creating(function ($model) {
            $model->selfUpperCase();
        });

        static::updating(function ($model) {
            $model->selfUpperCase();
        });
    }

    /**
     * Set attributes to upper case automatically
     */
    public function selfUpperCase()
    {
        if (is_array($this->attributes)) {
            foreach ($this->attributes as $field => $value) {
                if (is_string($value)) {
                    if (property_exists($this, 'guardedCase')) {
                        if (!in_array($field, $this->guardedCase)) {
                            $this->{$field} = Str::lower($value);
                        }
                    } else {
                        $this->{$field} = Str::lower($value);
                    }
                }
            }
        }
    }
}
