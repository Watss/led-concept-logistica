<div class="row">
    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
        <div class="row justify-content-start mb-3 flex-fill" style="background-color: white">
            <div class="row mb-3 my-3 justify-content-between">
                <div class="col my-2">
                    <h4>Bucador de clientes</h4>
                </div>

                <div class="col">
                    <div class="input-group input-group-navbar d-flex flex-column">
                        <div class="___class_+?7___">
                            <input type="text" id="search" class="form-control " wire:model="search"
                                wire:click="searchClient" wire:keydown.debounce.500ms="searchClient"
                                placeholder="Buscar..." aria-label="Search">
                        </div>
                        <div class="flex-fill" id="list-clients" style="top: 40px; z-index: 1;  position:absolute;">

                            <ul class="list-group shadow">
                                @foreach ($listClients as $client)
                                    <li class="list-group-item" wire:click="getBudgets({{ $client }})">
                                        {{ $client->name }}-{{ $client->rut }}
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
                {{-- <div class="col-7">
                    @if (strlen($name) >= 1)
                        <div class="d-flex align-items-start">
                            <img src="https://ui-avatars.com/api/?name={{ $name }}&rounded=true&size=30"
                                class="img-fluid mr-2" alt="">
                            <div class="flex-column" style="margin-left: 8px !important">
                                <div>
                                    <strong class="ml-2">{{ $name }}</strong>
                                </div>
                                <div>
                                    <small class="text-muted">Rut: {{ $rut }}</small>
                                </div>
                            </div>

                        </div>

                    @endif

                </div> --}}
            </div>
        </div>
    </div>

    <div class="card flex-fill p-4">
        <div class="row justify-content-end mb-3">
            <div class="col-1">
                <div class="input-group input-group-navbar">
                    <button type="button btn btn-primary" class="form-control mr-2" name="pdf" wire:click="makePdf"> PDF
                    </button>
                </div>
            </div>
            <div class="col-2">
                <div class="input-group input-group-navbar">
                    <select class="form-control mr-2" name="status" id="" wire:model="status">
                        <option value="">Todas</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="input-group input-group-navbar">
                    <input type="date" class="form-control mr-2" aria-label="Desde" name="start_date"
                        wire:model="start_date">
                </div>
            </div>
            <div class="col-2">
                <div class="input-group input-group-navbar">
                    <input type="date" class="form-control ml-2" name="end_date" wire:model="end_date"
                        aria-label="Hasta">
                </div>
            </div>
            <div class="col-3">
                <div class="input-group input-group-navbar">
                    <input type="text" class="form-control" wire:model.debounce.500ms="searchBudget"
                        placeholder="Buscar..." aria-label="Search">
                    <button class="btn" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        {{ $searchBudget }}
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="___class_+?14___">Cliente</th>
                    <th class="___class_+?15___">Encargado</th>
                    <th class="d-none d-xl-table-cell">Neto</th>
                    <th class="d-none d-xl-table-cell">Iva</th>
                    <th class="___class_+?18___">Total</th>
                    <th class="___class_+?19___">Estado</th>
                    <th class="d-none d-xl-table-cell">Fecha Creacion</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>



                @forelse ($budgets as $budget)
                    <tr>
                        <td class="___class_+?22___">{{ $budget->id }}</td>
                        <td class="___class_+?23___">{{ $budget->client->name }}</td>
                        <td class="___class_+?24___">{{ $budget->user->name }}</td>
                        <td class="d-none d-xl-table-cell text-right">{{ $budget->netoAppends }}</td>
                        <td class="d-none d-xl-table-cell text-right">{{ $budget->ivaAppends }}</td>
                        <td class="text-right">{{ $budget->totalAppends }}</td>
                        <td class="text-right"> <span class="badge" style="background-color:{{ $budget->statusTrashed->color }} ">{{ $budget->statusTrashed->name }} </span></td>
                        <td class="d-none d-xl-table-cell">{{ $budget->created_at }}</td>
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
                                    <a class="dropdown-item" href="#">Ver</a>


                                </div>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="text-center">Este usuario no tiene cotizaciones</td>
                    </tr>
                @endforelse



            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-4">
            {{ $budgets->links() }}
        </div>
    </div>
</div>
</div>

</div>
