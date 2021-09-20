<x-app-layout>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-6">
                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle">{{ !$budgetStatus->id ? 'Nuevo Estado' : $budgetStatus->name }}</h1>
                </div>
                <div class="card ">
                    <div class="card-body">
                        <form method="POST" wire:submit.prevent="upload" enctype="multipart/form-data"
                            action="{{ !$budgetStatus->id ? route('budget-status.store') : route('budget-status.update', $budgetStatus) }}">
                            @csrf
                            @method( !$budgetStatus->id ? 'POST' : 'PUT' )
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') ?? ($budgetStatus->name ?? '') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Color</label>
                                    <input type="color" class="form-control @error('color') is-invalid @enderror"
                                        name="color" value="{{ old('color') ?? ($budgetStatus->color ?? '') }}">
                                    @error('color')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                            </div>

                            <br>

                            <div class="d-grid gap-2 col-12 mx-auto">
                                <button type="submit" class="btn btn-dark  float-right">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>





</x-app-layout>
