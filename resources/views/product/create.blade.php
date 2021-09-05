<x-app-layout>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-6">
                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle">{{ !$product->id ? 'Nuevo Producto' : $product->name }}</h1>
                </div>
                <div class="card ">
                    <div class="card-body">
                        <form method="POST" wire:submit.prevent="upload" enctype="multipart/form-data"
                            action="{{ !$product->id ? route('products.store') : route('products.update', $product) }}">
                            @csrf
                            @method( !$product->id ? 'POST' : 'PUT' )
                            <div class="row  d-flex justify-content-center align-items-center">
                                <div class="col-6">
                                    @livewire('image-upload')
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="pt-1 pb-1 col-md-12">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') ?? ($product->name ?? '') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class=" pt-1 pb-1 col-md-12">
                                    <label class="form-label">Sku</label>
                                    <input type="text" class="form-control @error('sku') is-invalid @enderror"
                                        name="sku" value="{{ old('sku') ?? ($product->sku ?? '') }}">
                                    @error('rut')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="pt-1 pb-1 col-md-12">
                                    <label class="form-label">Codigo de barras</label>
                                    <input type="text" class="form-control @error('barcode') is-invalid @enderror"
                                        name="barcode" value="{{ old('barcode') ?? ($product->barcode ?? '') }}">
                                    @error('bardode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="pt-1 pb-1 col-md-12">
                                    <label class="form-label">Precio</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        name="price" value="{{ old('price') ?? ($product->price ?? '') }}">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-12">
                                   
                                </div>
                            </div>
                          

                            <div class="d-grid gap-2 col-12 mx-auto p-0">
                                <button type="submit" class="btn btn-dark text-white  float-right">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>





</x-app-layout>
