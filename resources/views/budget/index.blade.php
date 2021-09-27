<x-app-layout>
    <div class="mb-3 d-flex justify-content-between">
        <h1 class="h3 d-inline align-middle">Productos </h1>
        @can('budget:create')
            <a role="button" href="{{ route('budgets.create') }}" type="button"
                class="btn text-white btn-primary btn-dark d-flex align-items-center justify-content-center"
                style="border-radius: 20px;">
                <span style="margin-right: 10px;"> Crear Cotización</span> <i class="align-middle" data-feather="plus"></i>
            </a>
        @endcan
    </div>
</x-app-layout>
