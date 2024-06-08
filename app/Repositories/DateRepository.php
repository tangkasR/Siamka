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
        return $this->date::today()->addMonth(1);
    }
}
