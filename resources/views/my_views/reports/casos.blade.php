<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Casos</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" media="screen">
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 1cm 1cm 1cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #e2cc06;
            color: black;
            text-align: center;
            line-height: 35px;
        }

        p {
            text-align: left;
        }

        h4 {
            text-align: center;
            font-size: 20px;
            font-weight: bolder;
        }

        h4 div {
            text-decoration: underline;
        }

        h1 {
            text-align: center;
            text-decoration: underline;
            font-size: 22px;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #ddd;
        }

        span {
            font-weight: bold;
        }

        img {
            margin: auto;
            display: block;
            width: 7rem;
            height: 7rem;
            position: absolute;
            padding-left: 35rem;
        }

        table {
            border-top-width: 0px;
            border-bottom-width: 1px;
            border-color: rgb(17 24 39);
        }
    </style>
    <style>
        .datagrid table {
            border-collapse: collapse;
            text-align: center;
            width: 100%;
        }

        .datagrid {
            font: normal 12px/150% Arial, Helvetica, sans-serif;
            background: #fff;
            overflow: hidden;
        }

        .datagrid table td,
        .datagrid table th {
            padding:
                20px 0px;
        }

        .datagrid table thead {
            border-bottom: solid 5px #0F362D;
        }

        .datagrid table thead th {
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#F7A400',
                endColorstr='#F37413');
            background-color: #F7A400;
            color: #F37413;
            font-size: 13px;
            font-weight: bold;
            border-left: 0px solid #F7A400;
            text-align: left;
        }

        .datagrid table thead tr th {
            color: white;
            text-align: center;
        }

        .datagrid table thead th:first-child {
            border: none;
        }

        .datagrid table tbody td {
            color: #000000;
            font-size: 13px;
            font-weight: normal;
            border-right: solid 1px #D3D3D3;
            border-left: solid 1px #D3D3D3;
        }

        .datagrid table tbody .alt td {
            background: #DFFFDE;
            color: #22ff00;
        }

        .datagrid table tbody td:first-child {
            border-left: none;
        }

        .datagrid table tbody tr:last-child td {
            border-bottom:
                none;
        }

        .datagrid table tfoot td div {
            border-top: 1px solid #000000;
            background: #DFFFDE;
        }

        .datagrid table tfoot td {
            padding: 0;
            font-size: 12px
        }

        .datagrid table tfoot td div {
            padding: 2px;
        }

        .datagrid table tfoot td ul {
            margin: 0;
            padding: 0;
            list-style: none;
            text-align: right;
        }

        .datagrid table tfoot li {
            display: inline;
        }

        .datagrid table tfoot li a {
            text-decoration: none;
            display: inline-block;
            padding: 2px 8px;
            margin: 1px;
            color: #FFFFFF;
            border: 1px solid #F7A400;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #F7A400), color-stop(1, #F37413));
            background: -moz-linear-gradient(center top, #F7A400 5%, #F37413 100%);
            filter: prog
        }
    </style>

</head>

<body>

    <main>
        <h1>Casos Judiciales Registrados
        </h1>
        <img class="logo"
            src="https://media.istockphoto.com/id/1202321149/vector/lady-justice-themis-golden-emblem.jpg?s=612x612&w=0&k=20&c=DBml6l96xTAEcymXBIoSvk260tltoJ7JO8xcc43RAfY=" alt="">

        <p>
            {{-- <span>Usuario:</span> {{ auth()->user()->name }}. <br> --}}
            <span>Fecha:</span> {{ now()->format('Y-m-d') }}.
            <br><span>Hora:</span> {{ now()->format('H:i') }}.
        </p>

        <h4>
            <div> Casos Jurídicos: </div>
        </h4>

        <div class="datagrid">
            <table>
                <thead>
                    <tr>
                        <th>Caso</th>
                        <th>Descripción</th>
                        <th>Requerimientos</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Finalización</th>
                        <th>Demandante</th>
                        <th>Demandado</th>
                        <th>Juez</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($casos as $caso)
                        <tr>
                            <td>{{ $caso->nombre }}</td>
                            <td>{{ $caso->descripcion }}</td>
                            <td>{{ $caso->requerimientos }}</td>
                            <td>{{ $caso->fecha_inicio }}</td>
                            @if ($caso->fecha_finalizacion != null)
                                <td>{{ $caso->fecha_finalizacion }}</td>
                            @else
                                En proceso
                            @endif
                            <td>{{ $caso->demandante }}</td>
                            <td>{{ $caso->demandado }}</td>
                            <td>{{ $caso->juez }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>
