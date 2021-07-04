<?php

namespace App\Http\Controllers;

use App\Pago;
use App\Reunion;
use App\Reunion_gasto;
use DB;
use Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagoController extends Controller
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

    public function formulariogenerarpagosreunion(Request $request)
    {

        return view('generarpagos');
    }

    public function generarpagosreunion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo' => 'required',
            'dni' => 'required',
            'personas' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('crearacionrechazada')
                ->withErrors($validator)
                ->withInput();
        }

        $re = Reunion::where('codigo', '=', $request->codigo)->where('dni_generador', '=', $request->dni)->get();
        $count = count($re);
        if ($count = 0) {
            return redirect()->route('turnorechazado')
                ->withErrors('Usted ya solicito un turno en el día de la fecha')
                ->withInput();
        }

        $regs = Reunion_gasto::where('codigo', '=', $request->codigo)->get();


        $monto_total = 0;
       
        foreach ($regs as $reg) {
            $monto_total = $monto_total + $reg->monto;
        }
        $re = Reunion::where('codigo', '=', $request->codigo)->where('dni_generador', '=', $request->dni)->find(1);
        error_log("Monto total ". $monto_total);
        $re->monto_total = $monto_total;
        $total_x_persona = $monto_total / $request->personas;
        error_log("Monto total por cabeza". $total_x_persona);
        $re->personas = $request->personas;
        $re->estado = 'C';
        $re->save();
        $gastos = Reunion_gasto::where('codigo', '=', $request->codigo)->get();
        $regs = Reunion_gasto::where('codigo', '=', $request->codigo)->get();
        $regs = DB::table('reunion_gastos')
        ->select('dni', DB::raw('sum(monto) as monto'))
        ->where('codigo','=',$request->codigo)
        ->groupBy('dni')
        ->get()->toArray();
      
       
        //Validacion de campos
        $personas = array();
        $montos = array();
        $id = 0;
        foreach ($regs as $reg) {
            $aux = 1;
            foreach ($personas as $persona) {
                if ($persona['dni'] == $reg->dni) {
                    $aux = 0;
                  
                }
            }
            if ($aux) {
                $persona = array();
                $persona =  Arr::add($persona, 'dni', $reg->dni);
                $persona =  Arr::add($persona, 'monto', $reg->monto);
                $persona =  Arr::add($persona, 'diferencia', $reg->monto-$total_x_persona);
                $montos =  Arr::add($montos, $reg->dni, $reg->monto);
                $personas =  Arr::add($personas, $id, $persona);
                $id += 1;
            }
        }
        //error_log("personas". $personas);
        $count = count($montos);
        $J = 1;
        for ($i = $count; $i <  $request->personas; $i++) {
            $persona = array();
            $persona =  Arr::add($persona, 'dni', 'Persona '.$J);
            $persona =  Arr::add($persona, 'monto', '0');
            $persona =  Arr::add($persona, 'diferencia', 0-$total_x_persona);
            $personas =  Arr::add($personas, $id, $persona);
            $id += 1;
            $J +=1;
        }
        
        error_log("%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%");
        error_log("%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%");
        error_log("%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%");
        $pagos = array();
        $deudas = $personas;
        $count = count($deudas);
        $id=1;
        for($i = 0 ; $i <$count ;$i++){
            error_log("dni".$deudas[$i]['dni']." , " . $deudas[$i]['diferencia']);
            if($deudas[$i]['diferencia'] < 0){
                for($j= 0 ; $j <$count ;$j++){
                    if($deudas[$i]['diferencia'] == 0 ){
                        error_log("dni".$deudas[$i]['dni']." , " . $deudas[$i]['diferencia']);
                    }else{
                    if($deudas[$j]['diferencia'] > 0){
                        error_log("dni cobrador".$deudas[$j]['dni']." , " . $deudas[$j]['diferencia']);
                        
                        $pago = array();
                        $pago =  Arr::add($pago, 'pagante_dni', $deudas[$i]['dni']);
                        $pago =  Arr::add($pago, 'cobrante', $deudas[$j]['dni']);   
                        $pago =  Arr::add($pago, 'se le debe', $deudas[$j]['diferencia']);   
                        if ($deudas[$j]['diferencia'] + $deudas[$i]['diferencia'] < 0){ 
                            $pago =  Arr::add($pago, 'se le paga', $deudas[$j]['diferencia']);
                            $deudas[$i]['diferencia'] = $deudas[$i]['diferencia'] + $deudas[$j]['diferencia']; 
                            $deudas[$j]['diferencia'] = 0;
                            error_log("debe mas de lo que tiene que cobrar");
                            error_log("sigue debiendo". $deudas[$i]['diferencia']);
                        }else{
                            $deudas[$j]['diferencia'] = $deudas[$j]['diferencia'] + $deudas[$i]['diferencia'];  
                            $pago =  Arr::add($pago, 'se le paga', $deudas[$i]['diferencia']);
                            $deudas[$i]['diferencia'] = 0; 
                            error_log("debe menos de lo que tiene que cobrar");
                        }                                  
                        $pago =  Arr::add($pago, 'saldo_cobrante', $deudas[$j]['diferencia']);
                        $pagos =  Arr::add($pagos, $id, $pago);
                    
                        $id+=1;
                        error_log("dni cobrador saldo".$deudas[$j]['dni']." , " . $deudas[$j]['diferencia']);
                    }
                }
                }
            }
           // unset($deudas[$i]);
        }
        return view('pagosarealizar',['pagos'=>$pagos,'gastos'=>$gastos]);
    }
}
