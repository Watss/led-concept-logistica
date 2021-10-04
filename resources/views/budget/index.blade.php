<x-app-layout>
    <div class="mb-3 d-flex justify-content-between">
        <h1 class="h3 d-inline align-middle">Cotizaciones </h1>
        <a role="button" href="{{route('budget.create')}}" type="button" class="btn btn-primary btn-dark d-flex align-items-center justify-content-center text-white" style="border-radius: 20px;" >
            <span style="margin-right: 10px;">Nueva Cotización</span> <i class="align-middle"  data-feather="plus"></i>
           </a>
    </div>


        <livewire:budgets-report></livewire:budgets-report>

</x-app-layout>
