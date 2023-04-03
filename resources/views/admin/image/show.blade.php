<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9 m-auto mb-4">
                @if (session('success-comment'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ ' ' . session('success-comment') }}
                    </div>
                @elseif(session('success-delete'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ ' ' . session('success-delete') }}
                    </div>
                @elseif(session('error-delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ ' ' . session('error-delete') }}
                    </div>
                @elseif(session('update'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ ' ' . session('update') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $image->user->name }}</h4>
                    </div>
                    <div class="card-body p-0">
                        <div style="max-height:700px; overflow: hidden;">
                            <img style="width: 100%; height: 100%"
                                src="{{ route('admin.image.file', ['img' => $image->ruta_imagen]) }}" alt=" logo ">
                        </div>
                        <div style="padding: 3px 15px">
                            <strong>{{ '@' . $image->user->name }}</strong>
                            <strong>{{ ' | ' . $image->created_at->diffForHumans() }}</strong>
                            <p style=" margin-bottom: 0px">
                                {{ $image->descripcion }}
                            </p>
                        </div>
                        <div style="padding:15px">
                            <?php $user_like = false; ?>
                            @foreach ($image->likes as $like)
                                @if ($like->user->id == Auth::user()->id)
                                    <?php $user_like = true; ?>
                                @endif
                            @endforeach
                            @if ($user_like)
                                <img style="width: 20px; cursor:pointer;" data-id="{{ $image->id }}"
                                    src="{{ asset('icons/heart-red.png') }}" alt="icon de me gusta" class="icon-like">
                            @else
                                <img style="width: 20px; cursor:pointer;" data-id="{{ $image->id }}"
                                    src="{{ asset('icons/heart-black.png') }}" alt="iconssss sin me gusta"
                                    class="icon-dislike">
                            @endif
                            <span style="font-size: 0.6rem; margin-right: 5px;"> {{ count($image->likes) }}</span>

                            @if (Auth::user() && Auth::user()->id == $image->user->id)
                                <a href="{{ route('admin.image.edit', $image->id) }}"
                                    class="btn btn-sm btn-info text-white" title="Actualizar"><i
                                        class="fas fa-pen-alt"></i></a>


                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop"title="Borrar"><i class="fas fa-trash-alt"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"> Borrar
                                                    definitivamente.? </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Estas seguro de borrar la imagen. ? <br>
                                                si aceptas no podras recuperar la imagen borrada
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <a href="{{ route('admin.image.delete', $image->id) }}"
                                                    class="btn btn-danger text-white" title="Borrar">Borrar
                                                    definitivamente</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <h3>comentarios ({{ count($image->comments) }})</h3>
                            <hr>
                            <form action="{{ route('admin.comment.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="image_id" value="{{ $image->id }}">
                                <div class="form-group">
                                    <textarea name="contenido" autofocus class="form-control mr-2" rows="2" style="resize: none; outline: none;"
                                        placeholder="Escribe un comentario...." required>{{ old('contenido') }}</textarea>
                                    @if ($errors->has('contenido'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="error alert-danger">
                                                <strong>{{ $errors->first('contenido') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mt-2">
                                    <input type="submit" value="Enviar comentario"
                                        class="btn btn-success btn-sm text-white">
                                </div>
                            </form>
                            @foreach ($image->comments as $comment)
                                <div style="padding: 5px 0px" class="mt-2 mb-0 text-secondary">
                                    <strong>{{ '@' . $comment->user->name }}</strong>
                                    <strong>{{ ' | ' . $comment->created_at->diffForHumans() }}</strong>
                                    <p style=" margin-bottom: 0px; font-size: 0.9rem">
                                        {{ $comment->contenido }}
                                        @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                            <a href="{{ route('admin.comment.delete', $comment->id) }}"
                                                style="font-size: 0.7rem; background-color: #eee; padding:1.5px 8px; border-radius:5px;">Eliminar</a>
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    var url = 'http://localhost:8000';

    window.addEventListener("load", function() {

        function like() {
            $('.icon-like').unbind('click').click(function() {
                console.log('like');
                $(this).addClass('icon-dislike').removeClass('btn-like');
                $(this).attr('src', url + '/icons/heart-red.png');

                $.ajax({
                    url: url + '/like/' + $(this).data('id'),
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        if (response.like) {
                            console.log('like');
                        } else {
                            console.log('no like');
                        }
                    }
                });

                dislike();
            });
        }
        like();



        function dislike() {
            $('.icon-dislike').unbind('click').click(function() {
                console.log('dislike');
                $(this).addClass('icon-like').removeClass('btn-dislike');
                $(this).attr('src', url + '/icons/heart-black.png');

                $.ajax({
                    url: url + '/dislike/' + $(this).data('id'),
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        if (response.like) {
                            console.log('dislike');
                        } else {
                            console.log('no dislike');
                        }
                    }
                });

                like();
            });
        }
        dislike();


    })
</script>
