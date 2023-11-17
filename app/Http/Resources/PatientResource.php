<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? null,
            'full_name' => $this->full_name,
            'mother_full_name' => $this->mother_full_name,
            'birthday' => $this->birthday,
            'cpf' => $this->cpf,
            'cns' => $this->cns,
            'photo' => $this->photo ?? null,
            'address_id' => $this->address_id ?? null,
            'zipcode' => $this->address->zipcode,
            'street' => $this->address->street,
            'number' => $this->address->number,
            'complement' => $this->address->complement,
            'district' => $this->address->district,
            'city' => $this->address->city,
            'state' => $this->address->state,
        ];
    }
}
