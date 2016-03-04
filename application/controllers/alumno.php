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
				 $this->load->helper(array('form'));
    }

	public function index()
	{
		//totales
		$this->data['hombres'] = $this->Aula->contarAlumnos('h');
		$this->data['mujeres'] = $this->Aula->contarAlumnos('m');
		$this->data['totales'] = $this->Aula->contarAlumnos('all');

		$this->load->view('header_view', $this->header);
		$this->load->view('alumno/mantenimiento_alumno_view',$this->data);
		$this->load->view('footer_view', $this->footer);
	}

	public function nuevo()
	{
		$this->data['aulas'] = $this->Aula->CargarMenu(0); // con 0 cara todas las aulas
		$this->load->view('header_view', $this->header);
		$this->load->view('alumno/alumno_new_view',$this->data);
		$this->load->view('footer_view');
	}

	public function crear()
	{
		if($this->input->is_ajax_request()){
			$data['aula'] = $this->input->post('aula');
			$data['nombres'] = $this->input->post('nombres');
			$data['apellidos'] = $this->input->post('apellidos');
			$date = str_replace('/', '-', $this->input->post('fecha'));
			$data['fecha'] = date('Y-m-d', strtotime($date));
			$data['genero'] = $this->input->post('radiogenero');
			$data['titular'] = $this->input->post('titular');
			$data['estado'] = $this->input->post('estado');

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
		echo json_encode ($data) ;
	}

	public function editar()
	{
		if($this->input->is_ajax_request()){
			$data['id'] = $this->input->post('id');
			$data['aula'] = $this->input->post('aula');
			$data['nombres'] = $this->input->post('nombres');
			$data['apellidos'] = $this->input->post('apellidos');
			$date = str_replace('/', '-', $this->input->post('fecha'));
			$data['fecha'] = date('Y-m-d', strtotime($date));
			$data['genero'] = $this->input->post('radiogenero');
			$data['titular'] = $this->input->post('titular');
			$data['estado'] = $this->input->post('estado');
			if($this->Alumno->Editar($data)) {
				$data['rst'] = 1;
				$data['msj'] = 'Alumno actualizado correctamente';
			} else {
				$data['rst'] = 0;
				$data['msj'] = 'Ocurrio un error en la actualización';
			}
			echo json_encode($data);
		}
	}

	public function cambiarestado()
	{
		$estado = $this->input->post('estado');

		$data['estado'] = ($estado == 1)?'0':'1';
		$data['id'] = $this->input->post('id');

		if($this->Alumno->activardesactivar($data)) {
			$data['rst'] = 1;
			$data['msj'] = 'Alumno actualizado correctamente';
		} else {
			$data['rst'] = 0;
			$data['msj'] = 'Ocurrio un error en la actualización';
		}
		echo json_encode($data);
	}

	public function perfil($idAlumno)
	{
		$this->load->model("Evaluacion_model","Evaluacion");

		$data['alumno'] = $this->Alumno->PerfilAlumno($idAlumno);
		$data['historial'] = $this->Evaluacion->Cargar($idAlumno);

		$this->load->view('header_view', $this->header);
		$this->load->view('alumno/perfil_view',$data);
		$this->load->view('footer_view');
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
