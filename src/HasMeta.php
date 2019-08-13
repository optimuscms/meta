<?php

namespace Optix\Meta;

use Optix\Media\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property Meta $meta
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

    public function saveMeta(array $data = [])
    {
        if (!empty($data)) {
            /** @todo Ideally work out why ->updateOrCreate() doesn't work here */
            $this->meta()->delete();
            $this->meta()->create($data);

            // Attach OG image
            if (!empty($data['og_image_id'])) {
                $media = Media::findOrFail($data['og_image_id']);
                $this->meta->attachMedia($media, Meta::OG_MEDIA_GROUP, [Meta::OG_MEDIA_CONVERSION]);
            }
        }
    }
}
