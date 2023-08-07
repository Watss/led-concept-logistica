<div class="row">
    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
        <div class="card flex-fill p-4">
            <div class="row justify-content-end mb-3">
                {{--  <div class="col-8">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Selecciona un archivo:</label>
                            <input type="file" name="file" class="form-control-file">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2 text-white">
                            Importar
                        </button>

                    </form>
                </div> --}}
                <div class="col-3">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control" wire:model.debounce.500ms="search"
                            placeholder="Buscar..." aria-label="Search">
                        <button class="btn" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12">
                    <a href="{{ route('download-template-products') }}" class="btn btn-success text-white mt-2">
                        Descargar plantilla
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th colspan="1" class="text-left" style="max-width: 300px;">Descripcion</th>
                            <th colspan="1" class="text-left">Sku Led Concept 1</th>
                            <th colspan="1" class="text-left">Sku Led Concept 2</th>
                            <th colspan="1" class="text-left">Sku Led Center 1</th>
                            <th colspan="1" class="text-left">Sku Led Center 2</th>
                            <th colspan="1" class="text-left">Proveedor</th>



                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>

                                <td colspan="1" class="max-width-column"><b
                                        class="ml-2">{{ $product->descripcion }}</b></td>
                                <td><b
                                        class="ml-2">{{ $product->sku_led_concept !== '' ? $product->sku_led_concept : '--' }}</b>
                                </td>
                                <td><b
                                        class="ml-2">{{ $product->legacy_sku_led_concept !== '' ? $product->legacy_sku_led_concept : '--' }}</b>
                                </td>
                                <td><b
                                        class="ml-2">{{ $product->sku_led_center !== '' ? $product->sku_led_center : '--' }}</b>
                                </td>
                                <td><b
                                        class="ml-2">{{ $product->legacy_sku_led_center !== '' ? $product->legacy_sku_led_center : '--' }}</b>
                                </td>
                                <td><b class="ml-2">{{ $product->proveedor ?? '--' }}</b></td>

                                {{-- <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light" style="border-radius: 20px;
                                            padding: 5px;
                                            display: flex;" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu"
                                            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(-95px, 35px, 0px);"
                                            data-popper-placement="bottom-end">
                                            @can('user:edit')
                                            <a class="dropdown-item" href="{{route('users.edit',$user)}}">Editar</a>
                                            @endcan
                                            @can('user:delete')
                                            <form method="POST" action="{{route('users.destroy',$user)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item">Eliminar</button>
                                            </form>
                                            @endcan
                                        </div>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-4">
                {{ $products->links() }}
            </div>
        </div>

    </div>

</div>

<style>
    .max-width-column {
        max-width: 430px;
        /* Establece el ancho máximo deseado */
        white-space: nowrap;
        /* Evita que el contenido se envuelva en varias líneas */
        overflow: hidden;
        /* Oculta el contenido adicional */
        text-overflow: ellipsis;
        /* Muestra puntos suspensivos (...) si el contenido se desborda */
    }
</style>
