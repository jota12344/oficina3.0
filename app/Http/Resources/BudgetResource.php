<?php

namespace App\Http\Resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BudgetResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'client'           => $this->client,
            'budget_datetime'  => Carbon::parse($this->budget_datetime)->format('d/m/Y H:i'),
            'estimated_value'  => number_format($this->estimated_value, 2, ',', '.'),
            'seller'           => $this->seller,
        ];
    }
}
