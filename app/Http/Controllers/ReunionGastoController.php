<?php

namespace App\Http\Controllers;

use App\Reunion_gasto;
use App\Reunion;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ReunionGastoController extends Controller
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

    public function formularioagregargastoreunion(Request $request)
    { 
  
        return view('agregargastoreunion');
    }
    
    public function agregargastoreunion(Request $request)
    { 
       
       
        
      
        //Validacion de campos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'codigo' => 'required',
            'monto' => 'required',
            'dni' => 'required',
            'descripcion' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('crearacionrechazada')
                        ->withErrors($validator)
                        ->withInput();
        }

        $re = Reunion::where('codigo','=',$request->codigo)->where('estado','=','A')->get(); 
        $count = count($re);
        if($count = 0){
            return redirect()->route('turnorechazado')
            ->withErrors('Usted ya solicito un turno en el día de la fecha')
            ->withInput();
        }  
        $re = Reunion::where('codigo','=',$request->codigo)->where('estado','=','A')->first(); 
        $reg = new Reunion_gasto();
        $reg->id_reunion= $re->id;
        $reg->codigo= $request->codigo;
        $reg->dni= $request->dni;
        $reg->nombre= $request->nombre;  
        $reg->monto= $request->monto;
        $reg->descripcion= $request->descripcion;
        $reg->estado= "A";  
        $reg->save();
        $regs = Reunion_gasto::where('codigo','=',$request->codigo)->get(); 
        return view('gastoagregado',["gastos"=>$regs]);
    }
}
