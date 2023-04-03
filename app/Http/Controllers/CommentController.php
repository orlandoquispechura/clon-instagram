<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        //  validar las entradas    
        $reglas = ([
            'image_id' => 'integer|required',
            'contenido' => 'required|max:255',
            // 'user_id' => 'integer|required',
        ]);
        $mensage = ([
            'contenido.required' => 'Debe escribir un comentario, luego enviar.',
            'contenido.max' => 'Solo puede digitar 255 caracteres.',
        ]);
        $this->validate($request, $reglas, $mensage);

        $user = Auth::user();
        $image_id = $request->input('image_id');
        $contenido = $request->input('contenido');

        $comment = new Comment();
        $comment->image_id = $image_id;
        $comment->contenido = $contenido;
        $comment->user_id = $user->id;

        $comment->save();
        return redirect()->route('admin.image.show', ['id' => $image_id])
            ->with('success-comment', 'Has comentado la foto.');
    }
    public function delete($id)
    {
        $user = Auth::user();
        $comment = Comment::find($id);

        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();
            return redirect()->route('admin.image.show', ['id' => $comment->image->id])
                ->with('success-delete', 'Eliminaste el comentario!!!');
        } else {
            return redirect()->route('admin.image.show', ['id' => $comment->image->id])
                ->with('error-delete', 'No se eliminó el comentario!!!');
        }
    }
}
