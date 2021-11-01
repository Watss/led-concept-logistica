<x-app-layout>
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle"> {{$user->id ? 'Editar Usuario':'Nuevo Usuario'}}</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ $user->id ? route('users.update',$user) : route('users.store') }}">
                @csrf
                @if (isset($user->id))
                    @method('PATCH')
                @endif
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') ?? ($user->name ?? '') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                <div class="alert alert-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Correo electronico</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') ?? ($user->email ?? '') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                <div class="alert alert-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" value="{{ old('password') }}">
                        <div id="password" class="form-text">
                            Tú contraseña debe ser mayor a 8 caracteres, además contener por lo menos una letra
                            mayúscula, minúscula y un número
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                <div class="alert alert-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Confirmacion contraseña</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" value="">
                        @error('password_confirmation ')
                            <div class="invalid-feedback">
                                <div class="alert alert-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-4">

                        <label class="form-label">Rol</label>

                        <select class="custom-select form-control @error('role') is-invalid @enderror" name="role" id="role">
                            <option  value="">Selecciona</option>
                            @foreach ($roles as $role)

                                <option value="{{ $role->id }}"  @if ($user->hasRole($role->id)) selected  @elseif(old('role') == $role->id) selected  @endif >
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                <div class="alert alert-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Área</label>
                        <input type="text" class="form-control @error('area') is-invalid @enderror" name="area"
                            value="{{ old('area') ?? ($user->area ?? '') }}">
                        @error('area')
                            <div class="invalid-feedback">
                                <div class="alert alert-danger">{{ $message }}</div>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone') ?? ($user->phone ?? '') }}">
                        @error('phone')
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
