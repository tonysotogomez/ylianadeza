<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examen extends CI_Controller {

	public function __construct() {
        parent::__construct();
         $this->header['title']= "Localhost";
				 $this->header['url']= base_url();
				 $this->load->model("Alumno_model","Alumno");
				 $this->load->model("Aula_model","Aula");
				 $this->header['lactantes'] = $this->Aula->CargarMenu(1);
				 $this->header['andantes'] = $this->Aula->CargarMenu(2);
				 $this->header['infantes'] = $this->Aula->CargarMenu(3);
				 $this->header['jardin'] = $this->Aula->CargarMenu(4);
				 $this->load->helper(array('form'));
    }



	public function index()
	{
		$this->load->view('header_view', $this->header);
		$this->load->view('examen_view');
		$this->load->view('footer_view');
	}

	public function ejecutar()
	{
		if($this->input->is_ajax_request()){
			$this->load->model("TallaEdad_model","TallaEdad");
			$this->load->model("PesoTalla_model","PesoTalla");
			$this->load->model("PesoEdad_model","PesoEdad");

			$data['edad'] = (float)$this->input->post('edad');
			$peso = (float)$this->input->post('peso');
			$talla = (float)$this->input->post('talla');

			$data['talla'] = $talla;
			$data['peso'] = $peso;
			$data['genero'] = $this->input->post('genero');

			/*-----------------CALCULOS----------------*/

			//Si es menor de 2 años se buscará en las tablas 1
			$data['num_tabla'] = ($data['edad'] < 2)?'1':'2';
			//Cargo las filas correspondientes a los datos ingresados
			$TallaEdad= $this->TallaEdad->Cargar($data);//edad, genero, num_tabla
			$PesoTalla= $this->PesoTalla->Cargar($data);//talla, genero, num_tabla
			$PesoEdad= $this->PesoEdad->Cargar($data); //edad, genero
			//echo $this->db->last_query();

			$data['talla_edad'] = $TallaEdad;
			$data['peso_talla'] = $PesoTalla;
			$data['peso_edad'] = $PesoEdad;

			$data['diagnostico'] = 'ninguno';
		//	$data['regla'] = $reglas;
			//TALLA PARA LA EDAD
			if($talla > $TallaEdad[0]->DE3) {
				$data['diagnostico'] = 'Alto mas';
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
				$data['diagnostico'] = 'Talla Baja mas';
				$data['color'] = 'red';
				$data['porcentaje'] = '10';
			} elseif($talla < $TallaEdad[0]->DE2menos && $talla >= $TallaEdad[0]->DE3menos) {
				$data['diagnostico'] = 'Talla Baja';
				$data['color'] = 'red';
				$data['porcentaje'] = '30';
			}
			//PESO PARA LA TALLA
			$data['diagnostico2'] = 'ninguno';
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
			//PESO PARA LA EDAD
			$data['diagnostico3'] = 'ninguno';
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
			//	echo $diagnostico;
			//$data['resultados'] = TRUE;
//$data['r3'] = $diagnostico;


$edad = explode(".",$TallaEdad[0]->edad);
$edad2 = $edad[0].':'.(int)$edad[1];

$tabla1 = '';
$tabla1 .= '<tr><td>'.$edad2.'</td>';
$tabla1 .= '<td>'.$TallaEdad[0]->meses.'</td>';
$tabla1 .= '<td>'.$TallaEdad[0]->DE3menos.'</td>';
$tabla1 .= '<td>'.$TallaEdad[0]->DE2menos.'</td>';
$tabla1 .= '<td>'.$TallaEdad[0]->DE1menos.'</td>';
$tabla1 .= '<td>'.$TallaEdad[0]->Mediana.'</td>';
$tabla1 .= '<td>'.$TallaEdad[0]->DE1.'</td>';
$tabla1 .= '<td>'.$TallaEdad[0]->DE2.'</td>';
$tabla1 .= '<td>'.$TallaEdad[0]->DE3.'</td></tr>';
$data['tabla1'] = $tabla1;

$tabla2 = '';
$tabla2 .= '<tr><td>'.$PesoTalla[0]->cm.'</td>';
$tabla2 .= '<td>'.$PesoTalla[0]->DE3menos.'</td>';
$tabla2 .= '<td>'.$PesoTalla[0]->DE2menos.'</td>';
$tabla2 .= '<td>'.$PesoTalla[0]->DE1menos.'</td>';
$tabla2 .= '<td>'.$PesoTalla[0]->Mediana.'</td>';
$tabla2 .= '<td>'.$PesoTalla[0]->DE1.'</td>';
$tabla2 .= '<td>'.$PesoTalla[0]->DE2.'</td>';
$tabla2 .= '<td>'.$PesoTalla[0]->DE3.'</td></tr>';
$data['tabla2'] = $tabla2;


$edad = explode(".",$PesoEdad[0]->edad);
$edad2 = $edad[0].':'.(int)$edad[1];

$tabla3 = '';
$tabla3 .= '<tr><td>'.$edad2.'</td>';
$tabla3 .= '<td>'.$PesoEdad[0]->meses.'</td>';
$tabla3 .= '<td>'.$PesoEdad[0]->DE3menos.'</td>';
$tabla3 .= '<td>'.$PesoEdad[0]->DE2menos.'</td>';
$tabla3 .= '<td>'.$PesoEdad[0]->DE1menos.'</td>';
$tabla3 .= '<td>'.$PesoEdad[0]->Mediana.'</td>';
$tabla3 .= '<td>'.$PesoEdad[0]->DE1.'</td>';
$tabla3 .= '<td>'.$PesoEdad[0]->DE2.'</td>';
$tabla3 .= '<td>'.$PesoEdad[0]->DE3.'</td></tr>';
$data['tabla3'] = $tabla3;

			echo json_encode($data);
		} //end is_ajax_request



/*
	$this->load->view('header_view', $this->header);
	$this->load->view('examen_view', $data);
	$this->load->view('footer_view');
*/


	}


}


//END Alumno Controller
