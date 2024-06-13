<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "created_at" =>  $this->created_at,
            "email" => $this->email,
            "email_verified_at" => $this->email_verified_at,
            "id" => $this->id,
            "isActive" => $this->isActive == true ? 'Aktif' : 'Tidak Aktif',
            "jobposition" => $this->job_position_id == null ? ['name' => 'Tidak ada jabatan'] : new JobPositionResource($this->jobPosition),
            "name" => $this->name,
            "nik" => $this->nik,
            "nip" => $this->nip,
            "phone_number" => $this->phone_number,
            "photo" => $this->photo,
            "role" => $this->role,
            "updated_at" => $this->updated_at,
            "username" => $this->username,
        ];
    }
}
