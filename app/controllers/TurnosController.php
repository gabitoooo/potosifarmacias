<?php

class TurnosController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	public function sorteoturnos()
	{
		$turnssss=Turno::all();
		if (count($turnssss)==0) 
		{
					$error="Primer debe sortear los turnos";
					return View::make('administrador.turnos.errores')->with('error',$error);
	   }		
		else
		{
				$totalzonas=Zona::all();
			$totalcontazonas=count($totalzonas);
			if ($totalcontazonas==0)
			{
				$error="no esta inscrita ninguna zona, ninguna farmacia, primer asignelas y despues sortee";
				return View::make('administrador.turnos.errores')->with('error',$error);
			}
			else
			{
				$contadorzonas=0;
			$comparador=0;
			$frm=Farmacia::all();
			$trns=Farmacia::find($frm[0]->id)->turnos;
			while ($contadorzonas<$totalcontazonas)
			{
				$za[$contadorzonas]=Zona::find($totalzonas[$contadorzonas]->id);
				$fff=Farmacia::where('zona_id','=',$za[$contadorzonas]->id)->get();
				if (count($fff)!=0)
				{
					$comparador++;
				}
				$contadorzonas++;
			}
			if ($comparador!=$totalcontazonas || count($trns)!=0)
			{
				$error="no puede sortear los turnos por que existe una zona que no tene ninguna farmacia registrada o los turnos ya estan sorteados";
				return View::make('administrador.turnos.errores')->with('error',$error);
			}
			else
			{
				$año=date("Y");
				$añosig=$año+1;
				$zonas=Zona::all();
				$contadorzonas=count($zonas);
				$ii=0;
				$prueba=0;
				while ($ii<$contadorzonas)
				{
					$controlaño="";
					$alta=Farmacia::where('zona_id','=',$zonas[$ii]->id)->get();
					$dias=count($alta);
					$diasestaticos=$dias;

					if ($dias<=31)
					{	
						$i=1;
						$empieazodesorteo=1;
						$diassorteados=array("a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a");
						while ( $dias<= 31)
						{
							$sorteo;
							$cont=true;
							$j=$empieazodesorteo;
							foreach ($alta as $a)
							{
								while ($cont==true)
								{
									$sorteo=rand($empieazodesorteo,$dias);
									while ($j<=$dias)
									{
										if ($diassorteados[$j]==$sorteo)
										{
											$cont=true;
											break;
										}
										$cont=false;
										$j++;
									}
										
									$j=$empieazodesorteo;
									if ($cont==false)
									{
									     $diassorteados[$i]=$sorteo;
									    $fec=$año."-01-".$sorteo;
									    $farmacia=Farmacia::find($a->id);
									    $diass="";
									    $farmacia->turnohabilitado="si";
									    $farmacia->save();
									    //echo $farmacia->id." le todo el dia"." : ".$fec."<br>";
									   	while ($año!=$añosig)
									   	{
									   		$tur=Turno::where('fechaturno','=',$fec)->first();
									   		$controlaño= $fec[0].$fec[1].$fec[2].$fec[3];
									   		if ($controlaño==$añosig)
									   		{
									   			break;
									   		}
									   		else
									   		{
									   			$farmacia-> turnos()->attach($tur);
									   			//echo $farmacia->id." le todo el dia"." : ".$tur->fechaturno."<br>";
									   			$prueba++;
									   		}
									   		$fec=strtotime ( '+29 day' , strtotime ( $fec) ) ;
					 						$fec = date ( 'Y-m-j' , $fec );	
									   	}
									    
									    $i++;							
									}
								}
								$cont=true;
								if ($i==32)
								{
									$cont=false;
									break;						
								}
							}
							$empieazodesorteo=$dias+1;
							$dias+=$diasestaticos;
							if ($dias>31)
							{
								$restadias=$dias-31;
								$dias-=$restadias;
							}
							if ($i==32) {
								break;
							}

						}

						
					}
					else
					{
						$fe="";
						$mess=1;
						$diasdelmes=cal_days_in_month(CAL_GREGORIAN,$mess,$año);
						$ddd=$diasdelmes;
						
						$diassorteados=array();
						for ($i=1; $i <=$dias ; $i++) { 
						     $diassorteados[$i]="a";
						}
						$sorteo;
						$cont=true;
						$i=1;
						$j=1;
						$p=1;
						$diasrestantes;
						$inicio=1;
						foreach ($alta as $a)
						{
							$j=$inicio;
							while ($cont ==true)
							{
								$sorteo=rand(1,$ddd);
								while ($j<=$dias)
								{
									if ($diassorteados[$j]==$sorteo)
									{
										$cont=true;
										break;
									}
									$cont=false;
									$j++;						
								}
								$j=$inicio;
								if ($cont==false)
								{
									$diassorteados[$i]=$sorteo;
									$fec=$año."-".$mess."-".$sorteo;
									$farmacia=Farmacia::find($a->id);
									$farmacia->turnohabilitado="si";
									$farmacia->save();
									turnoscadames($año,$añosig,$fec,$farmacia);
									//echo $farmacia->id." le todo el dia"." : ".$fec."<br>";
										while ($año!=$añosig)
									   	{
									   		$tur=Turno::where('fechaturno','=',$fec)->first();
									   		$controlaño= $fec[0].$fec[1].$fec[2].$fec[3];
									   		if ($controlaño==$añosig)
									   	{
									   			break;
									   		}
									   		else
									   		{
									   			$farmacia->turnos()->attach($tur);	
									   			//echo $farmacia->id." le todo el dia"." : ".$tur->fechaturno."<br>";
									   		}
									   		$fec=strtotime ( '+29 day' , strtotime ( $fec) ) ;
					 						$fec = date ( 'Y-m-j' , $fec );	
									   	}
								}
							}
							if ($p==$diasdelmes)
							{
								$mess++;
								$p=1;
								$diasdelmes=cal_days_in_month(CAL_GREGORIAN,$mess,$año);
								$diasrestantes=$dias-$i;
								$inicio=$i+1;
								if ($diasrestantes<=$diasdelmes)
								{
									$ddd=$diasrestantes;
								}
							}
							$i++;
							$p++;
							$cont=true;
						}
					}
					$ii++;
					//echo "<br>"."ZONA:+".$ii;
				}
				//echo "<br>"."ternimo";
				//echo $prueba;
				return Redirect::route('turno.index');
				}
			
			}

		}		
		
	}
	
	public function asignacionturnos()
	{
	
		$trn=Turno::all();
		if (count($trn)==0)
		{
				$turnoss=Turno::all();
			if (count($turnoss)!=0)
			{
				$error="los turnos ya estan asignados";
				return View::make('administrador.turnos.errores')->with('error',$error);
			}
			else
			{
				$año=date("Y");
				$añosig=$año+1;
				$fecha=$año."-01-1";
				$dias="";
				$controlaño="";
				while ($año!=$añosig)
				{
					$controlaño= $fecha[0].$fecha[1].$fecha[2].$fecha[3];
					if ($controlaño==$añosig)
					{
						break;
					}
					else
					{
			 		$turno=new Turno;
			 		$turno->fechaturno=$fecha;
			 		$turno->save();
			 		}
				 	$fecha=strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
				 	$fecha = date ( 'Y-m-j' , $fecha );
				 }
				 //echo "termino asignacion de turnos";
				 return Redirect::route('turno.index');
			}
		
		}
		else
		{
			$error="no puede introducir turnos po que ya fueron asignados";
			return View::make('administrador.turnos.errores')->with('error',$error);
		}
		
		
	}
	public function index()
	{	
		return View::make('administrador.turnos.inicio');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		 $farmacias=Farmacia::where('turnohabilitado','=','no')->get();
		 return View::make('administrador.turnos.store')->with('farmacias',$farmacias);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try 
		{
			$frm=Farmacia::all();
		$trns=Farmacia::find($frm[0]->id)->turnos;
		if (count($trns)!=0)
		{
			$año=date("Y");
			$añosig=$año+1;
			$sorteo=rand(1,31);
			$fec=$año."-01-".$sorteo;
			$farmacia=Farmacia::where('nombre','=',Input::get('farmacia'))->first();
			$farmacia->turnohabilitado="si";
			$farmacia->save();	
			$diass="";
			//echo $farmacia->id." le todo el dia"." : ".$fec."<br>";
			while ($año!=$añosig)
			{
				$tur=Turno::where('fechaturno','=',$fec)->first();
				$controlaño= $fec[0].$fec[1].$fec[2].$fec[3];
				if ($controlaño==$añosig)
				{
					break;
				}
				else
				{
					$farmacia-> turnos()->attach($tur);
					//echo $farmacia->id." le todo el dia"." : ".$tur->fechaturno."<br>";
				}
				$fec=strtotime ( '+29 day' , strtotime ( $fec) ) ;
				$fec = date ( 'Y-m-j' , $fec );	
			}
			return Redirect::route('turno.index');
		}
		else
		{
			$error="todavia no se sortearon los turnos, esta opcion es para asignar turnos a nuevas farmacias despues de haber sorteado los turnos ";
			return View::make('administrador.turnos.errores')->with('error',$error);
		}
			
		} catch (Exception $e) {
			$error="esta tratando de hacer cosas incorrectas";
			return View::make('administrador.turnos.errores')->with('error',$error);
		}
		
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function eliminarturnos()
	{
	  try {
	  		$turno=Turno::all();
		$cont=0;
		while ($cont<count($turno))
		{
			$farmacias=Turno::find($turno[$cont]->id)->farmacias;
			for ($i=0; $i <count($farmacias) ; $i++)
			{ 
				$farmacia=Farmacia::find($farmacias[$i]->id);
				$farmacia->turnos()->detach($turno[$cont]->id);
			}
			$cont++;
		}
		for ($i=0; $i < count($turno); $i++) { 
			Turno::destroy($turno[$i]->id);
			//echo "se elimino: ".$turno[$i]->fechaturno;		
		}
			return Redirect::route('turno.index');
	  	} catch (Exception $e) {
	  		return Redirect::route('turno.index');
	  	}	
		

	}
	public function Rturnos()
	{
		return View::make('administrador.turnos.reporteturnos');
	}
	public function Rporfechaespecifica()
	{
		try {
				$todo=Input::all();
			$reglas = array(
				'fecha' => 'required|exists:turnos,fechaturno',
				
			);
			$validator=Validator::make($todo,$reglas);
			if ($validator->fails()) {
				return Redirect::back()->withErrors($validator);
			}
			else{
				$fecha=Turno::where('fechaturno','=',Input::get('fecha'))->first();
				$farmacias=Turno::find($fecha->id)->farmacias;
				//foreach ($farmacias as $key) {
				//	echo $key->nombre."<br>";
				//}
				$html = View::make('administrador.turnos.reporteporfecha')->with('farmacias',$farmacias)->with('fecha',$fecha);
	    		return PDF::load($html, 'A4', 'portrait')->download('zonasreporte');
				//return View::make('administrador.turnos.reporteporfecha')->with('farmacias',$farmacias)->with('fecha',$fecha);
			}
		} catch (Exception $e) {
			$error="No existen fechas de turnos asignadas todava, o esta tratand de realizar acciones incorrectas";
					return View::make('administrador.turnos.errores')->with('error',$error);
		}
		
	}
	public function Rpormes()
	{
		try {
			$año=date("Y");
		$mess;
		$nombremes=Input::get('mes');
		switch (Input::get('mes')) {
		    case "Enero":
		        $mess=1;
		        break;
		    case "Febrero":
		        $mess=2;
		        break;
		    case "Marzo":
		        $mess=3;
		        break;
		    case "Abril":
		        $mess=4;
		        break;
		    case "Mayo":
		        $mess=5;
		        break;
		    case "Junio":
		       $mess=6;
		        break;
		    case "Julio":
		        $mess=7;
		        break;
		    case "Agosto":
		        $mess=8;
		        break;
		    case "Septiembre":
		        $mess=9;
		        break;
		    case "Octubre":
		        $mess=10;
		        break;
		    case "Noviembre":
		       $mess=11;
		        break;
		    case "Diciembre":
		        $mess=12;
		        break;
		}
		$i=1;
		$messig=$mess+1;
		$fecha=$año."-".$mess."-".$i;
		
		$fec;
		while ( $mess< $messig) {
			$controlaño= $fecha[5].$fecha[6];
									if ($controlaño==$messig)
									 {
									   			break;
									 }
									   		else
									 {
									   		$f=$año."-".$mess."-".$i;
									   		$actual=Turno::where('fechaturno','=',$f)->first();
									   		$fec[$i]=Turno::find($actual->id)->farmacias;
									   		//foreach ($fec[$i] as $key) {
									   		//	echo $i."-".$key->nombre."<br>";
									   		//}
									   			
									}
									$fecha=strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
				 					$fecha = date ( 'Y-m-j' , $fecha );
				 					$i++;

		}
		$html = View::make('administrador.turnos.reportepormes')->with('fec',$fec)->with('nombremes',$nombremes);
    	return PDF::load($html, 'A4', 'portrait')->download('zonasreporte');
		//return View::make('administrador.turnos.reportepormes')->with('fec',$fec)->with('nombremes',$nombremes);

		 

			
		} catch (Exception $e) {
			$error="No existen fechas de turnos asignadas todava, o esta tratand de realizar acciones incorrectas";
					return View::make('administrador.turnos.errores')->with('error',$error);
		}
		
	}
	public function Rdehoy()
	{
		try {
			$fecha = date ("Y-m-j");
		$fe=Turno::where('fechaturno','=',$fecha)->first();
		$farmacias=Turno::find($fe->id)->farmacias;
		//foreach ($farmacias as $key) {
		//	echo $key->nombre."<br>";
		//}
		$html = View::make('administrador.turnos.reportehoy')->with('farmacias',$farmacias)->with('fecha',$fecha);
    	return PDF::load($html, 'A4', 'portrait')->download('zonasreporte');
		} catch (Exception $e) {
			$error="No existen fechas de turnos asignadas todava, o esta tratand de realizar acciones incorrectas";
					return View::make('administrador.turnos.errores')->with('error',$error);
		}
		
	}
}
