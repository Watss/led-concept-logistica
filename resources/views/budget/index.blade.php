<x-app-layout>
    <div class="mb-3 d-flex justify-content-between">
        <h1 class="h3 d-inline align-middle">Productos </h1>
        @can('budget:create')
        <a href="{{ route('budget.create') }}">
            <button role="button"  type="button"
            class="btn text-white btn-primary btn-dark d-flex align-items-center justify-content-center"
            style="border-radius: 20px;">
            <span style="margin-right: 10px;"> Crear Cotización</span> <i class="align-middle" data-feather="plus"></i>
            </button>
        </a>
           
        @endcan
    </div>


        <livewire:budgets-report></livewire:budgets-report>

</x-app-layout>
