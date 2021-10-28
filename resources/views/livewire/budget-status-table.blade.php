<div class="row">
    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
        <div class="card flex-fill p-4">
            <div class="row justify-content-end mb-3">


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
                                        <form method="POST" action="{{route('budget-status.restore',$status->id )}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="dropdown-item">Restaurar</button>
                                        </form>
                                        @else
                                        <a class="dropdown-item" href="{{route('budget-status.edit',$status)}}">Editar</a>

                                            @if ($status->id > 5)
                                                <form method="POST" action="{{route('budget-status.destroy',$status)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">Eliminar</button>
                                                </form>
                                            @endif
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
