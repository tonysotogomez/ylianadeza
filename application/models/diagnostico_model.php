<?php
/**
* Tabla DIagnosticos
*
* @copyright  2016 SoftGroup Perú
* @version    1.0
* @link       http://softgroup-peru.com/
*/

 class Diagnostico_model extends CI_Model{
	 function __construct(){
        parent::__construct();
  }


  public function Listar(){
    $this->db->select('*');
    $this->db->from('diagnostico');
    $this->db->where('estado', 1);
    $this->db->limit(10);
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }


 }
