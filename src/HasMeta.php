<?php

namespace Optix\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @method static created(\Closure $callback)
 * @method static updated(\Closure $callback)
 */
trait HasMeta
{
    /**
     * Define the "meta" relationship.
     *
     * @return MorphOne
     */
    public function meta()
    {
        /** @var Model $this */
        return $this->morphOne(Meta::class, 'metable');
    }

    /**
     * Called automatically by Laravel when the model is booted
     */
    public static function bootHasMeta() {

        static::created(function ($model) {
            /** @var HasMeta $model */
            $meta = request('meta', []);
            if (!empty($meta)) {
                $model->meta()->create($meta);
            }
        });

        static::updated(function ($model) {
            /** @var HasMeta $model */
            $meta = request('meta', []);
            if (!empty($meta)) {
                $model->meta()->update($meta);
            }
        });
    }
}
