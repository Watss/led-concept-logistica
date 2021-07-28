<x-app-layout>
    <div class="mb-3 d-flex justify-content-between">
        <h1 class="h3 d-inline align-middle">Clientes </h1>
        <button type="button" class="btn btn-primary btn-dark d-flex align-items-center justify-content-center" style="border-radius: 20px;" >
            <span style="margin-right: 10px;">   Agregar Cliente</span> <i class="align-middle"  data-feather="plus"></i>
           </button>
    </div>
    <livewire:clients-table></livewire:clients-table>
</x-app-layout>
