<x-app-layout>
    <div class="mb-3 d-flex justify-content-between">
        <h1 class="h3 d-inline align-middle">Estado de cotizaciones </h1>

        <a role="button" href="{{route('budget-status.create')}}" type="button" class="btn btn-primary btn-dark d-flex align-items-center justify-content-center" style="border-radius: 20px;" >
            <span style="margin-right: 10px;">   Agregar estado</span> <i class="align-middle"  data-feather="plus"></i>
           </a>
    </div>
    <livewire:budget-status-table></livewire:budget-status-table>
</x-app-layout>
