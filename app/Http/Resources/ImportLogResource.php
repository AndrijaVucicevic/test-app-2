<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImportLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $array = explode('_', $this->import_type);
        $value = json_decode(json_decode($this->config)->value);
        $fileKey = $array[1];

        return [
            'id' => $this->id,
            'validation' => $value->files->$fileKey->validation
        ];
    }
}
