<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" /> --}}
    <style>
        @page { margin: 12px !important; }
        .tr-primaty-style{
            color: black;
            font-size: 14px;
            text-align: center;
            height: 30px;
            max-height: 30px;
        }
        .color-primary{
            background-color: rgb(255,191,0);
        }
        table,th,tr,td{
            border: 1px solid black;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: unset;
            /* border-bottom: 2px solid #dee2e6; */
        }
        .table td, .table th {

            /* padding: .75rem; */
            vertical-align: middle;
            border-top: unset;
            font-size: 11px;
        }
        .image-container{
            width:80px;
            height: 80px;
        }
    </style>
</head>

<body>
        <table style="width: 100%; border: 0px solid transparent;">
            <tr style="border: 0px solid transparent;">
                <td width="70%" style="border: 0px solid transparent;"><img class="img"
                    src="https://www.ledconcept.cl/new/wp-content/uploads/2018/02/Logo-led-concept.png" width="80"
                    alt="">
                    </td>
                <td width="30%" style="border: 0px solid transparent; vertical-align: bottom;"><h5 style="font-size: 10px; font-weight: bold;" class="text-right align-bottom">lunes, 28 de diciembre de 2020</h5></td>
            </tr>
        </table>
        <table class="table border-color-black color-primary mb-5" style="border: 0px solid transparent;">
            <tr style="border: 0px solid transparent;">
                <th class="p-0 pt-2 ml-1" width="80%" style="font-size: 10px; border: 0px solid transparent; border-bottom: 5px solid #000000; "><span>LED Concept SPA - Rut: 76.628.935-5 - Dirección: Avda. Tobalaba # 4899, Ñuñoa - Teléfono: 2 2 981 6267 </span></th>
                <th class="p-0 pt-2 text-right mr-1" style="font-size: 10px; border: 0px solid transparent; border-bottom: 5px solid #000000;"><span>www.ledconcept.cl</span></th>
            </tr>

        </table>
        <h5 class="text-center pb-2">COTIZACIÓN Nº H6710</h5>
        <table class="table mb-5 border-color-black mt-2">
            <thead>
                <tr class="tr-primaty-style">
                    <td scope="col" class="color-primary p-1 capitalize" style="font-weight: bold;">EMPRESA</td>
                    <td scope="col" class="text-center p-1 capitalize">{{$budget->client->name}}</td>
                    <td scope="col" class="color-primary p-1 capitalize"style="font-weight: bold;">ATENCIÓN</td>
                    <td scope="col" class="text-center p-1 capitalize">{{$budget->user->name}}</td>
                </tr>
                <tr class="tr-primaty-style">
                    <td scope="col" class="color-primary p-1 capitalize" style="font-weight: bold;">RUT</td>
                    <td scope="col" class="text-center p-1 capitalize">{{$budget->client->rut}}}</td>
                    <td scope="col" class="color-primary p-1 capitalize" style="font-weight: bold;">MAIL</td>
                    <td scope="col" class="text-center p-1 capitalize">{{$budget->user->email}}</td>
                </tr>
                <tr class="tr-primaty-style">
                    <td scope="col" class="color-primary p-1 capitalize" style="font-weight: bold;">DIRECCIÓN</td>
                    <td scope="col" class="text-center p-1 capitalize">{{substr($budget->client->address,0,30)}}</td>
                    <td scope="col" class="color-primary p-1 capitalize" style="font-weight: bold;">TELÉFONO</td>
                    <td scope="col" class="text-center p-1 capitalize">{{$budget->user->phone ?? 'asdsad'}}</td>
                </tr>
                <tr class="tr-primaty-style">
                    <td scope="col" class="color-primary p-1 capitalize" style="font-weight: bold;">TELÉFONO</td>
                    <td scope="col" class="text-center p-1 capitalize">CONSTRUCTORA INTERHAUS</td>
                    <td scope="col" class="color-primary p-1 capitalize" style="font-weight: bold;">OTROS</td>
                    <td scope="col" class="text-center p-1 capitalize">MOISÉS RIQUELME</td>
                </tr>
            </thead>
        </table>
        <table class="table mb-5 border-color-black">
            <thead>
                <tr class="tr-primaty-style color-primary">
                    <th scope="col">ITEM</th>
                    <th scope="col">DESCRIPCIÓN</th>
                    <th scope="col">IMAGEN</th>
                    <th scope="col">SKU</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">VALOR UNITARIO</th>
                    <th scope="col">VALOR BRUTO</th>
                </tr>
            </thead>
            <tbody>

                @foreach ( $budget->detailsBudgets as $key => $detailBudget)
                    <tr>
                        <th scope="row" class="color-primary" style="text-align: center; font-weight: 400;">{{$key + 1}}</th>
                        <td style="width: 200px; text-align:center;" class="capitalize">{{$detailBudget->product->name}}</td>
                        <td ><img src="https://www.ledconcept.cl/new/wp-content/uploads/2020/11/C380070.jpg" class="image-container"></td>
                        <td class="text-center" style="width: 50px; max-width: 60px">{{$detailBudget->product->sku}}</td>
                        <td class="text-center" style="width: 60px; max-width: 70px">{{$detailBudget->quantity}}</td>
                        <td class="text-center">{{$detailBudget->product_price}}</td>
                        <td class="text-center">{{$detailBudget->total}}</td>
                    </tr>
                @endforeach



            </tbody>
        </table>
</body>

</html>
