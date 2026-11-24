<?php

namespace App\Calisthenics\Domain\Student;

use App\Calisthenics\Domain\Video\Video;
use App\Calisthenics\Domain\Email\Email;
use App\Calisthenics\Domain\Address\Address;
use DateTimeInterface;
use Ds\Map;

class Student
{
    private Email $email;
    private DateTimeInterface $bd;
    private Map $watchedVideos;
    private string $fName;
    private string $lName;
    private Address $address;

    public function __construct(Email $email, DateTimeInterface $bd, string $fName, string $lName, Address $address)
    {
        $this->watchedVideos = new Map();
        $this->email = $email;
        $this->bd = $bd;
        $this->fName = $fName;
        $this->lName = $lName;
        $this->address = $address;
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

    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->put($video, $date);
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
        $this->watchedVideos->sort(fn (DateTimeInterface $dateA, DateTimeInterface $dateB) => $dateA <=> $dateB);
       
        $firstDate = $this->watchedVideos->first()->value;
        $today = new \DateTimeImmutable();

        return $firstDate->diff($today)->days < 90;
    }
}
