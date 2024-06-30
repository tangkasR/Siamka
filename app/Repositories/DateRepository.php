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
        return $this->date::today();
        // return $this->date::today()->subYear(3)->addMonth(1);
        // return $this->date::today()->subYear(2)->subMonth(2);

        // return $this->date::today()->subYear(2)->addMonth(1);
        // return $this->date::today()->subYear(1)->subMonth(2);

        // return $this->date::today()->subYear(1)->addMonth(1);
        // return $this->date::today()->subMonth(3);
    }
    public function getTime()
    {
        return $this->date::now()->format('H:i:s');
    }
}
