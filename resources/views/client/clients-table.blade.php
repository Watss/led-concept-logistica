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
                            <th>Rut</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Giro</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td><img src="https://ui-avatars.com/api/?name={{ $client->name }}&rounded=true&size=30"
                                        class="img-fluid mr-2" alt=""></td>
                                <td><b class="ml-2">{{ $client->name }}</b></td>
                                <td>{{ $client->rut }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->email }}</td>
                                <td><span
                                        class="badge {{ $client->type === 'empresa' ? 'bg-success' : 'bg-primary' }}">{{ strtoupper($client->type) }}</span>
                                </td>
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
                                            <a class="dropdown-item" href="#">Editar</a>
                                            <a class="dropdown-item" href="#">Eliminar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-4">
                {{ $clients->links() }}
            </div>
        </div>

    </div>

</div>
