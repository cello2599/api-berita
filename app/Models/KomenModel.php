<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KomenModel extends Model
{
    use HasFactory, SoftDeletes;

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
