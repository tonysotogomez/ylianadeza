<?php
/**
* EDADES
*
* @copyright  2016 SoftGroup Perú
* @version    1.0
* @link       http://softgroup-peru.com/
*/

 class Edad_model extends CI_Model{
	 function __construct(){
        parent::__construct();
  }


  public function CargarEdad($edad){
    $this->db->select('nombre, meses');
    $this->db->from('edad');
    $this->db->where('cantidad', $edad);
    $this->db->limit(1);
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }



 }
