<x-app-layout>
    <div class="mb-3 d-flex justify-content-between">
        <h1 class="h3 d-inline align-middle">Productos </h1>
        <a role="button" href="{{ route('products.create') }}" type="button"
            class="btn btn-primary btn-dark d-flex align-items-center justify-content-center"
            style="border-radius: 20px;">
            <span style="margin-right: 10px;"> Agregar Producto</span> <i class="align-middle" data-feather="plus"></i>
        </a>
    </div>

    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong> {{session('message')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <livewire:products-table></livewire:products-table>
</x-app-layout>
