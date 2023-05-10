<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-size: 0.75em;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        h4{
            line-height: 0.8
        }
    </style>
</head>

<body>
    <div class="cabecera">
        <h1>CONVOCATORIA Nª 01 DE 2022 DEL FONDO DE EMPRENDIMIENTO DE FUNZA – FEMF</h1>
    </div>
    <div class="titulo">
        <h2>Relación de notas completas Proyecto {{ $propuesta->titulo }}</h2>
        <h4>Codigo: <strong>{{ $propuesta->codigo }}</strong></h4>
        <h4 style="font-size: 1.2em;">Emprendedor: <strong>{{$propuesta->emprendedor->nombre1 . ' ' . $propuesta->emprendedor->nombre2 . ' ' . $propuesta->emprendedor->apellido1 . ' ' . $propuesta->emprendedor->apellido2 }}</strong></h4>
        <h4 style="font-size: 1.2em;">Telefono: <strong>{{$propuesta->emprendedor->telefono}}</strong></h4>
        <h4 style="font-size: 1.2em;">Email: <strong>{{$propuesta->emprendedor->email}}</strong></h4>
        <h4 style="font-size: 1.2em;">Nota final: <strong>{{number_format($propuesta->promedio_primera, 2, '.', ',')}}</strong></h4>
    </div>
    <div class="notas">
        @foreach ($componentes as $componente)
            <ul style="margin-bottom: 30px;">
                <li style="">
                    <h4>Componente: <strong>{{ $componente->componente }}</strong> nota promedio: {{ number_format($componente->promedio, 2, '.', ',') }}</h4>
                    <ul>
                        @foreach ($componente->sub_componentes as $sub_componente)
                            <li style="margin-bottom: 15px;">
                                @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                    @if ($componenteFaseUno->sub_componente_id === $sub_componente->id)
                                        <h4>Sub-Componente: <strong>{{ $sub_componente->sub_componente }}</strong> nota promedio: {{ number_format($componenteFaseUno->not_promedio, 2, '.', ',') }}</h4>
                                        <table style="width: 100%; margin-top: 20px;">
                                            <thead>
                                                <tr>
                                                    <th style="white-space:nowrap;vertical-align:top;width: 15%;" scope="col">
                                                        Jurado</th>
                                                    <th style="white-space:nowrap;vertical-align:top;width: 15%;" scope="col">
                                                        Calificación</th>
                                                    <th style="white-space:nowrap;vertical-align:top;width: 70%;" scope="col">
                                                        Observaciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $contador = 0;
                                                @endphp
                                                @foreach ($componenteFaseUno->notas as $nota)
                                                    @php
                                                        $contador++;
                                                    @endphp
                                                    <tr>
                                                        <td style="white-space:nowrap;vertical-align:top; width: 15%;">Jurado{{ $contador }}</td>
                                                        <td style="white-space:nowrap;vertical-align:top; width: 15%;text-align: center;">{{ number_format($nota->calificacion, 2, '.', ',') }}</td>
                                                        <td style="text-align: justify;width: 70%;">{{ $nota->observacion ?? '---' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                @endforeach
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <hr>
            <hr>
        @endforeach
    </div>
</body>

</html>
