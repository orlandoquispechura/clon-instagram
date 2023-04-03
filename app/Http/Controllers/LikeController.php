<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $listaLikes = Like::Where('user_id', $user->id)
            ->OrderBy('id', 'desc')->paginate(4);
        return view('admin.like.index', compact('listaLikes'));
    }

    public function like($image_id)
    {
        //  recoger datos IDs de usuario y la imagen
        $user = Auth::user();

        // condición para verificar si ya existe el like y no duplicarlo
        $hay_like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->count();

        if ($hay_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
            $like->save();
            return response()->json([
                'like' => $like,
                'mensage' => 'like correctamente'
            ]);
        } else {
            return response()->json([
                'mensage' => 'EL like ya existe!'
            ]);
        }
    }

    public function dislike($image_id)
    {

        //  recoger datos IDs de usuario y la imagen
        $user = Auth::user();

        // condición para verificar si ya existe el like y no duplicarlo
        $like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->first();

        if ($like) {

            $like->delete();

            return response()->json([
                'like' => $like,
                'mensage' => 'dislike correctamente'
            ]);
        } else {
            return response()->json([
                'mensage' => 'EL dislike ya existe!'
            ]);
        }
    }
}
