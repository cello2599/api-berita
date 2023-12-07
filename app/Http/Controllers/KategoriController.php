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

    //post data kategori
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required'
        ]);

        $kategori = KategoriModel::create($request->all());
        if ($kategori) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil ditambahkan',
                'data' => $kategori
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kategori gagal ditambahkan',
                'data' => ''
            ], 400);
        }
    }

    //update data kategori
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required'
        ]);

        $kategori = KategoriModel::find($id);
        if ($kategori) {
            $kategori->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil diupdate',
                'data' => $kategori
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kategori gagal diupdate',
                'data' => ''
            ], 400);
        }
    }

    //delete data kategori
    public function destroy($id)
    {
        $kategori = KategoriModel::find($id);
        if ($kategori) {
            $kategori->delete();
            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil dihapus',
                'data' => $kategori
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kategori gagal dihapus',
                'data' => ''
            ], 400);
        }
    }
}
