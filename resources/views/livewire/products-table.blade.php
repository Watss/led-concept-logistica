<div class="row">
    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
        <div class="card flex-fill p-4">
            <div class="row justify-content-end mb-3">
                <div class="col-3">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control" wire:model.debounce.500ms="search"
                            placeholder="Buscar..." aria-label="Search">
                        <button class="btn" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <table class="table table-hover my-0" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="d-none d-xl-table-cell">Sku</th>
                        <th class="d-none d-xl-table-cell">Nombre</th>
                        <th class="d-none d-xl-table-cell">Tipo</th>
                        <th class="d-none d-xl-table-cell">Precio</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td style="width: 90px;padding: 5px;"">

                            @if (empty($product->image))
                               <div class="sn-image" >S/A</div>
                            @else
                                <img style=" border-radius: 8%; width:60px; height:60px" class="img-product img-fluid"
                                    src="{{ asset($product->image) }}" alt="">
                            @endif
                    </td>
                    <td class="d-none d-xl-table-cell">{{ $product->sku }}</td>
                    <td class="d-none d-xl-table-cell">{{ $product->name }}</td>

                    <td class="d-none d-xl-table-cell">{{ $product->type ? $product->type->name : '--'}}</td>

                    <td class="text-center">@money( $product->price)</td>
                    <td class="d-none d-md-table-cell text-center">
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
                                @can('product:edit')
                                <a class="dropdown-item" href="{{ route('products.edit', $product) }}">Editar</a>
                                @endcan
                                @can('product:delete')
                                <form method="POST" action="{{ url("products/{$product->id}") }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="text" name="confirm" value="1" hidden>
                                    <button class="dropdown-item" type="submit">Eliminar</button>
                                  </form>
                                @endcan
                            </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-4">
                {{ $products->links() }}
            </div>
        </div>

    </div>

</div>

<style>

</style>
