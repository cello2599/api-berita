<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\KomenModel;
use App\Models\BeritaModel;
use App\Models\User;

class KomenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_komen' => $this->id_komentar,
            'komen' => $this->komentar,
            'id_berita' => $this->id_berita,
            'id_user' => $this->id_user,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
            // 'berita' => BeritaModel::find($this->id_berita),
            // 'user' => User::find($this->id_user)
            
        ];
    }
}
