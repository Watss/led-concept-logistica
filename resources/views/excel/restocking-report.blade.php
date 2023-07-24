<!DOCTYPE html>
<html lang="ES">

<body>

    <table>
        <thead>
            <tr>
                <td colspan="7" style="text-align: center;"> SKU EMPRESAS </td>
                <td colspan="7" style="text-align: center;"> VENTA 6 MESES </td>
                <td colspan="7" style="text-align: center;"> VENTA 12 MESES </td>
                <td colspan="7" style="text-align: center;"> INVENTARIOS </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"> SKU ACTUAL </td>
                <td colspan="2" style="text-align: center;"> SKU VIEJOS </td>
                <td colspan="1" style="text-align: center;"> ANOTACIONES </td>
                <td colspan="1" rowspan="2" style="text-align: center;"> DESCRIPCIÓN </td>
                <td colspan="1" rowspan="2" style="text-align: center;"> PROVEEDOR </td>
                <td colspan="3" style="text-align: center;"> VENTA ACUMULADA L. CONCEPT </td>
                <td colspan="3" style="text-align: center;"> VENTA ACUMULADA L. CENTER </td>
                <td colspan="1" rowspan="2" style="text-align: center;"> TOTAL GRAL 6 MESES </td>
                <td colspan="3" style="text-align: center;"> VENTA ACUMULADA L. CONCEPT </td>
                <td colspan="3" style="text-align: center;"> VENTA ACUMULADA L. CENTER </td>
                <td colspan="1" rowspan="2" style="text-align: center;"> TOTAL GRAL 12 MESES </td>
                <td colspan="{{ count($report->led_concept_offices) }}" style="text-align: center;"> STOCK LEDCONCEPT
                </td>
                <td colspan="{{ count($report->led_center_offices) }}" style="text-align: center;"> STOCK LEDCENTER
                </td>
                <td colspan="1" rowspan="2" style="text-align: center;"> TOTAL GRAL. </td>
            </tr>
            <tr>
                <td colspan="1" style="text-align: center;"> SKU1 </td>
                <td colspan="1" style="text-align: center;"> SKU2 </td>
                <td colspan="1" style="text-align: center;"> SKU1.1 </td>
                <td colspan="1" style="text-align: center;"> SKU2.2 </td>
                <td colspan="1" style="text-align: center;"> OBS </td>
                <td colspan="1" style="text-align: center;"> SKU1</td>
                <td colspan="1" style="text-align: center;"> SKU1.1</td>
                <td colspan="1" style="text-align: center;"> TOTAL LEDCONCEPT</td>
                <td colspan="1" style="text-align: center;"> SKU2</td>
                <td colspan="1" style="text-align: center;"> SKU2.2</td>
                <td colspan="1" style="text-align: center;"> TOTAL LEDCENTER</td>
                <td colspan="1" style="text-align: center;"> SKU1</td>
                <td colspan="1" style="text-align: center;"> SKU1.1</td>
                <td colspan="1" style="text-align: center;"> TOTAL LEDCONCEPT</td>
                <td colspan="1" style="text-align: center;"> SKU2</td>
                <td colspan="1" style="text-align: center;"> SKU2.2</td>
                <td colspan="1" style="text-align: center;"> TOTAL LEDCENTER</td>

                @foreach ($report->led_concept_offices as $office)
                    <td colspan="1" style="text-align: center;">{{ $office['name'] }}</td>
                @endforeach

                @foreach ($report->led_center_offices as $office)
                    <td colspan="1" style="text-align: center;">{{ $office['name'] }}</td>
                @endforeach

            </tr>
        </thead>
        <tbody>
            @foreach ($productsConfig as $key => $product)
                <tr>
                    <td>
                        {{ $product->sku_led_concept }}
                    </td>
                    <td>
                        {{ $product->sku_led_center }}
                    </td>
                    <td>
                        {{ $product->legacy_sku_led_concept }}
                    </td>
                    <td>
                        {{ $product->legacy_sku_led_center }}
                    </td>
                    <td></td>
                    <td>
                        {{ $product->descripcion }}
                    </td>
                    <td>
                        {{ $product->proveedor }}
                    </td>
                    <td>
                        {{ $product->sku_led_concept_sales }}
                    </td>
                    <td>
                        {{ $product->legacy_sku_led_concept_sales }}
                    </td>
                    <td>=SUM(H{{ $loop->iteration + 3 }}:I{{ $loop->iteration + 3 }})</td>{{-- TOTAL LEDCONCEPT FILA J --}}
                    <td>
                        {{ $product->sku_led_center_sales }}
                    </td>
                    <td>
                        {{ $product->legacy_sku_led_center_sales }}
                    </td>
                    <td>=SUM(K{{ $loop->iteration + 3 }}:L{{ $loop->iteration + 3 }})</td> {{-- TOTAL LEDCENTER FILA M --}}
                    <td>=SUM(J{{ $loop->iteration + 3 }}, M{{ $loop->iteration + 3 }})</td> {{-- TOTAL GRAL X MESES FILA N --}}

                    <td>
                        {{ $product->sku_led_concept_sales12 }}
                    </td>
                    <td>
                        {{ $product->legacy_sku_led_concept_sales12 }}
                    </td>
                    <td>=SUM(O{{ $loop->iteration + 3 }}:P{{ $loop->iteration + 3 }})</td>
                    <td>
                        {{ $product->sku_led_center_sales12 }}
                    </td>
                    <td>
                        {{ $product->legacy_sku_led_center_sales12 }}
                    </td>
                    <td>=SUM(R{{ $loop->iteration + 3 }}:S{{ $loop->iteration + 3 }})</td>
                    <td>=SUM(Q{{ $loop->iteration + 3 }}, T{{ $loop->iteration + 3 }})</td>
                    @foreach ($report->led_concept_offices as $office)
                        <td>
                            {{ isset($product->stock_led_concept->toArray()[$office['id']]) ? $product->stock_led_concept->toArray()[$office['id']] : 0 }}
                        </td>
                    @endforeach

                    @foreach ($report->led_center_offices as $office)
                        <td>
                            {{ isset($product->stock_led_center->toArray()[$office['id']]) ? $product->stock_led_center->toArray()[$office['id']] : 0 }}
                        </td>
                    @endforeach
                    <td>=SUM(V{{ $loop->iteration + 3 }}:{{ $report->next }}{{ $loop->iteration + 3 }})</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
