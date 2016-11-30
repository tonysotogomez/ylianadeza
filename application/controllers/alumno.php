<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller {

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
				 $this->footer['js_custom'] = '<script src="'.base_url().'dist/js/mantenimiento/alumno.js"></script>';
				 $this->load->helper(array('form', 'fechas_helper','chart_helper'));
    }

	public function index()
	{
		$this->header['alumno_m'] = true; //activa el menu
		$this->load->view('header_view', $this->header);
		$this->load->view('alumno/mantenimiento_alumno_view');
		$this->load->view('footer_view', $this->footer);
	}

	public function nuevo()
	{
		$this->data['aulas'] = $this->Aula->CargarMenu(0); // con 0 cara todas las aulas
		$this->load->view('header_view', $this->header);
		$this->load->view('alumno/alumno_new_view',$this->data);
		$this->load->view('footer_view');
	}

	public function verificar()
	{
		if($this->input->is_ajax_request()){
			$data['nombres'] = $this->input->post('nombres');

			if($this->Alumno->Verificar($data) == 1) {
				$data['rst'] = 1;
				$data['msj'] = 'Existe un alumno registrado con ese nombre. ';
			} else {
				$data['rst'] = 0;
				$data['msj'] = 'No existe coincidencia';
			}
			echo json_encode($data);
		}
		else echo 'Funcion ajax';
	}

	public function crear()
	{
		if($this->input->is_ajax_request()){
			$data['aula']      = $this->input->post('aula');
			$data['nombres']   = $this->input->post('nombres');
			$data['apellidos'] = $this->input->post('apellidos');
			$data['genero']    = $this->input->post('radiogenero');
			$data['titular']   = $this->input->post('titular');
			$data['dni']       = $this->input->post('dni');
			$data['estado']    = $this->input->post('estado');

			if ($this->input->post('fecha')) {
				$date = str_replace('/', '-', $this->input->post('fecha'));
				$data['fecha'] = date('Y-m-d', strtotime($date));
			} else {
					$data['fecha'] = '1970-01-01';
			}

			$data['tipo'] = 'success';
			if($this->Alumno->Insertar($data)) {
				$data['rst'] = 1;
				$data['msj'] = 'Alumno registrado correctamente';
			} else {
				$data['rst'] = 0;
				$data['msj'] = 'Ocurrio un error en el registro';
			}
			echo json_encode($data);
		}
		else echo 'Funcion ajax';
	}

	public function cargar()
	{
		$id = $this->input->post('id');
		$data['alumno'] = $this->Alumno->CargarAlumno($id);
		echo json_encode ($data);
	}

	public function editar()
	{
		if($this->input->is_ajax_request()){
			$data['id']        = $this->input->post('id');
			$data['aula']      = $this->input->post('aula');
			$data['nombres']   = $this->input->post('nombres');
			$data['apellidos'] = $this->input->post('apellidos');
			$data['genero']    = $this->input->post('radiogenero');
			$data['titular']   = $this->input->post('titular');
			$data['dni']       = $this->input->post('dni');
			$data['estado']    = $this->input->post('estado');

			if ($this->input->post('fecha')) {
				$date = str_replace('/', '-', $this->input->post('fecha'));
				$data['fecha'] = date('Y-m-d', strtotime($date));
			} else {
					$data['fecha'] = '1970-01-01';
			}
			/** CAMBIO DE AULA **/
			//las aulas pueden tener la misma cantidad de evaluaciones, pero el alumno puede tener igual o MENOS, asi que se debe hacer 2 validaciones
			$idAlumno   = $this->input->post('id');
			$idAula     = $this->input->post('aula');;
			$alumno     = $this->Alumno->CargarAlumno($idAlumno);
			$errorArray = Array();
			$msj        = '';
			$result['tipo'] = 'success';
			//si las aulas son diferentes, se procede a verificar el cambio
			if ($alumno[0]->idAula != $idAula) {
				//verifico si el alumno tiene evaluaciones, sino no pasa nada
				$evaluaciones = $this->Evaluacion->Cargar($idAlumno);

				if (isset($evaluaciones) && (count($evaluaciones)>0)) {
					$numEvalAntiguaAula = count($this->Evaluacion->CargarEvaluaciones($alumno[0]->idAula)); //cuenta evaluaciones pero no el detalle
					$numEvalNuevaAula   = count($this->Evaluacion->CargarEvaluaciones($idAula));

					// 1ra Validacion: verifico si tienen la misma cantidad de evaluaciones
					if ($numEvalAntiguaAula == $numEvalNuevaAula) {

						$contador = 1;
						//se buscara pasar las evaluaciones del aula antigua al aula nueva
						foreach ($evaluaciones as $e) {
							$buscar['numero']    = $e->num;
							$buscar['idAula']    = $idAula; //aula nueva
							$evaluacionNuevaAula = $this->Evaluacion->CargarEvaluacionAula($buscar); //evaluacion de la nueva aula



							if (count($evaluaciones)>0) {
								//si se encontro la evaluacion compatible, es decir con el mismo "numero"
								$update['idDetalle']    = $e->idDetalle; //id del Detalle de evaluacion antiguo
								$update['idAlumno']     = $idAlumno;
								$update['idEvaluacion'] = $evaluacionNuevaAula[0]->id;  //id del Detalle de evaluacion nuevo
								$update['idAula']       = $idAula;
								$estado                 = $this->Evaluacion->updateAulaEvaluacion($update);
								$msj                    = 'Se cambio de aula.';
							}
						} //end foreach
					} else {
						$data['aula']   = $alumno[0]->idAula; //le asigno el aula que ya tenia
						$msj            = 'No se cambio de aula, alguna de las aulas tienen diferente cantidad de evaluaciones.';
						$result['tipo'] = 'warning'; //mensaje naranja de advertencia
					}
				}
			}

//$this->Alumno->Editar($data)
			if($this->Alumno->Editar($data)) {
				$result['rst'] = 1;
				$result['msj'] = 'Alumno actualizado correctamente. '.$msj;
			} else {
				$result['rst'] = 0;
				$result['msj'] = 'Ocurrio un error en la actualización.';
			}
			echo json_encode($result);
		}
	}

	public function cambiarestado()
	{
		$estado = $this->input->post('estado');

		$data['estado'] = ($estado == 1)?'0':'1';
		$data['id']     = $this->input->post('id');

		if($this->Alumno->activardesactivar($data)) {
			$data['rst'] = 1;
			$data['msj'] = 'Alumno actualizado correctamente';
		} else {
			$data['rst'] = 0;
			$data['msj'] = 'Ocurrio un error en la actualización';
		}
		echo json_encode($data);
	}

	public function eliminar()
	{
		$id = $this->input->post('id');

		if($this->Alumno->Eliminar($id)) {
			$this->Evaluacion->EliminarDetallePermanente($id);
			$data['rst'] = 1;
			$data['msj'] = 'Alumno eliminado permanentemente';
		} else {
			$data['rst'] = 0;
			$data['msj'] = 'Ocurrio un error en la actualización';
		}
		echo json_encode($data);
	}

	public function perfil($idAlumno)
	{
		$string_peso       = '';
		$string_talla      = '';
		$string_evaluacion = '';
		$this->load->helper(array('evaluacion_helper'));
		$this->load->model("Evaluacion_model","Evaluacion");

		$alumno               = $this->Alumno->PerfilAlumno($idAlumno);
		$evaluaciones         = $this->Evaluacion->Cargar($idAlumno);
		$data['alumno']       = $alumno;
		$data['evaluaciones'] = $evaluaciones;

		foreach ($evaluaciones as $evaluacion) {
			if ($evaluacion->diagnostico_id == 7) continue;
			foreach ($evaluacion as $key => $value) {
				if ($key == 'peso') {
						$string_peso .= $value.',';
				}
				if ($key == 'talla') {
						$string_talla .= $value.',';
				}
				if ($key == 'num') {
						$string_evaluacion .= $value.',';
				}
			}
		}

		$pesovalores['serie']         = $string_peso;
		$pesovalores['categorias']    = $string_evaluacion; // numero de evaluacion
		$pesovalores['nombre_serie']  = 'Peso';

		$tallavalores['serie']        = $string_talla;
		$tallavalores['categorias']   = $string_evaluacion; // numero de evaluacion
		$tallavalores['nombre_serie'] = 'Talla';

		$pesodatos['titulo']          = 'Peso';
		$pesodatos['subtitulo']       = $alumno[0]->nombres.' '. $alumno[0]->apellidos;
		$pesodatos['container_id']    = 'peso_line_container';
		$pesodatos['yaxis']           = 'Kilogramos';
		$pesodatos['unidad']          = 'kg';


		$talladatos['titulo']         = 'Talla';
		$talladatos['subtitulo']      = $alumno[0]->nombres.' '. $alumno[0]->apellidos;
		$talladatos['container_id']   = 'talla_line_container';
		$talladatos['yaxis']          = 'Centímetros';
		$talladatos['unidad']         = 'cm';


		$this->footer['js_custom'] .= script_line($pesovalores, $pesodatos).' '. script_line($tallavalores, $talladatos);

		$this->load->view('header_view', $this->header);
		$this->load->view('alumno/perfil_view',$data);
		$this->load->view('footer_view',$this->footer);
	}

	public function examen()
	{
		$this->load->model("Historial_model","Historial");
		$this->load->model("Edad_model","Edad");

		$data['idAlumno'] = $this->input->post('txtid');
	//	$data['idEdad'] = $this->input->post('txtedad'); //formato 18 -> 1 año 6 meses
		$data['idPeso'] = $this->input->post('txtpeso');
		$data['idTalla'] = $this->input->post('txttalla');
		$data['observaciones'] = $this->input->post('txtobservacion');
		$data['fecha'] = now(); //FALTA VALIDAR FORMATO DE DECHA

		$genero = $this->input->post('txtsexo');
		$arr_edad = $this->Alumno->ObtenerEdad($this->input->post('txtedad')); //Obtenemos el id de la Edad y su equivalente decimal

		$data['idEdad'] = $arr_edad['0']->id; //idEdad para Tabla Historial y Alumno
		$edad = $arr_edad['0']->edad; //edad en formato 1.01 -> 1 año 1 mes

		$this->Alumno->ActualizarDatos($data); //Se actualizan para tener sus ultimos datos
		$this->Historial->Guardar($data); //Se guardan en su historial

		if($genero == 'h'){
			//Talla para la edad NIÑOS
			$this->load->model("TallaEdadHombre_model","TallaEdad");


		} elseif($genero == 'm') {
			//Talla para la edad NIÑAS
			$this->load->model("TallaEdadMujer_model","TallaEdad");


		}

		redirect('alumno/diagnostico/'.$data['idAlumno']);
	}


		public function total()
		{
			$data['total'] = $this->Alumno->CountAll();
			echo json_encode($data);
		}

}


//END Alumno Controller
