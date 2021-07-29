<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'id' => $this->id,
            'school_class_id' => $this->school_class_id,
            'school_major_id' => $this->school_major_id,
            'student_identification_number' => $this->student_identification_number,
            'name' => $this->name,
            'gender' => $this->gender,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'school_year_start' => $this->school_year_start,
            'school_year_end' => $this->school_year_end,
            'school_classes' => new SchoolClassResource($this->school_classes),
            'school_majors' => new SchoolMajorResource($this->school_majors)
        ];
    }
}
