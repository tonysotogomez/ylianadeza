<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examen extends CI_Controller {

	public function __construct() {
        parent::__construct();
         $this->header['title']= "Localhost";
				 $this->header['url']= base_url();
				 $this->load->model("Alumno_model","Alumno");
				 $this->load->model("Aula_model","Aula");
				 $this->load->model("Evaluacion_model","Evaluacion");
				 $this->header['lactantes'] = $this->Aula->CargarMenu(1);
				 $this->header['andantes'] = $this->Aula->CargarMenu(2);
				 $this->header['infantes'] = $this->Aula->CargarMenu(3);
				 $this->header['jardin'] = $this->Aula->CargarMenu(4);

				 $this->footer['js_custom'] = '<script src="'.base_url().'dist/js/examen/examen.js"></script>';

				 $this->load->helper(array('fechas_helper', 'evaluacion_helper', 'form'));
				 //$this->output->enable_profiler(TRUE);
    }

	public function index()
	{
		$this->load->view('header_view', $this->header);
		$this->load->view('examen_view');
		$this->load->view('footer_view', $this->footer);
	}

	public function prueba()
	{
		$data['edad'] = (float)'0.07';
		$data['talla'] = (float)'65.5';
		$data['peso'] = (float)'7';
		$data['genero'] = 'h';

		$arr = evaluar($data);
		//echo $this->db->last_query();
		echo 'Talla Edad: '.$arr['diagnostico'].'<br>'; //talla_edad
		echo 'Peso Talla: '.$arr['diagnostico2'].'<br>'; //peso_talla
		echo 'Peso Edad: '.$arr['diagnostico3']; //peso_edad
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

				$edad = explode(".",$TallaEdad[0]->edad);
				$edad2 = $edad[0].':'.(int)$edad[1];

				$tabla1 = '';
				$tabla1 .= '<tr><td>'.$edad2.'</td>';
				$tabla1 .= '<td>'.$TallaEdad[0]->meses.'</td>';
				$tabla1 .= '<td bgcolor="#F3E2A9" align="center">'.$TallaEdad[0]->DE3menos.'</td>';
				$tabla1 .= '<td bgcolor="#AABDCE" align="center">'.$TallaEdad[0]->DE2menos.'</td>';
				$tabla1 .= '<td bgcolor="#AABDCE" align="center">'.$TallaEdad[0]->DE1menos.'</td>';
				$tabla1 .= '<td bgcolor="#AABDCE" align="center">'.$TallaEdad[0]->Mediana.'</td>';
				$tabla1 .= '<td bgcolor="#AABDCE" align="center">'.$TallaEdad[0]->DE1.'</td>';
				$tabla1 .= '<td bgcolor="#AABDCE" align="center">'.$TallaEdad[0]->DE2.'</td>';
				$tabla1 .= '<td bgcolor="#F3E2A9" align="center">'.$TallaEdad[0]->DE3.'</td></tr>';
				$data['tabla1'] = $tabla1;

				$tabla2 = '';
				$tabla2 .= '<tr><td>'.$PesoTalla[0]->cm.'</td>';
				$tabla2 .= '<td bgcolor="#F3E2A9" align="center">'.$PesoTalla[0]->DE3menos.'</td>';
				$tabla2 .= '<td bgcolor="#AABDCE" align="center">'.$PesoTalla[0]->DE2menos.'</td>';
				$tabla2 .= '<td bgcolor="#AABDCE" align="center">'.$PesoTalla[0]->DE1menos.'</td>';
				$tabla2 .= '<td bgcolor="#AABDCE" align="center">'.$PesoTalla[0]->Mediana.'</td>';
				$tabla2 .= '<td bgcolor="#AABDCE" align="center">'.$PesoTalla[0]->DE1.'</td>';
				$tabla2 .= '<td bgcolor="#AABDCE" align="center">'.$PesoTalla[0]->DE2.'</td>';
				$tabla2 .= '<td bgcolor="#F3E2A9" align="center">'.$PesoTalla[0]->DE3.'</td></tr>';
				$data['tabla2'] = $tabla2;


				$edad = explode(".",$PesoEdad[0]->edad);
				$edad2 = $edad[0].':'.(int)$edad[1];

				$tabla3 = '';
				$tabla3 .= '<tr><td>'.$edad2.'</td>';
				$tabla3 .= '<td>'.$PesoEdad[0]->meses.'</td>';
				$tabla3 .= '<td bgcolor="#F3E2A9" align="center">'.$PesoEdad[0]->DE3menos.'</td>';
				$tabla3 .= '<td bgcolor="#AABDCE" align="center">'.$PesoEdad[0]->DE2menos.'</td>';
				$tabla3 .= '<td bgcolor="#AABDCE" align="center">'.$PesoEdad[0]->DE1menos.'</td>';
				$tabla3 .= '<td bgcolor="#AABDCE" align="center">'.$PesoEdad[0]->Mediana.'</td>';
				$tabla3 .= '<td bgcolor="#AABDCE" align="center">'.$PesoEdad[0]->DE1.'</td>';
				$tabla3 .= '<td bgcolor="#AABDCE" align="center">'.$PesoEdad[0]->DE2.'</td>';
				$tabla3 .= '<td bgcolor="#F3E2A9" align="center">'.$PesoEdad[0]->DE3.'</td></tr>';
				$data['tabla3'] = $tabla3;

			echo json_encode($data);
		} //end is_ajax_request
	}

	public function evaluacion($idAula){
		$this->data['datos_aula'] = $this->Aula->CargarAula($idAula);
		$this->data['evaluaciones'] = $this->Evaluacion->CargarEvaluaciones($idAula);
		$this->load->view('header_view', $this->header);
		$this->load->view('examen/listado_view',$this->data);
		$this->load->view('footer_view', $this->footer);
	}

	public function nuevoDetalle($idAula)
	{
		$this->data['datos_aula'] = $this->Aula->CargarAula($idAula);
		$evaluaciones = $this->Evaluacion->CargarEvaluaciones($idAula);
		$fecha = (empty($evaluaciones))?'no ha sido realizada':date('d-m-Y', strtotime($evaluaciones[0]->fecha));
		$this->data['count_eval'] = count($evaluaciones);
		$this->data['ult_eval'] = $fecha;
		$this->load->view('header_view', $this->header);
		$this->load->view('alumno/examen_view',$this->data);
		$this->load->view('footer_view', $this->footer);
	}

	public function cargarDetalle($idEvaluacion, $idAula)
	{
		$this->data['datos_aula'] = $this->Aula->CargarAula($idAula);
		$this->data['detalle'] = $this->Evaluacion->CargarDetalle($idEvaluacion);

		$this->load->view('header_view', $this->header);
		$this->load->view('examen/examen_edit_view',$this->data);
		$this->load->view('footer_view', $this->footer);
	}

	public function insertarDetalle()
	{
		if($this->input->is_ajax_request()){
			$result = false;
			$alumnos = $this->Alumno->CargarAlumnoID($this->input->post('aula'));

			//Creo la evaluacion
			$data['idAula'] = $this->input->post('aula');
			$data['nombre'] = $this->input->post('titulo');
			$data['fecha'] = date("Y-m-d");
			$this->Evaluacion->Crear($data);

			//Obtengo el id de la evaluacion
			$data['idEvaluacion'] = $this->db->insert_id();
			$data['fecha'] = $this->input->post('fecha_eval');

			//Ingreso los datos en el detallleEvaluacion
			for ($i=0, $len = count($alumnos); $i < $len; $i++) {
				$fecha_nac = $this->input->post('fecha_'.$alumnos[$i]->id);
				$data['genero'] = $this->input->post('genero_'.$alumnos[$i]->id);
				$edad_decimales = convertir_fecha($fecha_nac);

				$data['idAlumno'] = $alumnos[$i]->id;
				$data['edad'] = (float)$edad_decimales;
				$data['peso'] = (float)$this->input->post('peso_'.$alumnos[$i]->id);
				$data['talla'] = (float)$this->input->post('talla_'.$alumnos[$i]->id);
				$data['observaciones'] = $this->input->post('observaciones_'.$alumnos[$i]->id);

				/* Evaluacion Nutricional */
				$resultado = evaluar($data);//edad, peso, talla y genero (h o m)

				$data['talla_edad'] = $resultado['diagnostico']; //talla_edad
				$data['peso_edad'] = $resultado['diagnostico3']; //peso_edad
				$data['peso_talla'] = $resultado['diagnostico2']; //peso_talla

				//$data['obs'] = $resultado['q1'].' | '.$resultado['q2'].' | '.$resultado['q3']; guarda los queris de busqueda
				$result = $this->Evaluacion->InsertarDetalle($data);
			}//end for

			if($result) {
				$data['rst'] = 1;
				$data['msj'] = 'Evaluación registrada correctamente';
				$data['aula'] = $this->input->post('aula');
			} else {
				$data['rst'] = 0;
				$data['msj'] = $this->db->last_query();
			}
			echo json_encode($data);
		}
		else redirect("home");
	}

	public function editarDetalle()
	{
		if($this->input->is_ajax_request()){
			$result = false;
			$alumnos = $this->Alumno->CargarAlumnoID($this->input->post('aula'));

			//actualizo el titulo d ela evaluacion
			$data['nombre'] = $this->input->post('titulo');
			$data['id'] = $this->input->post('idEval');
			$this->Evaluacion->Editar($data);
			$data['idEvaluacion'] = $this->input->post('txt_idEval');
			//$data['fecha'] = $this->input->post('fecha_eval');

			for ($i=0, $len = count($alumnos); $i < $len; $i++) {
			//	$fecha_nac = $this->input->post('fecha_'.$alumnos[$i]->id);

			//	$edad_decimales = convertir_fecha($fecha_nac);
				$data['idDetalle'] = $this->input->post('detalle_'.$alumnos[$i]->id);
			//	$data['idAlumno'] = $alumnos[$i]->id;
			//	$data['edad'] = $edad_decimales;
				$data['peso'] = $this->input->post('peso_'.$alumnos[$i]->id);
				$data['talla'] = $this->input->post('talla_'.$alumnos[$i]->id);
				$data['observaciones'] = $this->input->post('observaciones_'.$alumnos[$i]->id);
				$result = $this->Evaluacion->EditarDetalle($data);
			}

			if($result) {
				$data['rst'] = 1;
				$data['msj'] = 'Evaluación Actualizada correctamente';
				$data['aula'] = $this->input->post('aula');
			} else {
				$data['rst'] = 0;
				$data['msj'] = $this->db->last_query();
			}
			echo json_encode($data);
		}
		else redirect("home");
	}

	public function eliminar()
	{
		if($this->input->is_ajax_request()){
			$result = false;
			$idEvaluacion = $this->input->post('id');
			$this->Evaluacion->Eliminar($idEvaluacion); //cambio estado a 0
			$detalle = $this->Evaluacion->CargarDetalle($idEvaluacion);

			for ($i=0, $len = count($detalle); $i < $len; $i++) {
				//cambio los detalles a estado 0
				$result = $this->Evaluacion->EliminarDetalle($detalle[$i]->id);
			}

			if($result) {
				$data['rst'] = 1;
				$data['msj'] = 'Evaluacion Eliminada';
			} else {
				$data['rst'] = 0;
				$data['msj'] = $this->db->last_query();
			}
			echo json_encode($data);
		}
		else redirect("home");
	}


}


//END Alumno Controller
