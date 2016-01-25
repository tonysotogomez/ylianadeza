<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Home extends CI_Controller {

	public function __construct() {
        parent::__construct();
				if($this->session->userdata('logged_in'))
			   {
			     $session_data = $this->session->userdata('logged_in');
			     $this->data['username'] = $session_data['username'];
			   }
			   else
			   {
			     redirect('login', 'refresh');
			   }
         $this->data['title']= "Localhost";
				 $this->data['url']= base_url();
				 $this->load->model("Aula_model","Aula");
				 $this->data['lactantes'] = $this->Aula->CargarMenu(1);
				 $this->data['andantes'] = $this->Aula->CargarMenu(2);
				 $this->data['infantes'] = $this->Aula->CargarMenu(3);
				 $this->data['jardin'] = $this->Aula->CargarMenu(4);
    }

	public function index()
	{
		$this->footer['js_home'] = '<script src="'.base_url().'dist/js/pages/dashboard.js"></script>';
		$this->load->view('header_view', $this->data);
		$this->load->view('home_view');
		$this->load->view('footer_view',$this->footer);
	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home', 'refresh');
	}

}


//END HOME Controller
