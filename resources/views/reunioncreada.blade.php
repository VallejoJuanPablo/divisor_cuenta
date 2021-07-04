@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card text-center">
                        <div class="card-header">
                       <h2>REUNION CREADA</h2>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Su reunion se ha registrado con éxito.</h5>
                            <p class="card-text">Podras agregar gastos con el siguiente CODIGO:{{$codigo}} </p> 
                             <a class="btn btn-primary" href="{{route('home')}}">VOLVER</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
