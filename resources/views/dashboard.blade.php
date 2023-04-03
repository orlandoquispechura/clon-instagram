<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2> --}}
    </x-slot>

    {{-- <x-jet-welcome /> --}}
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 m-auto">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> Registrado!</strong> {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> Error!</strong>{{ session('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        logo
                    </div>
                    <div class="card-body">
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
