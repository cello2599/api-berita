<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomenModel extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $primaryKey = 'id_komentar';
    protected $fillable = [
        'id_berita',
        'id_user',
        'komentar',
        'created_at',
        'updated_at'
    ];

}
