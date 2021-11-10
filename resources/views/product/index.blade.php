<x-app-layout>
    <div class="mb-3 d-flex justify-content-between">
        <h1 class="h3 d-inline align-middle">Productos </h1>
        @can('product:create')
        <a  href="{{ route('products.create') }}" >
            <button role="button"type="button"
            class="btn text-white btn-primary btn-dark d-flex align-items-center justify-content-center"
            style="border-radius: 20px;">
            <span style="margin-right: 10px;"> Agregar Producto</span> <i class="align-middle" data-feather="plus"></i>
            </button>
        </a>

        @endcan
    </div>

    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong> {{session('message')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <livewire:products-table></livewire:products-table>
</x-app-layout>
