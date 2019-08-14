<?php

namespace Optix\Meta\Tests;

use Optix\Meta\Meta;
use Optix\Meta\HasMeta;
use Optix\Media\Models\Media;
use Optix\Meta\Tests\Models\Subject;
use Illuminate\Support\Facades\Queue;
use Optimus\Media\Http\Resources\MediaResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MetaTest extends TestCase
{
    use RefreshDatabase;

    /** @var HasMeta */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = Subject::create();
    }

    /** @test */
    public function it_presents_og_image()
    {
        $meta = new Meta();
        $representation = $meta->toArray();

        $this->assertArrayHasKey('og_image', $representation);
    }

    /** @test */
    public function it_presents_og_image_as_media()
    {
        Queue::fake();
        $media = factory(Media::class)->create();

        $this->subject->saveMeta(['og_image_id' => $media->id]);
        $representation = $this->subject->toArray();

        $this->assertInstanceOf(MediaResource::class, $representation['meta']['og_image']);
    }
}
