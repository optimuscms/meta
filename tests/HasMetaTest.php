<?php

namespace Optix\Meta\Tests;

use Optix\Meta\Meta;
use Optix\Meta\HasMeta;
use Optix\Media\Models\Media;
use Optix\Meta\Tests\Models\Subject;
use Illuminate\Support\Facades\Queue;
use Optix\Media\Jobs\PerformConversions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class HasMetaTest extends TestCase
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
    public function it_registers_the_meta_relationship()
    {
        $this->assertInstanceOf(MorphOne::class, $this->subject->meta());
    }

    /** @test */
    public function it_saves_meta_data()
    {
        $title = 'Meta Title';
        $this->subject->saveMeta(['title' => $title]);
        $this->assertInstanceOf(Meta::class, $this->subject->meta);
        $this->assertEquals($title, $this->subject->meta->title);
    }

    /** @test */
    public function it_saves_og_image()
    {
        Queue::fake();
        $media = factory(Media::class)->create();

        $this->subject->saveMeta(['og_image_id' => $media->id]);
        $ogImage = $this->subject->meta->getOgImage();
        $this->assertInstanceOf(Media::class, $ogImage);
        $this->assertNotEmpty($ogImage->name);
        $this->assertEquals($media->name, $ogImage->name);
    }

    /** @test */
    public function it_performs_og_image_conversions()
    {
        Queue::fake();
        $conversions = [Meta::OG_MEDIA_CONVERSION];
        $media = factory(Media::class)->create();

        $this->subject->saveMeta(['og_image_id' => $media->id]);

        Queue::assertPushed(
            PerformConversions::class, function ($job) use ($media, $conversions) {
                return $media->is($job->getMedia())
                    && empty(array_diff($conversions, $job->getConversions()));
            }
        );
    }
}
