<?php

namespace App\Providers;


use App\Helpers\BreakdownDateTime;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class CarbonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @param BreakdownDateTime $breakdownDateTime
     * @return void
     */
    public function boot(BreakdownDateTime $breakdownDateTime)
    {
        Carbon::macro('breakdownDiffArray',
            fn(Carbon $end, string $timeExpressions = 'm,d,h,i,s') => $breakdownDateTime->breakdownArray($this->clone(), $end, $timeExpressions)
        );
        Carbon::macro('breakdownDiffJson',
            fn(Carbon $end, string $timeExpressions = 'm,d,h,i,s') => $breakdownDateTime->breakdownJson($this->clone(), $end, $timeExpressions)
        );
    }
}
