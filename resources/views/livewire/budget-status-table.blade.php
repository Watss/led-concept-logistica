<div class="row">
    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
        <div class="card flex-fill p-4">
            <div class="row justify-content-end mb-3">

                <div class="col-3">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control"
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
                        <th class="">Nombre</th>
                        <th class="">Color</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($budgetsStatus as $status)
                        <tr >
                            <td class="">{{ $status->id }}</td>
                            <td class=" @if ($status->deleted_at) text-danger @endif">{{ $status->name }}</td>
                            <td >
                                <div style=" border-radius: 50%;
                                width: 20px;
                                height: 20px;
                                background: {{$status->color}};">
                                </div>
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

                                        @if ($status->deleted_at)
                                        <a class="dropdown-item" href="#">Restaurar</a>
                                        @else
                                        <a class="dropdown-item"
                                        href="{{route('budget-status.edit',$status)}}">Editar</a>

                                        <a class="dropdown-item" href="#">Eliminar</a>
                                        @endif




                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach



                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-4">
                {{ $budgetsStatus->links() }}
            </div>
        </div>

    </div>

</div>
