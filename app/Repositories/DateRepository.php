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
    }
    public function getTime()
    {
        return $this->date::now()->format('H:i:s');
    }
}
