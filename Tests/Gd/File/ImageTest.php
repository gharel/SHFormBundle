<?php

namespace SymfonyHackers\Bundle\FormBundle\Tests\Gd\File;

use PHPUnit\Framework\TestCase;
use SymfonyHackers\Bundle\FormBundle\Gd\File\Image;
use SymfonyHackers\Bundle\FormBundle\Gd\Filter\Background;

class ImageTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        if (!function_exists('gd_info')) {
            $this->markTestSkipped('Gd not installed');
        }
    }

    public function testImage()
    {
        $image = new Image(__DIR__ . '/../../Fixtures/upload/symfony.png');

        $this->assertEquals(160, $image->getWidth());
        $this->assertEquals(134, $image->getHeight());
    }

    public function testBlackImage()
    {
        $image = new Image(__DIR__ . '/../../Fixtures/upload/black.png');

        $base64 = $image->getBase64();

        $this->assertEquals(16, $image->getWidth());
        $this->assertEquals(16, $image->getHeight());
        $this->assertEquals('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAEElEQVQokWNgGAWjYBTAAAADEAABC3uRhAAAAABJRU5ErkJggg==', $base64);
    }

    public function testChangeBackgroundBlackImage()
    {
        $image = new Image(__DIR__ . '/../../Fixtures/upload/black.png');
        $image->getGd()->addFilter(new Background('#FFF'));

        $base64 = $image->getBase64();

        $this->assertEquals(16, $image->getWidth());
        $this->assertEquals(16, $image->getHeight());
        $this->assertEquals('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAGUlEQVQokWP8//8/AymAiSTVoxpGNQwpDQBVbQMd5EZaEgAAAABJRU5ErkJggg==', $base64);
    }

    public function testCropImage()
    {
        $image = new Image(__DIR__ . '/../../Fixtures/upload/black.png');
        $image->addFilterCrop(0, 0, 5, 5);

        $base64 = $image->getBase64();

        $this->assertEquals(5, $image->getWidth());
        $this->assertEquals(5, $image->getHeight());
    }
}
