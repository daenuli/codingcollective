<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CandidateResource
 * @OA\Schema(
 * )
 */

class CandidateResource extends JsonResource
{
    /**
     * @OA\Property(format="int64", example=1, description="ID", property="id", type="integer"),
     * @OA\Property(format="string", example="smith", description="name of the new candidate", property="name", type="integer"),
     * @OA\Property(format="string", example="smith@gmail.com", description="email of the new candidate", property="email", type="string")
     * @OA\Property(format="date", example="1991-01-19", description="birth date of the new candidate", property="birth_date", type="string")
     * @OA\Property(format="int64", example="62819157421", description="phone number of new candidate", property="phone_number", type="integer"),
     * @OA\Property(format="int64", example="5", description="experience of new candidate", property="experience", type="integer"),
     * @OA\Property(format="string", example="Universitas Gadjah Mada", description="education of new candidate", property="education", type="string"),
     * @OA\Property(format="string", example="CEO", description="last position of new candidate", property="last_position", type="string"),
     * @OA\Property(format="string", example="Senior PHP Developer", description="applied position of new candidate", property="applied_position", type="string"),
     * @OA\Property(format="string", example="Laravel, Mysql, PostgreSQL, Codeigniter, Java", description="skill of new candidate", property="skill", type="string"),
     * @OA\Property(format="binary", example="https://media.neliti.com/media/publications/346316-retraction-notice-to-komparasi-algoritma-f20c03c4.pdf", description="resume file of new candidate", property="resume_file", type="string")
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'experience' => $this->experience,
            'education' => $this->education,
            'birth_date' => $this->birth_date,
            'last_position' => $this->last_position,
            'applied_position' => $this->applied_position,
            'skill' => $this->skill,
            'resume' => ($this->resume) ? asset('uploads/'.$this->resume) : null,
        ];
    }
}