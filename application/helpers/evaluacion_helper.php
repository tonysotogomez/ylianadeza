<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('evaluar'))
{
	function evaluar($data)
	{
		$CI =& get_instance();
		$CI->load->model("TallaEdad_model","TallaEdad");
		$CI->load->model("PesoTalla_model","PesoTalla");
		$CI->load->model("PesoEdad_model","PesoEdad");

		//Si es menor de 2 años se buscará en las tablas 1
		$data['num_tabla'] = ($data['edad'] < 2)?'1':'2';
		//Cargo las filas correspondientes a los datos ingresados
		$TallaEdad= $CI->TallaEdad->Cargar($data);//edad, genero, num_tabla
		$PesoEdad= $CI->PesoEdad->Cargar($data); //edad, genero

		//UPDATE correcion de insertar valores diferentes de .0 y .5
		$data['talla2'] = $data['talla'];
		$talla_t = explode('.',$data['talla']);

		if(isset($talla_t[1])){
			if($talla_t[1] == 0 || $talla_t[1] == 1 || $talla_t[1] == 2 || $talla_t[1] == 3 || $talla_t[1] == 4) $decimal = 0;
			else $decimal = 5;
			$data['talla2'] = $talla_t[0].'.'.$decimal;
		}
		if($data['talla'] == '45.1' or $data['talla'] == '45.2' or $data['talla'] == '45.3' or $data['talla'] == '45.4') $data['talla2'] = 45.1;

		$PesoTalla= $CI->PesoTalla->Cargar($data);//talla, genero, num_tabla
		// /$data['query'] = $data['talla2'].' query: '.$CI->db->last_query();

		$talla = $data['talla'];
		$peso = $data['peso'];


		//FILAS CON LAS REGLAS - OPCIONAL
		$data['talla_edad'] = $TallaEdad;
		$data['peso_talla'] = $PesoTalla;
		$data['peso_edad'] = $PesoEdad;

		//INICIALIZO RESULTADOS
		$data['diagnostico'] = '-'; //talla_edad
		$data['diagnostico2'] = '-'; //peso_talla
		$data['diagnostico3'] = '-'; //peso_edad

		//TALLA PARA LA EDAD
		if(! empty($TallaEdad) && $talla != 0) {
				if($talla > $TallaEdad[0]->DE3) {
				$data['diagnostico'] = 'Alto';//Alto +
				$data['color'] = 'yellow';
				$data['porcentaje'] = '90';
			} elseif($talla > $TallaEdad[0]->DE2 && $talla <= $TallaEdad[0]->DE3) {
				$data['diagnostico'] = 'Alto';
				$data['color'] = 'yellow';
				$data['porcentaje'] = '70';
			}elseif($talla >= $TallaEdad[0]->DE2menos && $talla <= $TallaEdad[0]->DE2) {
				$data['diagnostico'] = 'Normal';
				$data['color'] = 'light-blue';
				$data['porcentaje'] = '50';
			}elseif($talla < $TallaEdad[0]->DE3menos) {
				$data['diagnostico'] = 'Talla Baja Severa';
				$data['color'] = 'red';
				$data['porcentaje'] = '10';
			} elseif($talla < $TallaEdad[0]->DE2menos && $talla >= $TallaEdad[0]->DE3menos) {
				$data['diagnostico'] = 'Talla Baja';
				$data['color'] = 'red';
				$data['porcentaje'] = '30';
			}
		}
		//PESO PARA LA EDAD
		if( ! empty($PesoEdad) && $peso != 0) {
			if($peso > $PesoEdad[0]->DE3) {
				$data['diagnostico3'] = 'Sobrepeso';//Sobrepeso +
				$data['color3'] = 'yellow';
				$data['porcentaje3'] = '90';
			} elseif($peso > $PesoEdad[0]->DE2 && $peso <= $PesoEdad[0]->DE3) {
				$data['diagnostico3'] = 'Sobrepeso';
				$data['color3'] = 'yellow';
				$data['porcentaje3'] = '70';
			}elseif($peso >= $PesoEdad[0]->DE2menos && $peso <= $PesoEdad[0]->DE2) {
				$data['diagnostico3'] = 'Normal';
				$data['color3'] = 'light-blue';
				$data['porcentaje3'] = '50';
			}elseif($peso < $PesoEdad[0]->DE3menos) {
				$data['diagnostico3'] = 'Desnutrición';//Desnutrición +
				$data['color3'] = 'red';
				$data['porcentaje3'] = '10';
			} elseif($peso < $PesoEdad[0]->DE2menos && $peso >= $PesoEdad[0]->DE3menos) {
				$data['diagnostico3'] = 'Desnutrición';
				$data['color3'] = 'red';
				$data['porcentaje3'] = '30';
			}
		}
		//PESO PARA LA TALLA
		if( ! empty($PesoTalla) && $peso != 0 ){
			if($peso > $PesoTalla[0]->DE3) {
				$data['diagnostico2'] = 'Obesidad';
				$data['color2'] = 'yellow';
				$data['porcentaje2'] = '90';
			} elseif($peso > $PesoTalla[0]->DE2 && $peso <= $PesoTalla[0]->DE3) {
				$data['diagnostico2'] = 'Sobrepeso';
				$data['color2'] = 'yellow';
				$data['porcentaje2'] = '70';
			}elseif($peso >= $PesoTalla[0]->DE2menos && $peso <= $PesoTalla[0]->DE2) {
				$data['diagnostico2'] = 'Normal';
				$data['color2'] = 'light-blue';
				$data['porcentaje2'] = '50';
			}elseif($peso < $PesoTalla[0]->DE3menos) {
				$data['diagnostico2'] = 'Desnutrición Severa';
				$data['color2'] = 'red';
				$data['porcentaje2'] = '10';
			} elseif($peso < $PesoTalla[0]->DE2menos && $peso >= $PesoTalla[0]->DE3menos) {
				$data['diagnostico2'] = 'Desnutrición Aguda';
				$data['color2'] = 'red';
				$data['porcentaje2'] = '30';
			}
		}

		return $data;
	}

	//resta los valores y muestra en rojo si disminuyo o verde si aumento
	if(!function_exists('comparar'))
	{
		function comparar($valor_ant, $valor_act)
		{
			if ($valor_act != 0) {
			$talla_dif = $valor_act-$valor_ant;
			$talla_dif = number_format($talla_dif, 2);
			if( $talla_dif > 0) $talla_creci = '<span class="text-green">+'.$talla_dif.'</span>';
			elseif ($talla_dif < 0) $talla_creci = '<span class="text-red">'.$talla_dif.'</span>';
			else $talla_creci = '<span class="text-muted">'.$talla_dif.'</span>';
			} else {
				$talla_creci = ' ';
			}
			return $talla_creci;
		}
	}

//sin estilos para el excel
	if(!function_exists('comparar2'))
	{
		function comparar2($valor_ant, $valor_act)
		{
			if ($valor_act != 0) $talla_dif = ($valor_act-$valor_ant);
			else $talla_dif = ' ';
			return $talla_dif;
		}
	}

	if(!function_exists('diagnostico'))
	{
		function diagnostico($resultado)
		{
			//TALLA PARA LA EDAD
			switch ($resultado) {
				case 'Alto': $color = '<span class="text-yellow">'.$resultado.'</span>';
					break;
				case 'Talla Baja': $color = '<span class="text-red">'.$resultado.'</span>';
					break;
				case 'Talla Baja Severa': $color = '<span class="text-red">'.$resultado.'</span>';
						break;
				case 'Obesidad': $color = '<span class="text-yellow">'.$resultado.'</span>';
					break;
				case 'Sobrepeso': $color = '<span class="text-yellow">'.$resultado.'</span>';
					break;
				case 'Desnutrición Severa': $color = '<span class="text-red">'.$resultado.'</span>';
					break;
				case 'Desnutrición Aguda': $color = '<span class="text-red">'.$resultado.'</span>';
					break;
				case 'Desnutrición': $color = '<span class="text-red">'.$resultado.'</span>';
					break;
				case 'Normal': $color = '<span class="text-light-blue">'.$resultado.'</span>';
					break;
				default: $color = '<span class="text-muted">'.$resultado.'</span>';
					break;
			}
			return $color;
		}
	}


}


//end application/helpers/evaluacion_helper.php
