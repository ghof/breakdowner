<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breakdown extends Model
{
    protected $fillable = [
        'starts_at',
        'ends_at',
        'time_expression'
    ];
    use HasFactory;

    public function scopeWithinInterval($query, $start, $end)
    {
        return $query->where('starts_at', '<=', Carbon::parse($start))->where('ends_at', '>=', Carbon::parse($end));
    }

    public function getBreakdownArrayAttribute()
    {
        return Carbon::parse($this->starts_at)->breakdownDiffArray(Carbon::parse($this->ends_at), $this->time_expression);
    }
}
