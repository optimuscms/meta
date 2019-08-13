<?php

namespace Optix\Meta\Tests;

use Optimus\Media\MediaServiceProvider;
use Optix\Meta\MetaServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Create a table to allow us to mock a real implementation of an entity with HasMeta
        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        $this->withFactories(__DIR__.'/database/factories');
    }

    protected function getPackageProviders($app)
    {
        return [
            MediaServiceProvider::class,
            MetaServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
