<?php


namespace Gregdmat\LaravelTestUtilities\src\DataCases\Concerns;


use Carbon\Carbon;
use Gregdmat\LaravelTestUtilities\DataCases\Concerns\TypeDataCases;

class DateDataCase extends TypeDataCases
{
    protected $config = 'date';

    public function past()
    {
        $year = rand(1, 500);
        return Carbon::today()->subYears($year)->toDate();
    }

    public function today()
    {
        return Carbon::today()->toDate();
    }

    public function future()
    {
        $year = rand(1, 500);
        return Carbon::today()->addYears($year)->toDate();
    }

    public function string()
    {
        return Carbon::today()->toDateTimeString();
    }

    public function null()
    {
        return null;
    }
}
