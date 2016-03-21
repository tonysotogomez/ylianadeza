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

	public function ver($num)
	{
		$evaluaciones = $this->Evaluacion->getEvaluacioNumero($num,1);//completadas
		$evaluaciones2= $this->Evaluacion->getEvaluacioNumero($num,0);//imcompletadas
		$evaluaciones_all = $this->Evaluacion->getEvaluacioNumero($num);//todas

		//CALCULO DE AULAS FALTANTES
		$aulas = $this->Aula->getAulas();
		for ($a=0, $len1 = count($aulas); $a < $len1; $a++) {
			$array1[$a] = $aulas[$a]->id;
		}
		for ($b=0, $len2 = count($evaluaciones_all); $b < $len2; $b++) {
			$array2[$b] = $aulas[$b]->id;
		}
		$faltantes_id = array_diff($array1, $array2);

/*
		$start = $len1-$len2;
		for ($c=$start, $len3 = count($faltantes_id); $c <= $len3; $c++) {
			$datos = $this->Aula->CargarAula($faltantes_id[$c]->id);
		}*/
		$conn = 1;
		foreach ($faltantes_id as $v) {
			$faltantes[$conn] = $this->Aula->CargarAula($v);
			$conn++;
		}

		for ($i=0, $len = count($evaluaciones); $i < $len; $i++) {
			$total_evaluaciones[$i] = $this->Evaluacion->count_diagnostico($evaluaciones[$i]->idAula, $evaluaciones[$i]->id);
		}
		for ($i=0, $len = count($evaluaciones2); $i < $len; $i++) {
			$total_evaluaciones2[$i] = $this->Evaluacion->count_diagnostico($evaluaciones2[$i]->idAula, $evaluaciones2[$i]->id);
		}
		for ($i=0, $len = count($evaluaciones_all); $i < $len; $i++) {
			$total_evaluaciones_all[$i] = $this->Evaluacion->count_diagnostico($evaluaciones_all[$i]->idAula, $evaluaciones_all[$i]->id);
		}
		$data['reporte'] = $total_evaluaciones;
		$data['reporte2'] = $total_evaluaciones2;
		$data['aulas'] = $total_evaluaciones_all;
		$data['reporte3'] = $faltantes;

		$data['num'] =	$num;

		$this->load->view('header_view', $this->header);
		$this->load->view('evaluacion/detalle_view', $data);
		$this->load->view('footer_view', $this->footer);

	}

}


//END Evaluacion Controller
