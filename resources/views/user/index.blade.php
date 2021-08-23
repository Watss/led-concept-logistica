<x-app-layout>
    <div class="mb-3 d-flex justify-content-between">
        <h1 class="h3 d-inline align-middle">Usuarios </h1>
        @can('user:create')
        <a role="button" href="{{route('users.create')}}" type="button" class="btn btn-primary btn-dark d-flex align-items-center justify-content-center" style="border-radius: 20px;" >
            <span style="margin-right: 10px;">   Agregar Usuario</span> <i class="align-middle"  data-feather="plus"></i>
           </a>
           @endcan
    </div>
        <livewire:users-table></livewire:users-table>

</x-app-layout>
