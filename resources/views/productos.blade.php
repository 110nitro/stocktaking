@extends('layouts.app')

@section('content')
<div class="container">
    <div class="contenedor-productos justify-content-center">
        <div class="columna-productos">
            <div class="formulario-productos">
                <div class="lista-productos">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col" class="cell-align"><span class="icon-nav-table"><ion-icon name="git-merge-outline"></ion-icon></span></th>
                                <th scope="col">Producto</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Editar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($resProducto as $producto)
                                <tr>
                                    <th scope="row" class="cell-align">{{$producto['id']}}</th>
                                    <td class="cell-align">{{$producto['detalles']}}</td>
                                    <td class="cell-align">{{$producto['stock']}}</td>
                                    <td class="cell-align display-off">S/.{{number_format($producto['precio'],2)}}</td>
                                    <td class="cell-align">
                                        <button type="submit" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#ModalPlanta{{$producto['id']}}">
                                            <span class="icon-nav"><ion-icon name="create-outline"></ion-icon></span>{{ __('Editar') }}
                                        </button>
                                    </td>
                                    <td class="cell-align">
                                        @if($producto["estado"] == 'Activo')
                                            <div class="form-check form-switch">
                                                <form method='post' action='{{ route('productos-desactivar') }}' id="formActivate{{$producto['id']}}">
                                                    @csrf
                                                    <input type='hidden' name='id' value='{{$producto['id']}}'>
                                                    <input class="form-check-input" type="checkbox" value="{{$producto['id']}}" id="{{$producto['id']}}" onchange="document.getElementById('formActivate{{$producto['id']}}').submit()" checked>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Activo</label>
                                                </form>
                                            </div>
                                        @else
                                            <div class="form-check form-switch">
                                                <form method='post' action='{{ route('productos-activar') }}' id="formActivate{{$producto['id']}}">
                                                    @csrf
                                                    <input type='hidden' name='id' value='{{$producto['id']}}'>
                                                    <input class="form-check-input" type="checkbox" value="" id="{{$producto['id']}}" onchange="document.getElementById('formActivate{{$producto['id']}}').submit()">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Inactivo</label>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        @foreach($resProducto as $producto)
            <div class="modal fade" id="ModalPlanta{{$producto['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><span class="icon-nav"><ion-icon name="create-outline"></ion-icon></span>Editar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('productos-editar') }}" enctype="multipart/form-data" id="FormPl{{$producto["id"]}}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="detalles{{$producto["id"]}}" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="detalles{{$producto["id"]}}" type="text" class="form-control @error('detalles') is-invalid @enderror" name="detalles" value="{{$producto["detalles"]}}" required autocomplete="detalles" autofocus>
                                        <input type='hidden' name='id' value='{{$producto["id"]}}'>

                                        @error('detalles')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="stock{{$producto["id"]}}" class="col-md-4 col-form-label text-md-end">{{ __('Stock') }}</label>

                                    <div class="col-md-6">
                                        <input id="stock{{$producto["id"]}}" type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{$producto["stock"]}}" required autocomplete="stock" autofocus>

                                        @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="precio{{$producto["id"]}}" class="col-md-4 col-form-label text-md-end">{{ __('Precio') }}</label>

                                    <div class="col-md-6">
                                        <input id="precio{{$producto["id"]}}" step="any" type="number" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{$producto["precio"]}}" required autocomplete="precio" autofocus>

                                        @error('precio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="FormPl{{$producto["id"]}}">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
</div>
                        
@endsection