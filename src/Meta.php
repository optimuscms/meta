<?php

namespace Optix\Meta;

use Optix\Media\HasMedia;
use Optix\Media\Models\Media;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasMedia;

    const OG_MEDIA_GROUP = 'og_image';
    const OG_MEDIA_CONVERSION = 'og_image_size';

    /**
     * @var string The name of the underlying database table.
     */
    protected $table = 'meta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'og_title', 'og_description', 'custom_tags',
    ];

    public function registerMediaGroups()
    {
        $this->addMediaGroup(self::OG_MEDIA_GROUP)->performConversions(self::OG_MEDIA_CONVERSION);
    }

    /**
     * @return Media|null
     */
    public function getOgImage()
    {
        return $this->getFirstMedia(Meta::OG_MEDIA_GROUP);
    }
}
