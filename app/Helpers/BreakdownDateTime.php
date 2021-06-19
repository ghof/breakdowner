<?php


namespace App\Helpers;


use App\Traits\Breakdowns;
use Carbon\Carbon;

class BreakdownDateTime extends Carbon
{
    use Breakdowns;

    public function breakdownArray(Carbon $start, Carbon $end, string $timeExpressions): array
    {
        return $this->breakdownCollection($start, $end, $timeExpressions)->toArray();
    }

    public function breakdownJson(Carbon $start, Carbon $end, string $timeExpressions): string
    {
        return $this->breakdownCollection($start, $end, $timeExpressions)->toJson();
    }
}
