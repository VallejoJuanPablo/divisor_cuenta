@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Lista de Gastos</h1>
            <div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('success') }}
                    </div>
                @endif

                <br>
                <table class="table table-bordered table-sm table-striped" style="table-layout: fixed;font-size:13px;">
                    <thead>
                        <tr>
                            <th scope="col" style=" width: 6%; text-align: center;">Id</th>
                            <th scope="col" style=" width: 8%; text-align: center;">Dni</th>
                            <th scope="col" style=" width: 9%; text-align: center;">Nombre</th>
                            <th scope="col" style=" width: 10%; text-align: center;">Gasto</th>
                            <th scope="col" style=" width: 19%; text-align: center;">Descripcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gastos as $gasto)
                            <tr>
                                <th scope="row">{{ $gasto->id }}</th>
                                <td>{{ $gasto->dni }}</td>
                                <td>{{ $gasto->nombre }}</td>
                                <td>{{ $gasto->monto}}</td>
                                <td>{{ $gasto->descripcion }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
<div class="row justify-content-center">
            <h1>Lista de Pagos</h1>
            <div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('success') }}
                    </div>
                @endif

                <br>
                <table class="table table-bordered table-sm table-striped" style="table-layout: fixed;font-size:13px;">
                    <thead>
                        <tr>
                         <th scope="col" style=" width: 8%; text-align: center;">DNI PAGANTE</th>
                            <th scope="col" style=" width: 8%; text-align: center;">DNI COBRANTE</th>
                            <th scope="col" style=" width: 9%; text-align: center;">SE LE DEBE </th>
                            <th scope="col" style=" width: 9%; text-align: center;">SE LE PAGA </th>
                              <th scope="col" style=" width: 9%; text-align: center;">SALDO</th>      
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagos as $pago)
                            <tr>
                                <td>{{ $pago['pagante_dni'] }}</td>
                                <td>{{ $pago['cobrante'] }}</td>
                                <td>{{ number_format((float)$pago['se le debe'] , 2, '.', '') }}</td>
                                <td>{{number_format((float)$pago['se le paga'] , 2, '.', '') }}</td>
                                 <td>{{number_format((float)$pago['saldo_cobrante'] , 2, '.', '')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
                  <a class="btn btn-primary" href="{{ route('home') }}">VOLVER</a>
        </div>
    </div>
@endsection
