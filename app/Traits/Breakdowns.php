<?php


namespace App\Traits;


use Carbon\Carbon;
use Illuminate\Support\Collection;

trait Breakdowns
{

    private function getSecondsPerInterval($interval)
    {
        $DaysPerMonth = 30;
        $secondsPerMinute = 60;
        $minutesPerHour = 60;
        $hoursPerDay = 24;
        switch ($interval) {
            case 'm':
                return $secondsPerMinute * $minutesPerHour * $hoursPerDay * $DaysPerMonth;
            case 'd':
                return $secondsPerMinute * $minutesPerHour * $hoursPerDay;
            case 'h':
                return $secondsPerMinute * $minutesPerHour;
            case 'i':
                return $secondsPerMinute;
            case 's':
                return 1;
        }
    }


    private function explode(string $timeExpressions): Collection
    {
        return collect(explode(',', $timeExpressions));
    }

    private function timeUnit(string $timeExpression): string
    {
        return substr($timeExpression, -1);
    }

    private function timeUnitNumber(string $timeExpression): int
    {
        $timeUnitNumber = (int)substr($timeExpression, 0, -1);
        if (!$timeUnitNumber) {
            $timeUnitNumber = 1;
        }
        return $timeUnitNumber;
    }

    private function numberOfTimes(int &$diffInSeconds, string $timeExpression, string $lastTimeExpression): float|int
    {
        $timeUnit = $this->timeUnit($timeExpression);
        $timeUnitNumber = $this->timeUnitNumber($timeExpression);
        $secondsPerInterval = $this->getSecondsPerInterval($timeUnit);
        $times = $diffInSeconds / ($timeUnitNumber * $secondsPerInterval);
        $diffInSeconds -= (int)$times * $secondsPerInterval;
        return ($timeExpression == $lastTimeExpression ? $times : (int)$times);
    }

    private function breakdownCollection(Carbon $start, Carbon $end, string $timeExpressions): Collection
    {
        $diffInSeconds = $start->diffInSeconds($end);
        $timeExpressions = $this->explode($timeExpressions);
        $lastTimeExpression = $timeExpressions->last();
        $array = [];
        foreach ($timeExpressions as $timeExpression) {
            $array[$timeExpression] = $this->numberOfTimes($diffInSeconds, $timeExpression, $lastTimeExpression);
        }
        return collect($array);
    }

}
