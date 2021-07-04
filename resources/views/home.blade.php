@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0" style="background-color: transparent">
               <div class="card-body">
                
                      <a    class="btn btn-lg btn-verde btn-block" href="{{route('crear.reunion')}}"><h2>CREAR REUNION</h2> </a> 
                      {{-- <a    class="btn btn-lg btn-secondary btn-block"><h2>SOLICITAR TURNO</h2> </a> --}}
                      
                     <a   class="btn btn-lg btn-verde btn-block" href="{{route('agregargasto.reunion')}}"href=""><h2>AGREGAR GASTO A REUNION</h2></a>
                     
                      <a   class="btn btn-lg btn-verde btn-block" href="{{route('generarpagos.reunion')}}"href=""><h2>GENERAR PAGOS DE REUNION</h2></a>

                </div>
                <div class="card-body text-center " style="background-color: transparent">
                <img class="img img-responsive w-75" src="" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
   
@endsection
@section('style')
 <link href="{{asset('css/reunion.css') }}" rel="stylesheet"> 

@endsection