<?php

namespace Optix\Media;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
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
        'title', 'description', 'og_title', 'og_description', 'og_image_id', 'custom_tags',
    ];
}
