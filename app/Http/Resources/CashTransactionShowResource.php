<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashTransactionShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'user_id' => $this->user_id,
            'bill' => indonesian_currency($this->bill),
            'amount' => indonesian_currency($this->amount),
            'date' => date('d-m-Y', strtotime($this->date)),
            'note' => $this->note,
            'students' => [
                'id' => $this->students->id,
                'name' => $this->students->name
            ],
            'users' => [
                'id' => $this->users->id,
                'name' => $this->users->name
            ]
        ];
    }
}
