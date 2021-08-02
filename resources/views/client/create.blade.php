<x-app-layout>
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">{{!$client->id ? 'Nuevo Cliente' : $client->name}}</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ !$client->id   ? route('clients.store') : route('clients.update',$client) }}">
                @csrf
                @method( !$client->id  ? 'POST' : 'PUT' )
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
                        <input type="text" class="form-control @error('rut') is-invalid @enderror" name="rut" oninput="checkRut(this)" value="{{old('rut') ?? $client->rut ?? ''}}">
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
                            <option value="empresa" >Empresa</option>
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


@push('scripts')
<script>
    function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');

    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();

    // Formatear RUN
    rut.value = cuerpo + '-'+ dv

    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}

    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;

    // Para cada dígito del Cuerpo
    for(i=1;i<=cuerpo.length;i++) {

        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);

        // Sumar al Contador General
        suma = suma + index;

        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }

    }

    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);

    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;

    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }

    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
}
</script>
@endpush

</x-app-layout>

