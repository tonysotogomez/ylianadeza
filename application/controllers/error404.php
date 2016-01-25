<?php
class Error404 extends CI_Controller {

	 public function __construct(){
          parent::__construct();
				 $this->header['title']= "Localhost";
 				 $this->header['url']= base_url();
 				 $this->load->model("Alumno_model","Alumno");
 				 $this->load->model("Aula_model","Aula");
 				 $this->header['lactantes'] = $this->Aula->CargarMenu(1);
 				 $this->header['andantes'] = $this->Aula->CargarMenu(2);
 				 $this->header['infantes'] = $this->Aula->CargarMenu(3);
 				 $this->header['jardin'] = $this->Aula->CargarMenu(4);

    }

	 public function index(){
		 $this->load->view('header_view', $this->header);
		 $this->load->view("error404_view");
		 $this->load->view('footer_view');
	 }

}
//END ERROR404 CONTROLLER
