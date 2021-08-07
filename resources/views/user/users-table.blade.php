<div class="row">
    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
        <div class="card flex-fill p-4">
            <div class="row justify-content-end mb-3">
                <div class="col-3">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control" wire:model.debounce.500ms="search" placeholder="Buscar..."
                            aria-label="Search">
                        <button class="btn" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-left">Nombre</th>
                            <th>Email</th>
                            <th>Área</th>
                            <th>Rol</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td><img src="https://ui-avatars.com/api/?name={{ $user->name }}&rounded=true&size=30"
                                        class="img-fluid mr-2" alt=""></td>
                                <td><b class="ml-2">{{ $user->name }}</b></td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->area }}</td>
                                <td>{{$user->rolesUser }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light" style="border-radius: 20px;
                                            padding: 5px;
                                            display: flex;" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu"
                                            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(-95px, 35px, 0px);"
                                            data-popper-placement="bottom-end">
                                            <a class="dropdown-item" href="{{route('users.edit',$user)}}">Editar</a>
                                            <form method="POST" action="{{route('users.destroy',$user)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item">Eliminar</button>
                                            </form>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-4">
                {{ $users->links() }}
            </div>
        </div>

    </div>

</div>
