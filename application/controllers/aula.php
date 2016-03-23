<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aula extends CI_Controller {

	public function __construct() {
        parent::__construct();
         $this->header['title']= "Localhost";
				 $this->header['url']= base_url();
				 $this->load->model("Aula_model","Aula");
				 $this->header['lactantes'] = $this->Aula->CargarMenu(1);
				 $this->header['andantes'] = $this->Aula->CargarMenu(2);
				 $this->header['infantes'] = $this->Aula->CargarMenu(3);
				 $this->header['jardin'] = $this->Aula->CargarMenu(4);
				 $this->footer['js_custom'] = '<script src="'.base_url().'dist/js/alumno.js"></script>';
    }

	public function index($id)
	{
		//$this->data['listado'] = $this->Aula->CargarAlumnos($id);
		$aulas = $this->Aula->CargarAula($id);

		$this->header['tipo'] = $aulas[0]->idTipo;

		$data['datos_aula'] = $aulas;
		$data['id'] = $id;

		$this->load->view('header_view', $this->header);
		$this->load->view('alumno/alumno_view',$data);
		$this->load->view('footer_view', $this->footer);
	}

	public function calcularTotales()
	{
		$idAula = $this->input->post('idAula');
		if(empty($idAula)) $cantidad = $this->Aula->contarallAlumnos();
		else $cantidad = $this->Aula->contarAlumnos($idAula);

		$data['hombres'] = $cantidad[0]->hombres;
		$data['mujeres'] = $cantidad[0]->mujeres;
		$data['totales'] = $cantidad[0]->totales;
		$data['rst'] = 1;
		echo json_encode($data);
	}

	/*Lista todos los alumnos del aula id con estado 1*/
	public function listar()
	{
		$id = $this->input->post('id');
		$data['listado'] = $this->Aula->CargarAlumnos($id);
		$data['rst'] = 1;
		echo json_encode($data);
	}

	public function listar_todos()
	{
		$id = $this->input->post('id');
		$todos = $this->input->post('todos');
		$data['listado'] = $this->Aula->CargarAlumnos_all($id);
		$data['rst'] = 1;
		$data['all'] = ($todos == 0)?1:0;
		echo json_encode($data);
	}

	/*no deberia utilizarse */
	public function listar2()
	{
		$id = $this->input->post('id');
		$data['listado'] = $this->Aula->CargarAlumnos2($id);
		$data['rst'] = 1;
		echo json_encode($data);
	}

 /*Pobla el combobox de aulas*/
	public function listado_select()
	{
		$data['aulas'] = $this->Aula->getAulas();
		echo json_encode($data);
	}

	public function mantenimiento()
	{
		$this->footer2['js_custom'] = '<script src="'.base_url().'dist/js/mantenimiento/aula.js"></script>';
		$this->header['aula_m'] = true; //activa el menu
		$this->load->view('header_view', $this->header);
		$this->load->view('aula/aula_view');
		$this->load->view('footer_view', $this->footer2);
	}

	/*Lista todos las aulas con estado 1 y 0*/
	public function listado()
	{
		$data['listado'] = $this->Aula->CargarAula();
		$data['rst'] = 1;
		echo json_encode($data);
	}

	//MANTENIMIENTO

	public function crear()
	{
		if($this->input->is_ajax_request()){
			$data['nombre'] = $this->input->post('nombre');
			$data['descripcion'] = $this->input->post('descripcion');
			$data['tipo'] = $this->input->post('tipo');
			$data['estado'] = $this->input->post('estado');

			if($this->Aula->Insertar($data)) {
				$data['rst'] = 1;
				$data['msj'] = 'Aula registrada correctamente';
			} else {
				$data['rst'] = 0;
				$data['msj'] = 'Ocurrio un error en el registro';
			}
			echo json_encode($data);
		}
		else echo 'Funcion ajax';
	}

	public function editar()
	{
		if($this->input->is_ajax_request()){
			$data['id'] = $this->input->post('id');
			$data['nombre'] = $this->input->post('nombre');
			$data['descripcion'] = $this->input->post('descripcion');
			$data['tipo'] = $this->input->post('tipo');
			$data['estado'] = $this->input->post('estado');
			if($this->Aula->Editar($data)) {
				$data['rst'] = 1;
				$data['msj'] = 'Aula actualizada correctamente';
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

		if($this->Aula->activardesactivar($data)) {
			$data['rst'] = 1;
			$data['msj'] = 'Aula actualizada correctamente';
		} else {
			$data['rst'] = 0;
			$data['msj'] = 'Ocurrio un error en la actualización';
		}
		echo json_encode($data);
	}

	public function cargar()
	{
		$id = $this->input->post('id');
		$data['aula'] = $this->Aula->CargarAula($id);
		echo json_encode ($data) ;
	}

}


//END Aula Controller
