<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cotizaciones</title>
    <style>
        body {
            font-size: 11px
        }

        table {
            width: 100%;
            vertical-aling: left;
        }

        td {
            padding-top: 5px;
            padding-bottom: 5px;
            padding-right: 5px;
        }

        tr {
            border: 1px solid black;
        }

        th {
            padding-top: 15px;
            padding-bottom: 15px;
            padding-right: 15px;
        }

        table {
            border-collapse: collapse;
        }

        td {
            border-bottom: 1pt solid gray;
        }

        .text-rigth {
            text-align: right;

        }

        .padding-rigth {
            padding-right: 20px;
        }

        .img {
            position: initial;

        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <img class="img" src="{{ asset('logo.png') }}" width="40" alt="">
                <h1 class="titulo"> Reportes de Cotizaciones </h1>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th class="">Cliente</th>
                            <th class="">Ejecutivo</th>
                            <th class="      ">Neto</th>
                            <th class="">Iva</th>
                            <th class="">Total</th>
                            <th class="     ">Estado</th>
                            <th class=" ">Fecha Creacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budgets as $budget)
                            <tr>
                                <td class="">{{ $budget->id }}</td>
                                <td class="">{{ $budget->client->name }}</td>
                                <td class="
                                    ">
                                    {{ $budget->user ? $budget->user->name : 'Usuario Eliminado' }}</td>
                                <td class="text-rigth">
                                    {{ $budget->netoAppends }}</td>
                                <td class="text-rigth">{{ $budget->ivaAppends }}</td>
                                <td class="text-rigth padding-rigth">{{ $budget->totalAppends }}</td>
                                <td class="">{{ $budget->statusTrashed->name }}</td>
                                <td class="">{{ $budget->created_at }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Totales</td>
                            <td class="text-rigth">$ {{ number_format($neto, 0, ',', '.') }}</td>
                            <td class="text-rigth">$ {{ number_format($iva, 0, ',', '.') }}</td>
                            <td class="text-rigth">$ {{ number_format($total, 0, ',', '.') }}</td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>
