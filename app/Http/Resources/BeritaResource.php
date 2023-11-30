<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\BeritaController;

class BeritaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_berita' => $this->id_berita,
            'judul' => $this->judul,
            'isi' => $this->content,
            'kategori' => $this->nama_kategori,
            'tanggal' => date_format($this->created_at, 'd-m-Y H:i:s'),
            'penulis' => $this->username,
            'gambar' => $this->gambar,

        ];
    }
}
