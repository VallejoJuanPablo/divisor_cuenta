<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Reunion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ReunionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function formulariocrearreunion(Request $request)
    { 
  
        return view('crearreunion');
    }
    
    public function crearreunion(Request $request)
    { 
         $codigo = Str::random(4);  
      /*   $turnos = Turno::where('dni','=',$request->dni)->whereDate('created_at', Carbon::today())->get();
        $count = count($turnos);
        if($count > 0){
            return redirect()->route('turnorechazado')
            ->withErrors('Usted ya solicito un turno en el día de la fecha')
            ->withInput();
        }  */
        
      
        //Validacion de campos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'dni' => 'required',
            'motivo' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('crearacionrechazada')
                        ->withErrors($validator)
                        ->withInput();
        }

        $re = new Reunion();
        $re->codigo= $codigo;  
        $re->dni_generador= $request->dni;
        $re->nombre_generador= $request->nombre;  
        $re->motivo= $request->motivo;
        $re->estado= "A";  
        $re->save();
        
        return view('reunioncreada',["codigo"=>$codigo]);
    }
}
