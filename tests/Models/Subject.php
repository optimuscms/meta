<?php

namespace Optix\Meta\Tests\Models;

use Optix\Meta\HasMeta;
use Illuminate\Database\Eloquent\Model;

/**
 * A mock implementation of a Model that uses HasMeta for testing
 */
class Subject extends Model
{
    use HasMeta;
}
