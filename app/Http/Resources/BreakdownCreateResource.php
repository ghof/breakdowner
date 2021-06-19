<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BreakdownCreateResource extends JsonResource
{
    public function toArray($request): array
    {
        return $this->breakdown_array;
    }
}
