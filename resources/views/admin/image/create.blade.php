<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Subir nueva imágen
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.image.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="ruta_imagen"
                                    class="d-flex col-md-2 col-form-label justify-content-end">Subir</label>
                                <div class="col-md-8 mb-3">
                                    <input type="file" name="ruta_imagen" class="form-control" required/>
                                    @if ($errors->has('ruta_imagen'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="error alert-danger">
                                                <strong>{{ $errors->first('ruta_imagen') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descripcion"
                                    class="d-flex col-md-2 col-form-label justify-content-end">Descripción</label>
                                <div class="col-md-8 mb-3">
                                    <textarea name="descripcion" class="form-control" placeholder="Ingrese una descripción..."  style="resize:none">{{old('descripcion')}}</textarea>
                                    @if ($errors->has('descripcion'))
                                        <div class="alert alert-danger mt-2">
                                            <span class="error alert-danger">
                                                <strong>{{ $errors->first('descripcion') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" value="Guardar imágen" class="btn btn-success text-white">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
