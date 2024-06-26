<?php

namespace App\Repositories;

use App\Interfaces\DateInterface;
use Carbon\Carbon;

class DateRepository implements DateInterface
{
    private $date;
    public function __construct(Carbon $date)
    {
        $this->date = $date;
    }
    public function getDate()
    {
        // return $this->date::today()->subYear(1)->subMonth(3);
        return $this->date::today()->subYear(1)->addMonth(1);
    }
    public function getTime()
    {
        return $this->date::now()->format('H:i:s');
    }
}
