<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeritaModel;
use App\Http\Resources\BeritaResource;

class BeritaController extends Controller
{
    //get all data
    public function index()
    {
        $berita = BeritaModel::all();
        //join table
        $berita = BeritaModel::join('kategori', 'berita.kategori', '=', 'kategori.id_kategori')
            ->join('users', 'berita.penulis', '=', 'users.id')
            ->select('berita.*', 'kategori.nama_kategori', 'users.username')
            ->get();
        return BeritaResource::collection($berita);
    }
}
