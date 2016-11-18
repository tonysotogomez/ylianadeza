<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {

	public function __construct() {
        parent::__construct();
         $this->header['title']= "Localhost";
				 $this->header['url']= base_url();
				 $this->load->model("Aula_model","Aula");
				 $this->header['lactantes'] = $this->Aula->CargarMenu(1);
				 $this->header['andantes'] = $this->Aula->CargarMenu(2);
				 $this->header['infantes'] = $this->Aula->CargarMenu(3);
				 $this->header['jardin'] = $this->Aula->CargarMenu(4);
				 $this->load->helper(array('form'));

				 $this->footer['js_custom'] = '<script src="'.base_url().'dist/js/examen/cred.js"></script>';
	//		$this->footer['js_custom'] = '';
				 $this->load->helper(array('curva'));
				 $data['home'] = strtolower(__CLASS__).'/';
 			 	 $this->load->vars($data);
    }



	public function cred()
	{
		$this->load->view('header_view', $this->header);
		// $data = '[2.3, 3.1, 4.2, 5.2, 6.5, 7.5, 8.3, 9.3, 10.4, 11.7, 12.9, 14]';
		//
		// $this->footer['js_custom'] .= script_curva( $data);

		$this->load->view('reporte/cred_prueba_view');
		$this->load->view('footer_view',$this->footer);
	}
	function index()
	{
		// simple highcharts example
		$this->load->library('highcharts');

		// some data series
		$serie['data'] = array(20, 45, 60, 22, 6, 36);

		$data['charts'] = $this->highcharts->set_serie($serie)->render();

		$this->load->view('reporte/prueba_view', $data);

	}

	function pie()
		{
			$this->load->library('highcharts');
			$serie['data']	= array(
				array('value one', 20),
				array('value two', 45),
				array('other value', 60)
			);
			$callback = "function() { return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}";

			@$tool->formatter = $callback;
			@$plot->pie->dataLabels->formatter = $callback;

			$this->highcharts
				->set_type('pie')
				->set_serie($serie)
				->set_tooltip($tool)
				->set_plotOptions($plot);

			$data['charts'] = $this->highcharts->render();
			$this->load->view('reporte/prueba_view', $data);
		}

}


//END Reporte Controller
