<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="container">
        <form action="{{ route('admin.user.index') }}" id="buscador"method="GET" class="row mb-5">

            <div class="col-md-6">
                <input type="text" id="search" class="form-control" placeholder="Buscar personas...">
            </div>
            <div class="col-md-2">
                <input type="submit" value="Buscar" class="btn btn-info text-white">
            </div>
        </form>
        <div class="row">
            @foreach ($users as $user)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body p-0 w-100">
                            <img src="{{ $user->profile_photo_url }}" width="100%" alt="user"
                                class="img-fluid rounded">
                            {{-- <hr> --}}
                        </div>
                        <div class="card-footer">
                            <h3>{{ '@' . Str::ucfirst($user->name) }}</h3>
                            <h6>{{ ' Se unió: ' . Str::ucfirst($user->created_at->diffForHumans()) }}</h6>
                            <a href="{{ route('admin.user.publicacion', $user->id) }}"
                                class="btn btn-sm btn-primary text-white">Ver perfil</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    var url = 'http://localhost:8000';
    
    window.addEventListener("load", function() {
        // alert('alerta');
        $('#buscador').submit(function(e) {
            $(this).attr('action' , url+'/personas/' + $('#buscador #search').val());
        });
    })
</script>

