<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeritaModel;
use App\Http\Resources\BeritaResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    //post data berita
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'content' => 'required',
            'kategori' => 'required',
        ]);

        //request file
        if($request->file){
            $extension = $request->file->extension();
            //pengujian apakah file gambar atau tidak
            if($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg'){
                $filename = time() . '.' . $extension;
                Storage::putfileAs('public/images', $request->file, $filename);
            }
            else{
                return response()->json([
                    'message' => 'File yang diupload bukan gambar'
                ]);
            }
        }
        else{
            return response()->json([
                'message' => 'Tidak ada file yang diupload'
            ]);
        }

        $request['penulis'] = Auth::user()->id;
        $request['gambar'] = $filename;
        //join table
        $berita = BeritaModel::create($request->all());
        $berita = BeritaModel::join('kategori', 'berita.kategori', '=', 'kategori.id_kategori')
            ->join('users', 'berita.penulis', '=', 'users.id')
            ->select('berita.*', 'kategori.nama_kategori', 'users.username')
            ->where('berita.id_berita', $berita->id_berita)
            ->first();

        return new BeritaResource($berita);
    }

    //get data by id
    public function show($id)
    {
        $berita = BeritaModel::join('kategori', 'berita.kategori', '=', 'kategori.id_kategori')
            ->join('users', 'berita.penulis', '=', 'users.id')
            ->select('berita.*', 'kategori.nama_kategori', 'users.username')
            ->where('berita.id_berita', $id)
            ->first();
        return new BeritaResource($berita);
    }

    //update data
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'content' => 'required',
            'kategori' => 'required',
        ]);

        //jika tidak melakukan update gambar
        if($request->file == null){
            $berita = BeritaModel::FindOrFail($id);
            $filename = $berita->gambar;
        }
        //jika melakukan update gambar
        else{
            $extension = $request->file->extension();
            //pengujian apakah file gambar atau tidak
            if($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg'){
                $filename = time() . '.' . $extension;
                Storage::putfileAs('public/images', $request->file, $filename);
            }
            //jika bukan gambar
            else{
                return response()->json([
                    'message' => 'File yang diupload bukan gambar'
                ]);
            }
        }
        
        $request['gambar'] = $filename;
        $request['penulis'] = Auth::user()->id;

        $berita = BeritaModel::FindOrFail($request->$id);
        //jika user yang login bukan penulis berita
        if ($request['penulis'] != $berita->penulis) {
            return response()->json([
                'message' => 'Anda tidak memiliki akses untuk mengubah data ini'
            ]);
        }
        //join table
        $berita->update($request->all());
        $berita = BeritaModel::join('kategori', 'berita.kategori', '=', 'kategori.id_kategori')
            ->join('users', 'berita.penulis', '=', 'users.id')
            ->select('berita.*', 'kategori.nama_kategori', 'users.username')
            ->where('berita.id_berita', $id)
            ->first();

        return new BeritaResource($berita);
    }

    //get data by kategori
    public function showByKategori($id)
    {
        $berita = BeritaModel::join('kategori', 'berita.kategori', '=', 'kategori.id_kategori')
            ->join('users', 'berita.penulis', '=', 'users.id')
            ->select('berita.*', 'kategori.nama_kategori', 'users.username')
            ->where('berita.kategori', $id)
            ->get();
        return BeritaResource::collection($berita);
    }

    //delete data
    public function destroy($id)
    {
        $berita = BeritaModel::FindOrFail($id);
        //jika user yang login bukan penulis berita
        if (Auth::user()->id != $berita->penulis) {
            return response()->json([
                'message' => 'Anda tidak memiliki akses untuk menghapus data ini'
            ]);
        }
        //hapus gambar
        Storage::delete('public/images/' . $berita->gambar);

        //soft delete
        $berita->delete();
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
