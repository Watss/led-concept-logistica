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

    @if (Session::has('warning'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            <div>
                <strong> {{ session('warning') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            @php
                $id = session('idProducto');
                $budgets = session('budgets');
            @endphp
            <br>
            <div>
                <ul>
                    @foreach ($budgets as $item)
                    <li>  N° {{$item->budget_id}}</li>  
                    @endforeach
                </ul>
            </div>
            <br>
            <div>
                <form method="POST" action="{{ url("products/{$id}") }}">
                    @csrf
                    @method('DELETE')
                    <input type="text"  name="confirm" value="1" hidden>
                    <button class="btn btn-danger text-white" type="submit">Eliminar de todos modos</button>
                </form>

            </div>
        </div>
    @endif


    <livewire:products-table></livewire:products-table>
</x-app-layout>
