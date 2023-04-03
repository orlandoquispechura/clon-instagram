<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-7 m-auto ">
                <div class="row">
                    <div class="col-md-5 text-center ">
                        <img src="{{ Auth::user()->profile_photo_url }}" width="250px" alt="user"
                            class="img-fluid rounded-circle">
                    </div>
                    <div class="col-md-7 text-justify">
                        <div style="margin-top: 100px">
                            <h1>{{ '@' . $user->name }}</h1>
                            <h3>{{ ' se unió: ' . Str::ucfirst($user->created_at->diffForHumans()) }}</h3>
                        </div>
                    </div>
                </div>
                @foreach ($user->images as $img)
                    <div class="card mt-5">
                        <div class="card-header">
                            <a style="color: #444" href="{{ route('admin.user.publicacion', $img->user->id) }}">
                                <strong>{{ '@' . $img->user->name }} | User</strong>
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div style="max-height: 400px; overflow: hidden;">
                                <img style="width: 100%; height: 100%; object-fit: cover; "
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
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
