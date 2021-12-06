<x-app-layout>
    <div class="mb-3 d-flex justify-content-between">
        <h1 class="h3 d-inline align-middle">Productos </h1>
        @can('product:create')
            <a href="{{ route('products.create') }}">
                <button role="button" type="button"
                    class="btn text-white btn-primary btn-dark d-flex align-items-center justify-content-center"
                    style="border-radius: 20px;">
                    <span style="margin-right: 10px;"> Agregar Producto</span> <i class="align-middle"
                        data-feather="plus"></i>
                </button>
            </a>

        @endcan
    </div>

    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong> {{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @php
        $id = session('idProducto');
        $budgets = session('budgets');
        $product = session('product');
    @endphp
    @if (Session::has('warning'))

        <div class="alert alert-warning alert-dismissible" role="alert">

            @if ($budgets->count() >= 1)
                <div>
                    <strong> {{ $budgets->count() >= 1 ? 'Advertencia. Este producto ya está siendo utilizado en la cotización.':'Advertencia. El producto ya está siendo utilizado en las cotizaciónes.' }}</strong>
                    <div>
                        {{ $budgets->count() >= 1 ? 'Al eliminar también eliminará la cotizacion listada' : 'Al eliminar también eliminará la cotizacion listada' }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <br>
                <div>
                    <strong>Producto</strong>
                    <div>{{$product->name}}</div> 
                </div>
                <br>
                <div>
                    <strong>{{ $budgets->count() > 1 ? 'Cotizaciones' : 'Cotización' }}</strong>
                    <ul>
                        @foreach ($budgets as $item)
                            <li> N° {{ $item->budget_id }}</li>
                        @endforeach
                    </ul>
                </div>
                
                <br>
                <div>
                    <form method="POST" action="{{ url("products/{$id}") }}">
                        @csrf
                        @method('DELETE')
                        <input type="text" name="products" value="{{$budgets->count()}}" hidden>
                        <input type="text" name="confirm" value="0" hidden>
                        <button class="btn btn-danger text-white" type="submit">Eliminar de todos modos</button>
                    </form>

                </div>
            @else
                <div>Esta seguro que desea eliminar el producto ,{{$product->name}}</div>
                <br>
                <div>
                    <form method="POST" action="{{ url("products/{$id}") }}">
                        @csrf
                        @method('DELETE')
                        <input type="text" name="products" value="{{$budgets->count()}}" hidden>
                        <input type="text" name="confirm" value="0" hidden>
                        <button class="btn btn-danger text-white" type="submit">Eliminar de todos modos</button>
                    </form>

                </div>
            @endif


        </div>
    @endif


    <livewire:products-table></livewire:products-table>
</x-app-layout>
