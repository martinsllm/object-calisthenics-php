<?php

namespace App\Calisthenics\Domain\Student;

use App\Calisthenics\Domain\Video\Video;
use App\Calisthenics\Domain\Email\Email;
use App\Calisthenics\Domain\Address\Address;
use DateTimeInterface;

class Student
{
    private WatchedVideos $watchedVideos;

    public function __construct(private Email $email, private DateTimeInterface $birthDate, private string $firstName, private string $lastName, private Address $address)
    {
        $this->watchedVideos = new WatchedVideos();
    }

    public function fullName(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function email(): string
    {
        return $this->email;
    }

    public function birthDate(): DateTimeInterface
    {
        return $this->birthDate;
    }

    public function age(): int
    {
        $today = new \DateTimeImmutable();
        $dateInterval = $this->birthDate->diff($today);
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
