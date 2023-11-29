<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use App\Http\Resources\KategoriResource;

class KategoriController extends Controller
{
    //get all data
    public function index()
    {
        $kategori = KategoriModel::all();
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Daftar data kategori',
        //     'data' => $kategori
        // ], 200);
        return KategoriResource::collection($kategori);
    }
}
