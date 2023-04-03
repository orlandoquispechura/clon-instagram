<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="container mt-5">
        <div class="row">
            <div class="row">
                <div class="col-12 col-md-7 m-auto">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('img-delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('img-delete') }}
                        </div>
                    @elseif(session('img-delete-error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('img-delete-error') }}
                        </div>
                    @endif
                </div>
            </div>
            @foreach ($images as $img)
                <div class="col-12 col-sm-8 col-lg-7 m-auto mb-4">
                    <div class="card">
                        <div class="card-header">
                            <a style="color: #444" href="{{ route('admin.user.publicacion', $img->user->id) }}">
                                <strong>{{ '@' . $img->user->name }} | Usuario</strong>
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div style="max-height: 400px; overflow: hidden;">
                                <img style="width: 100%; height: 100%; overflow: hidden; "
                                    src="{{ route('admin.image.file', ['img' => $img->ruta_imagen]) }}" alt=" logo ">
                            </div>
                            <div style="padding: 3px 15px">
                                <strong>{{ '@' . $img->user->name }}</strong>
                                <strong>{{ ' | ' . $img->created_at->diffForHumans() }}</strong>
                                <p>
                                    {{ $img->descripcion }}
                                </p>
                            </div>
                            <div style="padding: 0px 0px 15px 15px">
                                <?php $user_like = false; ?>
                                @foreach ($img->likes as $like)
                                    @if ($like->user->id == Auth::user()->id)
                                        <?php $user_like = true; ?>
                                    @endif
                                @endforeach
                                @if ($user_like)
                                    <img style="width: 20px; cursor:pointer;" data-id="{{ $img->id }}"
                                        src="{{ asset('icons/heart-red.png') }}" alt="icon de me gusta"
                                        class="icon-like">
                                @else
                                    <img style="width: 20px; cursor:pointer;" data-id="{{ $img->id }}"
                                        src="{{ asset('icons/heart-black.png') }}" alt="icon sin me gusta"
                                        class="icon-dislike">
                                @endif
                                <span style="font-size: 0.6rem; margin-right: 5px;"> {{ count($img->likes) }}</span>
                                <a href="{{ route('admin.image.show', $img->id) }}"
                                    class="btn btn-sm btn-light fw-bold">comentarios
                                    ({{ count($img->comments) }})
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $images->links() }}
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
                $(this).attr('src', 'icons/heart-red.png');

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
                $(this).attr('src', 'icons/heart-black.png');

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
