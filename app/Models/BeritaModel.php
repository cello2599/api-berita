<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BeritaModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    protected $fillable = [
        'judul',
        'content',
        'gambar',
        'penulis',
        'kategori',
        'created_at',
        'updated_at'
    ];
}
