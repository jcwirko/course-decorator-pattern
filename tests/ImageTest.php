<?php

namespace Styde\tests;

use Styde\Image;

class ImageTest extends TestCase
{

    /* @test */
    function it_can_draw_an_image()
    {
        $image = new Image(assets_path('img/decorator.jpeg'));

        imagejpeg($image->draw(), storage_path('basic_image.jpeg'));

        if (!file_exists(__DIR__ . 'snapshots/basic_image.jpeg')) {
            imagejpeg($image->draw(), storage_path('basic_image.jpeg'));
        }

        $this->assertTrue(
            file_get_contents(assets_path('img/decorator.jpeg')) === file_get_contents(storage_path('basic_image.jpeg')),
            "The drawn image does not match the expected image [img/decorator.jpeg]"
        );
    }

}