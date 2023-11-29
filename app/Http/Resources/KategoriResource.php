<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\KategoriModel;
use App\Http\Controllers\KategoriController;

class KategoriResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id_kategori' => $this->id_kategori,
            'nama_kategori' => $this->nama_kategori,
        ];
    }
}
