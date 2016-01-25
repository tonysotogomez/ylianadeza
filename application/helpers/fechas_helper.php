<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//si no existe la función convertir_edad la creamos
if(!function_exists('convertir_fecha'))
{
	function convertir_fecha($fecha)
	{

		$day=substr($fecha,8,2);
		$month=substr($fecha,5,2);
		$year=substr($fecha,0,4);
		$hour = substr($fecha,11,5);
		$datetime_format=$day."-".$month."-".$year.' '.$hour;
		return $datetime_format;

	}
}

//end application/helpers/fechas_helper.php
