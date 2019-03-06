<?php

namespace Styde\tests;

use Styde\Image;

class ImageTest extends \PHPUnit\Framework\TestCase
{

    /** @test */
    function it_can_draw_an_image()
    {
        $image = new Image(assets_path('img/decorator.jpeg'));

        $this->assertImageEquals('basic_image.jpeg', $image);
    }


    /** @test */
    function it_can_draw_an_resized_image()
    {
        $image = new Image(assets_path('img/decorator.jpeg', null, null, true));

        $this->assertImageEquals('grayscale_image.jpeg', $image);
    }

    /** @test */
    function it_can_draw_a_grayscale_image()
    {
        $image = new Image(assets_path('img/decorator.jpeg', 500, 300));

        $this->assertImageEquals('rezised_image.jpeg', $image);
    }

    /** @test */
    function it_can_draw_a_framed_image()
    {
        $image = new Image(assets_path('img/decorator.jpeg', null, null, false, true));

        $this->assertImageEquals('framed_image.jpeg', $image);
    }

    /** @test */
    function it_can_draw_an_resized_grayscale_frame_image()
    {
        $image = new Image(assets_path('img/decorator.jpeg', 500, 333, true, 5));

        $this->assertImageEquals('resized-grayscale.jpeg', $image);
    }


    protected function assertImageEquals($fileName, $image)
    {
        if (!file_exists($this->snapshotsPath($fileName))) {
            imagejpeg($image->draw(), $this->snapshotsPath($fileName));
            $this->markTestIncomplete("The snapshot didnt exist and was created");
        }

        imagejpeg($image->draw(), storage_path($fileName));


        $this->assertTrue(
            file_get_contents($this->snapshotsPath($fileName)) === file_get_contents(storage_path($fileName)),
            "The drawn image does not match the expected image [img/decorator.jpeg]"
        );
    }

    public function snapshotsPath($filename)
    {
        return __DIR__ . '/snapshots/' . $filename;
    }

}