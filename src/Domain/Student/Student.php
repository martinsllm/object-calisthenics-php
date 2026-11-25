<?php

namespace App\Calisthenics\Domain\Student;

use App\Calisthenics\Domain\Video\Video;
use App\Calisthenics\Domain\Person\Person;
use App\Calisthenics\Domain\Person\Email;
use App\Calisthenics\Domain\Person\FullName;
use App\Calisthenics\Domain\Person\Address;
use DateTimeInterface;

class Student extends Person
{
    private WatchedVideos $watchedVideos;
    
    public function __construct(Email $email, DateTimeInterface $birthDate, FullName $fullName, Address $address)
    {
        parent::__construct($email, $birthDate, $fullName, $address);
        $this->watchedVideos = new WatchedVideos();
    }

    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->add($video, $date);
    }

    public function hasAccess(): bool
    {
        if ($this->watchedVideos->count() === 0) {
            return true;
        } 

        return $this->isFirstWatchedVideoInLessThan90Days();
    }

    private function isFirstWatchedVideoInLessThan90Days(): bool
    {
        $firstDate = $this->watchedVideos->dateOfFirstVideo();
        $today = new \DateTimeImmutable();

        return $firstDate->diff($today)->days < 90;
    }
}
