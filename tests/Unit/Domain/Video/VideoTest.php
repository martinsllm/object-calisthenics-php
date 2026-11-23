<?php

namespace App\Calisthenics\Tests\Unit\Domain\Video;

use App\Calisthenics\Domain\Video\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    public function testMakingVideoPublicMustWork()
    {
        $video = new Video();
        $video->publish();

        self::assertSame(Video::PUBLIC, $video->getVisibility());
    }
}
