<?php

namespace App\Calisthenics\Domain\Student;

use App\Calisthenics\Domain\Video\Video;
use App\Calisthenics\Domain\Email\Email;
use App\Calisthenics\Domain\Address\Address;
use DateTimeInterface;

class Student
{
    private WatchedVideos $watchedVideos;

    public function __construct(private Email $email, private DateTimeInterface $bd, private string $fName, private string $lName, private Address $address)
    {
        $this->watchedVideos = new WatchedVideos();
    }

    public function getFullName(): string
    {
        return "{$this->fName} {$this->lName}";
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBd(): DateTimeInterface
    {
        return $this->bd;
    }

    public function age(): int
    {
        $today = new \DateTimeImmutable();
        $dateInterval = $this->bd->diff($today);
        return $dateInterval->y;
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
