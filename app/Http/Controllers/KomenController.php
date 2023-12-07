<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KomenModel;
use App\Models\BeritaModel;
use App\Http\Resources\KomenResource;
use Illuminate\Support\Facades\Auth;

class KomenController extends Controller
{
    //post data komen
    public function store(Request $request, $id){
        $berita = BeritaModel::find($id);

        if($berita){
            $validated = $request->validate([
                'komentar' => 'required',
            ]);

            $request['id_berita'] = $id;
            $request['id_user'] = Auth::user()->id;
            $komen = KomenModel::create($request->all());
            return new KomenResource($komen);
        }
        else{
            return response()->json([
                'message' => 'Berita tidak ditemukan'
            ]);
        }
    }

    //update data komen
    public function update(Request $request, $id){
        $komen = KomenModel::find($id);

        if($komen){
            $validated = $request->validate([
                'komentar' => 'required',
            ]);

            $komen->update($request->only('komentar'));
            return new KomenResource($komen);
        }
        else{
            return response()->json([
                'message' => 'Komentar tidak ditemukan'
            ]);
        }
    }

    //delete data komen
    public function destroy($id){
        $komen = KomenModel::find($id);

        if($komen){
            $komen->delete();
            return response()->json([
                'message' => 'Komentar berhasil dihapus'
            ]);
        }
        else{
            return response()->json([
                'message' => 'Komentar tidak ditemukan'
            ]);
        }
    }
}
