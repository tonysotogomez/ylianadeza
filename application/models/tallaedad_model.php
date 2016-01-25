<?php
/**
* Tabla Talla Edad
*
* @copyright  2016 SoftGroup Perú
* @version    1.0
* @link       http://softgroup-peru.com/
*/

 class TallaEdad_model extends CI_Model{
	 function __construct(){
        parent::__construct();
  }

/*
num_tabla : determina si se usa la tabla
talla_edad_h1 , talla_edad_h2
talla_edad_m1 , talla_edad_m2
*/
  public function Cargar($data){
    $this->db->select('id, edad, meses, DE3menos, DE2menos, DE1menos, Mediana, DE1, DE2, DE3');
    if($data['genero'] == 'h') {
      $this->db->from('talla_edad_h'.$data['num_tabla']);
    }
    else {
      $this->db->from('talla_edad_m'.$data['num_tabla']);
    }
    $this->db->where('edad', $data['edad']);
    $this->db->limit(1);
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }


 }
