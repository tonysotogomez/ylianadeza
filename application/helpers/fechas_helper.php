<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//si no existe la función convertir_fecha la creamos
//convierte la fecha de nacimiento en edad formato año.meses
if(!function_exists('convertir_fecha'))
{
	function convertir_fecha($fecha_nac)
	{
		if($fecha_nac != 0) {
			list($anio, $mes, $dia) = explode("-",$fecha_nac);
			$mes = (int)$mes;
			$dias = (int)$dia;
			$f1=mktime(0,0,0,$mes,$dias,$anio);
			$edad_s=time()-$f1;
			$edad_a=$edad_s/(60*60*24*365);
			$edad_m=($edad_a-(int)$edad_a)*12; //Multiplicamos la parte decimal de los años por 12 para obtener los meses.
			$edad_d=($edad_m-(int)$edad_m)*24;//Multiplicamos la parte decimal de los meses por 24 para sacar los días.
			$edad_meses=($edad_a)*12;//meses totales
			//Luego debemos coger únicamente la parte entera de cada numero;
			//$edad=(int)($edad_s/(60*60*24*365)); edad en años
			$edad_a=(int)$edad_a; //Años
			$edad_m=(int)$edad_m; //Meses
			$edad_d=(int)$edad_d; //Dias

			if($edad_a == 0) {
				$edad = $edad_m.' meses';
			} elseif($edad_a > 0) {
				$edad = $edad_a.' años y '.$edad_m.' meses';
			}
			$meses_totales = (int)$edad_meses;
			$edad_decimales = $edad_a.'.'.$edad_m;
		} else {
			$edad_decimales = 0;
		}
		return $edad_decimales;
	}
}

//end application/helpers/fechas_helper.php
