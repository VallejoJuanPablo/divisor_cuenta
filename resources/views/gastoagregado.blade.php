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
            <div class="col-md-8">
                <div class="card">
                    <div class="card text-center">
                        <div class="card-header">
                            <h2>AGREGAR GASTO REUNION</h2>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Su gasto se ha registrado con éxito.</h5>
                            <a class="btn btn-primary" href="{{ route('home') }}">VOLVER</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
