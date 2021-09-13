<div class="row">
    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
        <div class="card flex-fill p-4">
            <div class="row justify-content-end mb-3">
                <div class="col-1">
                    <div class="input-group input-group-navbar">
                        <button type="button btn btn-primary" class="form-control mr-2"
                             name="pdf" wire:click="makePdf"> PDF
                            </button>
                    </div>
                </div>
                <div class="col-2">
                    <div class="input-group input-group-navbar">
                        <select class="form-control mr-2" name="status" id="" wire:model="status">
                            <option value="">Todas</option>
                            @foreach ($statuses as $status )
                            <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="input-group input-group-navbar">
                        <input type="date" class="form-control mr-2"
                             aria-label="Desde" name="start_date" wire:model="start_date">
                    </div>
                </div>
                <div class="col-2">
                    <div class="input-group input-group-navbar">
                        <input type="date" class="form-control ml-2" name="end_date"  wire:model="end_date"
                            aria-label="Hasta">
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control" wire:model.debounce.500ms="search"
                            placeholder="Buscar..." aria-label="Search">
                        <button class="btn" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="">Cliente</th>
                        <th class="">Encargado</th>
                        <th class="d-none d-xl-table-cell">Neto</th>
                        <th class="d-none d-xl-table-cell">Iva</th>
                        <th class="">Total</th>
                        <th class="">Estado</th>
                        <th class="d-none d-xl-table-cell">Fecha Creacion</th>
                        {{-- <th class="text-center">Acciones</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($budgets as $budget)
                        <tr>
                            <td class="">{{ $budget->id }}</td>
                            <td class="">{{ $budget->client->name }}</td>
                            <td class="">{{ $budget->user->name }}</td>
                            <td class="d-none d-xl-table-cell text-right">{{ $budget->neto }}</td>
                            <td class="d-none d-xl-table-cell text-right">{{ $budget->iva }}</td>
                            <td class="text-right">{{ $budget->total }}</td>
                            <td class="text-right">  <span class="badge" style="background-color:{{ $budget->statusTrashed->color }} ">{{ $budget->statusTrashed->name }} </span>
                            </td>
                            <td class="d-none d-xl-table-cell">{{ $budget->created_at }}</td>
                            {{-- <td class="text-center">
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
                                        <a class="dropdown-item"
                                            href="#">Editar</a>

                                        <a class="dropdown-item" href="#">Eliminar</a>

                                    </div>
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach



                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-4">
                {{ $budgets->links() }}
            </div>
        </div>

    </div>

</div>

