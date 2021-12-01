<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cotización {{$budget->id}}</title>
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
        footer {
                position: fixed;
                left: 0px;
                bottom: 60px
                right: 0px;
                height: 200px;

                /** Extra personal styles **/
                background-color: transparent;
                color: white;
                text-align: center;
                line-height: 35px;
            }

            .v-text-field.v-text-field--solo:not(.v-text-field--solo-flat)
  > .v-input__control
  > .v-input__slot {
  box-shadow: none;
  font-size: 14px;
}
.v-text-field.v-text-field--enclosed .v-text-field__details {
  display: none;
}
.no-image {
  width: 50px;
  height: 50px;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 4px;
  background: #1d34486e !important;
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
                <td width="30%" style="border: 0px solid transparent; vertical-align: bottom;"><h5 style="font-size: 10px; font-weight: bold;" class="text-right align-bottom">{{$date}}</h5></td>
            </tr>
        </table>
        <table class="table border-color-black color-primary mb-5" style="border: 0px solid transparent;">
            <tr style="border: 0px solid transparent;">
                <th class="p-0 pt-2 ml-1" width="80%" style="font-size: 10px; border: 0px solid transparent; border-bottom: 5px solid #000000; "><span>LED Concept SPA - Rut: 76.628.935-5 - Dirección: Avda. Tobalaba # 4899, Ñuñoa - Teléfono: 2 2 981 6267 </span></th>
                <th class="p-0 pt-2 text-right mr-1" style="font-size: 10px; border: 0px solid transparent; border-bottom: 5px solid #000000;"><span>www.ledconcept.cl</span></th>
            </tr>

        </table>
        <h5 class="text-center pb-2">COTIZACIÓN Nº {{$budget->id}}</h5>
        <table class="table mb-5 border-color-black mt-2" cellspacing="10">
            <thead>
                <tr class="tr-primaty-style" style="border-spacing:10px;  border-collapse: separate;
                border-spacing:  5px;">
                    <td scope="col" class="color-primary p-1 capitalize" style="font-weight: bold;">EMPRESA</td>
                    <td scope="col" class="text-center p-1 capitalize">{{$budget->client->name}}</td>

                </tr>
                <tr class="tr-primaty-style">
                    <td scope="col" class="color-primary p-1 capitalize" style="font-weight: bold;">RUT</td>
                    <td scope="col" class="text-center p-1 capitalize">{{$budget->client->rut}}</td>

                </tr>
                <tr class="tr-primaty-style">
                    <td scope="col" class="color-primary p-1 capitalize" style="font-weight: bold;">DIRECCIÓN</td>
                    <td scope="col" class="text-center p-1 capitalize">{{substr($budget->client->address,0,30)}}</td>

                </tr>
                <tr class="tr-primaty-style">
                    <td scope="col" class="color-primary p-1 capitalize" style="font-weight: bold;">TELÉFONO</td>
                    <td scope="col" class="text-center p-1 capitalize">{{$budget->client->phone}}</td>
                </tr>
                <tr class="tr-primaty-style">
                    <td scope="col" class="color-primary p-1 capitalize" style="font-weight: bold;">OTROS</td>
                    <td scope="col" class="text-center p-1 capitalize">{{$budget->reference}}</td>
                </tr>

            </thead>
        </table>
        <table class="table border-color-black">
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
                        <td >@if (!$detailBudget->product->image)
                            <div class="bg-secondary no-image">
                                <div class="text-no-imagen">
                                  <div>Sin Imagen</div>
                                </div>
                              </div>
                             @else
                             <img src="{{asset($detailBudget->product->image)}}" class="image-container"></td>
                        @endif
                        <td class="text-center" style="width: 50px; max-width: 60px">{{$detailBudget->product->sku}}</td>
                        <td class="text-center" style="width: 60px; max-width: 70px">{{$detailBudget->quantity}}</td>
                        <td class="text-center">@money($detailBudget->product_price)</td>
                        <td class="text-center">@money($detailBudget->product_price * $detailBudget->quantity)</td>
                    </tr>
                @endforeach

                    <tr style="border-top: 1px solid black; padding: 0px;" class="tr-primaty-style">
                        <td colspan="5" style="border:2px solid white; border-right: 1px solid black; padding: 2px; border-top: 1px solid black;"></td>
                        <td class="color-primary capitalize" style="font-weight: bold; padding: 2px">NETO</td>
                        <td style="padding: 2px">@money($budget->neto)</td>
                    </tr>
                    <tr style="border:none; padding: 0px;" class="tr-primaty-style">
                        <td colspan="5" style="border:2px solid white; border-right: 1px solid black; padding: 2px"></td>
                        <td class="color-primary capitalize" style="font-weight: bold; padding: 2px">IVA</td>
                        <td style="padding: 2px">@money($budget->iva)</td>
                    </tr>
                    <tr style="border:none; padding: 0px;" class="tr-primaty-style">
                        <td colspan="5" style="border:2px solid white; border-right: 1px solid black; padding: 2px"></td>
                        <td class="color-primary capitalize" style="font-weight: bold; padding: 2px">DESCUENTO</td>
                        <td style="padding: 2px">- @money($discount)</td>
                    </tr>
                    <tr style="border:none; padding: 0px;" class="tr-primaty-style">
                        <td colspan="5" style="border:2px solid white; border-right: 1px solid black; padding: 2px"></td>
                        <td class="color-primary capitalize" style="font-weight: bold; padding: 2px">TOTAL</td>
                        <td style="padding: 2px">@money($budget->total)</td>
                    </tr>

            </tbody>

        </table>
        <table class="table CUSTOM-TABLE-DATA">
            <tr>
                <td>
                    <b style="text-decoration: underline;">OBSERVACIONES</b>
                    <div style="font-size: 12px;"><b>VALIDEZ COTIZACIÓN:</b> 15 DÍAS HÁBILES</div>
                    <div style="font-size: 12px;">La presente cotización <b>NO</b> garantiza reserva de stock</div>
                    <div style="font-size: 12px;"><b>* Imágenes referenciales</b></div>
                </td>
                <td>
                    <b style="text-decoration: underline;">DATOS CUENTA LED CONCEPT</b>
                    <div style="font-size: 12px;"><b>BANCO:</b> SANTANDER</div>
                    <div style="font-size: 12px;"><b>CUENTA:</b> 70580110</div>
                    <div style="font-size: 12px;"><b>RAZÓN SOCIAL:</b> LED CONCEPT SPA</div>
                    <div style="font-size: 12px;"><b>RUT:</b> 76.628.935-5</div>

                </td>
            </tr>
        </table>
        <table class="table border-color-black color-primary mb-5" style="border: 0px solid transparent; margin-top:auto;">
            <tr style="border: 0px solid transparent;" align="middle">
                <th class="p-0 pt-2 pb-2 mr-1 text-center" align="start" style="font-size: 10px; border: 0px solid transparent; text-align:center;"><span class="text-center">Ejecutivo: {{$budget->user->name}}</span></th>
            </tr>
            <tr style="border: 0px solid transparent;" align="middle">
                <th class="p-0 pt-2 pb-2 mr-1 text-center" align="start" style="font-size: 10px; border: 0px solid transparent; border-bottom: 5px solid #000000; text-align:center;"><span class="text-center">Teléfono: {{$budget->user->phone}}</span></th>
            </tr>
        </table>

</body>

</html>
