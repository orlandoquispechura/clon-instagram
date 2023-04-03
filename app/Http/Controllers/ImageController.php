<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        return view('admin.image.create');
    }

    public function store(Request $request)
    {
        $reglas = ([
            'ruta_imagen' => 'required|mimes:jpg,png,jpeg,gif',
            'descripcion' => 'nullable|string|max:255',
        ]);
        $mensage = ([
            'ruta_imagen.required' => 'Deve seleccionar alguna imagen.',
            'ruta_imagen.mimes' => 'Solo acepta jpg,png,jpeg,gif.',
        ]);
        $this->validate($request, $reglas, $mensage);


        try {
            DB::beginTransaction();
            $imagen_path = $request->file('ruta_imagen');
            $descripcion = $request->input('descripcion');

            $user = Auth::user();
            $imagen = new Image();
            $imagen->user_id = $user->id;
            $imagen->descripcion = $descripcion;

            if ($imagen_path) {
                $nombre_imagen = time() . $imagen_path->getClientOriginalName();
                Storage::disk('images')->put($nombre_imagen, File::get($imagen_path));
                $imagen->ruta_imagen = $nombre_imagen;
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->action([HomeController::class, 'index'])
                ->with('error', 'No se pudo subir imágenes!!!');
        }
        $imagen->save();
        return redirect()->action([HomeController::class, 'index'])
            ->with('success', 'Se subió la imágen correctamente!!!');
    }

    public function getImagen($img)
    {
        $image = Storage::disk('images')->get($img);
        return new Response($image, 200);
    }

    public function show($id)
    {
        $image = Image::find($id);
        return view('admin.image.show', compact('image'));
    }

    public function delete($id)
    {
        $user = Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if ($user && $image && $image->user->id == $user->id) {
            //eliminar comentarios 
            if ($comments && Count($comments) >= 1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            //eliminar likes
            if ($likes && Count($likes) >= 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            // eliminar ficheros de la imagen
            Storage::disk('images')->delete($image->ruta_imagen);

            // eliminar registro imagen
            $image->delete();

            return redirect()->action([HomeController::class, 'index'])
                ->with('img-delete', 'Se eliminó la imagen.');
        } else {
            return redirect()->action([HomeController::class, 'index'])
                ->with('img-delete-error', 'Error al eliminar la imagen.');
        }
    }

    public function edit($id)
    {
        $user = Auth::user();
        $image = Image::find($id);

        if ($user && $image && $image->user->id == $user->id) {
            return view('admin.image.edit', compact('image'));
        } else {
            return redirect()->action([HomeController::class, 'index']);
        }
    }

    public function update(Request $request)
    {
        // validaciones para editar
        $reglas = ([
            'ruta_imagen' => 'mimes:jpg,png,jpeg,gif',
            'descripcion' => 'nullable|string|max:255',
        ]);
        $mensage = ([
            'ruta_imagen.mimes' => 'Solo se acepta jpg,png,jpeg,gif.',
        ]);
        $this->validate($request, $reglas, $mensage);

        //obtener los datos del formulario
        $image_id = $request->input('image_id');
        $imagen_path = $request->file('ruta_imagen');
        $descripcion = $request->input('descripcion');

        // conseguir ibjeto de Imagen
        $imagen = Image::find($image_id);
        $imagen->descripcion = $descripcion;

        if ($imagen_path) {
            $nombre_imagen = time() . $imagen_path->getClientOriginalName();
            Storage::disk('images')->put($nombre_imagen, File::get($imagen_path));
            $imagen->ruta_imagen = $nombre_imagen;
        }

        // actualizar regitro 
        $imagen->update();

        return redirect()->route('admin.image.show', ['id' => $image_id])
            ->with('update', 'Se actualizó la foto.');
    }
}
