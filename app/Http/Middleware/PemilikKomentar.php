<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\KomenModel;

class PemilikKomentar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $komen = KomenModel::find($request->id);

        if($user->id == $komen->id_user){
            return $next($request);
        }
        else{
            return response()->json([
                'message' => 'Anda bukan pemilik komen ini'
            ]);
        }

    }
}
