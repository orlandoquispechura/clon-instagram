<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Editar mi imagen
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.image.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="image_id" value="{{$image->id}}">
                            <div class="form-group row">
                                <label for="ruta_imagen"
                                    class="d-flex col-md-2 col-form-label justify-content-end">Subir imagen:</label>
                                <div class="col-md-8 mb-3">
                                    @if ($image)
                                        <div class="mb-3">
                                            <img class="img-fluid rounded "
                                                style="height: 100px; width: 100px"
                                                src="{{ route('admin.image.file', ['img' => $image->ruta_imagen]) }}"
                                                alt=" logo ">
                                        </div>
                                    @endif
                                    <input type="file" name="ruta_imagen" class="form-control"  />
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
                                    class="d-flex col-md-2 col-form-label justify-content-end">Descripción: </label>
                                <div class="col-md-8 mb-3">
                                    <textarea name="descripcion" class="form-control" placeholder="Ingrese una descripción..." style="resize:none">{{ $image->descripcion }}</textarea>
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
                                    <input type="submit" value="Actualizar imagen" class="btn btn-success text-white">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
