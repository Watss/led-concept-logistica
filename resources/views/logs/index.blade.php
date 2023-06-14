<x-app-layout>
    <div class="container mx-auto py-6">

        @can('product:create')
            <form action="{{ route('sync.prices') }}" method="POST">
                @csrf
                <button role="button" type="submit"
                    class="btn text-white btn-primary btn-dark d-flex align-items-center justify-content-center mb-3"
                    style="border-radius: 20px;">
                    <span style="margin-right: 10px;"> Sincronizar Precios </span>
                </button>
                <span style="margin-right: 10px;"> No recarges la página al presionar el botón, el proceso
                    puede demorar unos
                    minutos </span>
            </form>
        @endcan


        <div class="mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-3">
            <div class="px-3 py-4 bg-gray-100 border-b">
                <h1 class="text-2xl font-bold">Historial de actualización de precios</h1>
            </div>
            <div class="px-4 py-4">
                <table class="min-w-full border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 bg-gray-100 border-b">ID</th>
                            <th class="px-4 py-2 bg-gray-100 border-b">Productos Encontrados</th>
                            <th class="px-4 py-2 bg-gray-100 border-b">Precios Actualizados</th>
                            <th class="px-4 py-2 bg-gray-100 border-b">Productos con el precio actualizado</th>
                            <th class="px-4 py-2 bg-gray-100 border-b">Productos sin precio (BSALE)</th>
                            <th class="px-4 py-2 bg-gray-100 border-b">Fecha de Creación</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logUpdateProductPrices as $logUpdateProductPrice)
                            <tr>
                                <td class="px-4 py-2 border-b">{{ $logUpdateProductPrice->id }}</td>
                                <td class="px-4 py-2 border-b">{{ $logUpdateProductPrice->products_matched }}</td>
                                <td class="px-4 py-2 border-b">{{ $logUpdateProductPrice->prices_updated }}</td>
                                <td class="px-4 py-2 border-b">{{ $logUpdateProductPrice->products_actually_price }}
                                </td>
                                <td class="px-4 py-2 border-b">
                                    {{ $logUpdateProductPrice->products_matched - ($logUpdateProductPrice->products_actually_price + $logUpdateProductPrice->prices_updated) }}
                                </td>
                                <td class="px-4 py-2 border-b">
                                    {{ $logUpdateProductPrice->created_at->format('d-m-Y H:i') }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $logUpdateProductPrices->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
