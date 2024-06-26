<?php

namespace App\Services;

use App\Interfaces\DateInterface;

class DateService
{
    private $date;
    public function __construct(DateInterface $date)
    {
        $this->date = $date;
    }
    public function getDate()
    {
        return $this->date->getDate();
    }
    public function getTime()
    {
        return $this->date->getTime();
    }
}
