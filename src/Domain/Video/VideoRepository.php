<?php

namespace App\Calisthenics\Domain\Video;

use App\Calisthenics\Domain\Student\Student;

interface VideoRepository
{
    public function add(Video $video): void;
    public function videosFor(Student $student): array;
}
