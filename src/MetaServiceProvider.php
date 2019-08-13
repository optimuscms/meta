<?php

namespace Optix\Meta;

use Intervention\Image\Image;
use Optix\Media\Facades\Conversion;
use Illuminate\Support\ServiceProvider;

class MetaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        Conversion::register(Meta::OG_MEDIA_CONVERSION, function (Image $image) {
            return $image->fit(1200, 630);
        });
    }
}
