<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start_date'=> $this->start_date,
            'end_date' => $this->end_date,
            'is_completed' => $this->is_completed,
            'formatted_start_date' => formatDate('Y-m-d h:i A', $this->start_date),
            'formatted_end_date' => formatDate('Y-m-d h:i A', $this->end_date),
        ];
    }
}
