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
		//$data['q1'] = $CI->db->last_query();
		$PesoTalla= $CI->PesoTalla->Cargar($data);//talla, genero, num_tabla
		//$data['q2'] = $CI->db->last_query();
		$PesoEdad= $CI->PesoEdad->Cargar($data); //edad, genero
		//$data['q3'] = $CI->db->last_query();

		$talla = $data['talla'];
		$peso = $data['peso'];


		//FILAS CON LLAS REGLAS - OPCIONAL
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
				$data['diagnostico'] = 'Alto +';
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
				$data['diagnostico3'] = 'Sobrepeso +';
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
				$data['diagnostico3'] = 'Desnutrición +';
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
}


//end application/helpers/evaluacion_helper.php
