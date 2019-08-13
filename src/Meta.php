<?php

namespace Optix\Meta;

use Optix\Media\HasMedia;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasMedia;

    const OG_MEDIA_GROUP_NAME = 'og_image';
    const OG_CONVERSION_NAME = 'og_image';

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
        $this->addMediaGroup(self::OG_MEDIA_GROUP_NAME)->performConversions(self::OG_CONVERSION_NAME);
    }
}
