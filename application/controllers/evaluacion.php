<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluacion extends CI_Controller {

	public function __construct() {
        parent::__construct();
         $this->header['title']= "Evaluaciones";
				 $this->header['url']= base_url();
				 $this->load->model("Alumno_model","Alumno");
				 $this->load->model("Aula_model","Aula");
				 $this->load->model("Evaluacion_model","Evaluacion");
				 $this->header['lactantes'] = $this->Aula->CargarMenu(1);
				 $this->header['andantes'] = $this->Aula->CargarMenu(2);
				 $this->header['infantes'] = $this->Aula->CargarMenu(3);
				 $this->header['jardin'] = $this->Aula->CargarMenu(4);
				 $this->footer['js_custom'] = '<script src="'.base_url().'dist/js/mantenimiento/evaluacion.js"></script>';
				 $this->load->helper(array('form'));
    }

	public function index()
	{
		$this->load->view('header_view', $this->header);
		$this->load->view('evaluacion/evaluacion_view');
		$this->load->view('footer_view', $this->footer);
	}

	public function listar()
	{
		if($this->input->is_ajax_request()){
			$data['listado'] = $this->Evaluacion->getNumeroEvaluaciones();
			$data['rst'] = 1;
			echo json_encode($data);
		}
		else echo 'Funcion ajax';
	}

}


//END Evaluacion Controller
