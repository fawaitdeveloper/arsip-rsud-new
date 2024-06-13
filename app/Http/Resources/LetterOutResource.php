<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LetterOutResource extends JsonResource
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
            'category' => new LetterCategoryResource($this->category),
            'urgency' => new LetterUrgencyResource($this->urgency),
            'attribute' => new LetterAttributeResource($this->attribute),
            'sender_name' => $this->sender_name,
            'receive_name' => $this->receive_name,
            'receive_position' => $this->receive_position,
            'sender_position' => $this->sender_position,
            'sender_instansi' => $this->sender_instansi,
            'letter_number' => $this->letter_number,
            'letter_date' => $this->letter_date,
            'letter_received' => $this->letter_received,
            'letter_file' => $this->letter_file,
            'type' => $this->type,
            'about' => $this->about,
            'description' => $this->description,
            'attachment_file_id' => $this->attachment_file_id,
            'letter_refrency_id' => $this->letter_refrency_id,
            'code' => $this->code,
            'job_position_id' => $this->job_position_id,
            'access' => $this->access,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            "group" => $this->group
        ];
    }
}
