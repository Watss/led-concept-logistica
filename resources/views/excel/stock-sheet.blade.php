<table>
    <thead>
        <tr>
            {{-- <th> SKU1 </th>
            <th> SKU2 </th>
            <th> SKU3 </th> --}}
            <th> Nombre </th>
            <th> STOCK </th>
        </tr>
    </thead>
    <tbody>
        @if (isset($data))
            @foreach ($data as $product)
                <tr>
                    {{-- <td>
                        {{ $product['sku1'] }}
                    </td>
                    <td>
                        {{ $product['sku2'] }}
                    </td>
                    <td>
                        {{ $product['sku3'] }}
                    </td> --}}
                    <td>
                        {{ $product['nombre'] }}
                    </td>
                    <td>
                        {{ $product['total'] }}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
