<?php
/**
* Tabla Peso Edad
*
* @copyright  2016 SoftGroup Perú
* @version    1.0
* @link       http://softgroup-peru.com/
*/

 class PesoEdad_model extends CI_Model{
	 function __construct(){
        parent::__construct();
  }

/*
num_tabla : determina si se usa la tabla
peso_edad_h , peso_edad_m
*/
  public function Cargar($data){
    $this->db->select('id, edad, meses, DE3menos, DE2menos, DE1menos, Mediana, DE1, DE2, DE3');
    if($data['genero'] == 'h') {
      $this->db->from('peso_edad_h');
    }
    else {
      $this->db->from('peso_edad_m');
    }
    $this->db->where('edad', $data['edad']);
    $this->db->limit(1);
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }


 }
