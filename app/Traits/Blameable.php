<?php

namespace App\Traits;

trait Blameable
{
    public static function bootBlameable(): void
    {
        static::creating(function ($model) {
            $model->created_by = auth()->check() ? auth()->user()->email : 'system';
            $model->updated_by = auth()->check() ? auth()->user()->email : 'system';
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->check() ? auth()->user()->email : 'system';
        });
    }
}
