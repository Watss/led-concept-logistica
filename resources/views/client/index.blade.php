<x-app-layout>
    <div class="mb-3 d-flex justify-content-between">
        <h1 class="h3 d-inline align-middle">Clientes </h1>
        @can('client:create')
        <a href="{{route('clients.create')}}" >
        <button role="button"  type="button" class="btn btn-primary  text-white btn-dark d-flex align-items-center justify-content-center" style="border-radius: 20px;" >
            <span style="margin-right: 10px;">   Agregar Cliente</span> <i class="align-middle"  data-feather="plus"></i>
        </button>
    </a>  
           @endcan
    </div>
    <livewire:clients-table></livewire:clients-table>
</x-app-layout>
