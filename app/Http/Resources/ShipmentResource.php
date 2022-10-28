<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResource extends JsonResource
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
            'shipment_number' => $this->shipment_number ?? '',
            'date' => $this->date ?? '',
            'states_name' => $this->status->name ?? '',
            'shipment_status_first_name' => $this->shipstatus->first()->name ?? '',
            'shipment_status_first_date' => date('d M Y', strtotime($this->shipstatus->first()->pivot->created_at)) ?? $this->created_at,
            'shipment_status_last_name' => $this->shipstatus->last()->name  ?? '',
            'shipment_status_last_date' => date('d M Y', strtotime($this->shipstatus->last()->pivot->created_at)) ?? '',
            'weight' => $this->weight ?? '',
            'volume' => $this->volume ?? '',
            'tracking_number' => $this->tracking_number ?? '',
            'created_at' => date('d M Y', strtotime($this->created_at)) ?? '',
            'freight' => $this->freight ?? '',
            'courier' => $this->shipcourier->name ?? '',
            'text' => $this->customer->name ?? '',
            'description' => $this->description ?? '',
            'packagetype' => $this->packagetype->name ?? '',
        ];
    }
}
