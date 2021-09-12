<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cotizaciones</title>
    {{-- <link  href="{{asset('css/bootstrap5.css')}}" rel="stylesheet"> --}}
    <style>
        body {
            font-size: 11px;
        }

        body>.container-fluid {
            padding: 20px 15px 0;
        }

        .table {
            margin: auto;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        th {
            display: table-cell;
            vertical-align: inherit;
            font-weight: bold;
            text-align: -internal-center;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: black;
        }

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
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
                            <th class="">Encargado</th>
                            <th class="">Neto</th>
                            <th class="">Iva</th>
                            <th class="">Total</th>
                            <th class="">Estado</th>
                            <th class="">Fecha Creacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budgets as $budget)
                            <tr>
                                <td class="">{{ $budget->id }}</td>
                                <td class="">{{ $budget->client->name }}</td>
                                <td class="">{{ $budget->user->name }}</td>
                                <td class="">{{ $budget->neto }}</td>
                                <td class="">{{ $budget->iva }}</td>
                                <td class="">{{ $budget->total }}</td>
                                <td class="">{{ $budget->statusTrashed->name }}</td>
                                <td class="">{{ $budget->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>
