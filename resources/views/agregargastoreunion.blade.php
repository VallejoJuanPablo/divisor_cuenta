@extends('layouts.app')


@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<meta name="deadline" content="asds" >
<div class="container">
    <div class="row text-center">
        <div class="col-12">
            <h1 class="">AGREGAR GASTO REUNION</h1>
        </div>
        <div class="col-12">
            <h2></h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{route('procesar_agregargastoreunion')}}" id="form">
                @csrf  
                <input type="hidden" name="semana" value="14">
                  <div class="form-group row">
                    <div class="col-12">
                        <label for="codigo">CODIGO</label>
                        <div>
                            <input type="text" class="form-control" name="codigo" id="codigo" placeholder="" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <label for="dni">DNI</label>
                        <div>
                            <input type="text" class="form-control" name="dni" id="dni" placeholder="" minlength="6"
                                maxlength="10" pattern="[0-9]+" title="Solo se admiten números" required>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">Sin puntos ni espacios. Ej: 30123456</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <label for="nombre">NOMBRE</label>
                        <div>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="" required>
                        </div>
                    </div>
                </div>
               <div class="form-group row">
                    <div class="col-12">
                        <label for="monto">MONTO</label>
                        <div>
                            <input type="text" class="form-control" name="monto" id="monto" placeholder="" required>
                        </div>
                    </div>
                </div>  
                <div class="form-group row">
                    <div class="col-12">
                        <label for="descripcion">DESCRIPCION GASTO</label>
                        <div>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="" required>
                        </div>
                    </div>
                </div>  
                <div class="row ">
                    <div class="col-12 text-center">
                        <a class="btn btn-primary" href="{{url()->previous()}}">VOLVER</a>
                        <button id="btn_aceptar" class="btn btn-primary">AGREGAR GASTO REUNION</button>
                        <button type="submit" id="btn_aceptar_real" class=" d-none btn btn-primary">AGREGAR GASTO REUNION</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('style')

 <link href="{{asset('css/turnero.css') }}" rel="stylesheet"> 
@endsection

@section('script')
@endsection