<x-app-layout>
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Nuevo Cliente</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('clients.store')}}">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nombre o Razón social</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name') ?? $client->name ?? ''}}">
                        @error('name')
                        <div class="invalid-feedback">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Rut</label>
                        <input type="text" class="form-control @error('rut') is-invalid @enderror" name="rut" value="{{old('rut') ?? $client->rut ?? ''}}">
                        @error('rut')
                        <div class="invalid-feedback">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{old('address') ?? $client->address ?? ''}}">
                        @error('address')
                        <div class="invalid-feedback">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone') ?? $client->phone ?? ''}}">
                        @error('phone')
                        <div class="invalid-feedback">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email') ?? $client->email ?? ''}}">
                        @error('email')
                        <div class="invalid-feedback">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Giro (Opcional)</label>
                        <input type="text" class="form-control @error('draft') is-invalid @enderror" name="draft" value="{{old('draft') ?? $client->draft ?? ''}}">
                        @error('draft')
                        <div class="invalid-feedback">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label" for="inputState">Tipo</label>
                        <select id="inputState" name="type" class="form-control @error('type') is-invalid @enderror" value="{{old('type') ?? $client->type ?? 'empresa'}}">
                            <option value="empresa">Empresa</option>
                            <option value="persona">Persona Natural</option>
                        </select>
                        @error('type')
                        <div class="invalid-feedback">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark float-right">Guardar</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
