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
		$this->data['datos_aula'] = $this->Aula->CargarAula($id);
		$this->data['active'] = '';
		$this->data['id'] = $id;
		$this->load->view('header_view', $this->header);
		$this->load->view('alumno/alumno_view',$this->data);
		$this->load->view('footer_view', $this->footer);
	}

	/*Lista todos los alumnos del aula id*/
	public function listar()
	{
		$id = $this->input->post('id');
		$data['listado'] = $this->Aula->CargarAlumnos($id);
		$data['rst'] = 1;
		echo json_encode($data);
	}

 /*Pobla el combobox de aulas*/
	public function listado_select()
	{
		$data['aulas'] = $this->Aula->getAulas();
		echo json_encode($data);
	}

}


//END Aula Controller
