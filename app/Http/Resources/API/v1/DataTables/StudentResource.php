<?php

namespace App\Http\Resources\API\v1\DataTables;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'school_class_id' => $this->school_class_id,
            'school_class' => [
                'id' => $this->schoolClass->id,
                'name' => $this->schoolClass->name,
            ],
            'school_major_id' => $this->school_major_id,
            'school_major' => [
                'id' => $this->schoolMajor->id,
                'name' => $this->schoolMajor->name,
            ],
            'student_identification_number' => $this->student_identification_number,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'gender_name' => $this->getGenderName(),
            'school_year_start' => $this->school_year_start,
            'school_year_end' => $this->school_year_end,
        ];
    }
}
