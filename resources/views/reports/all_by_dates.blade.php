<x-app-layout>
    <div class="mb-3 d-flex justify-content-between">
        <h1 class="h3 d-inline align-middle">Generar Reporte por Fecha </h1>

    </div>

    <div class="row">
        <div class="col-12 card">
            <table class="table">
                <thead>
                    <th>ID PRODUCTO</th>
                    <th>STOCK</th>
                </thead>
                <tbody>
                    @foreach ($totalProductos as $product)
                        <tr>
                            <td>
                                {{ $product['nombre'] }}
                            </td>
                            <td>
                                {{ $product['total'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



</x-app-layout>
