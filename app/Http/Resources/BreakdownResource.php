<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BreakdownResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "starts_at" => $this->starts_at,
            "ends_at" => $this->ends_at,
            "time_expression" => $this->time_expression,
            "breakdown_array" => $this->breakdown_array,
        ];
    }
}
