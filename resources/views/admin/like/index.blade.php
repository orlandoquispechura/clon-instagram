<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 col-md-7 col-lg-7 m-auto mb-4">
                @foreach ($listaLikes as $like)
                    <div class="card">
                        <div class="card-header">
                            <a style="color: #444" href="{{ route('profile.show', $like->user->id) }}">
                                <strong>{{ '@' . $like->user->name }} | User</strong>
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div style="max-height: 400px; overflow: hidden;">
                                <img style="width: 100%; height: 100%; object-fit: cover; "
                                    src="{{ route('admin.image.file', ['img' => $like->image->ruta_imagen]) }}" alt=" logo ">
                            </div>
                            <div style="padding: 3px 15px">
                                <strong>{{ '@' . $like->user->name }}</strong>
                                <strong>{{ ' | ' . $like->created_at->diffForHumans() }}</strong>
                                <p>
                                    {{ $like->descripcion }}
                                </p>
                            </div>
                            <div style="padding: 0px 0px 15px 15px">
                                <?php $user_like = false; ?>
                                @foreach ($listaLikes as $lik)
                                    @if ($lik->user->id == Auth::user()->id)
                                        <?php $user_like = true; ?>
                                    @endif
                                @endforeach
                                @if ($user_like)
                                    <img style="width: 20px; cursor:pointer;" data-id="{{ $like->image->id }}"
                                        src="{{ asset('icons/heart-red.png') }}" alt="icon de me gusta"
                                        class="icon-like">
                                @else
                                    <img style="width: 20px; cursor:pointer;" data-id="{{ $like->image->id }}"
                                        src="{{ asset('icons/heart-black.png') }}" alt="icon sin me gusta"
                                        class="icon-dislike">
                                @endif
                                <span style="font-size: 0.6rem; margin-right: 5px;"> {{ count($listaLikes) }}</span>
                                <a href="{{ route('admin.image.show', $like->image->id)}}" class="btn btn-sm btn-light fw-bold">comentarios
                                    ({{ count($like->image->comments) }})
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $listaLikes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
