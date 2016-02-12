<?php
/**
* Tabla Peso Talla
*
* @copyright  2016 SoftGroup Perú
* @version    1.0
* @link       http://softgroup-peru.com/
*/

 class PesoTalla_model extends CI_Model{
	 function __construct(){
        parent::__construct();
  }

/*
num_tabla : determina si se usa la tabla
peso_talla_h1 , peso_talla_h2
peso_talla_m1 , peso_talla_m2
*/
  //talla2 esta corregida en los decimales diferentes de .0 o .5

  public function Cargar($data){
    $this->db->select('id, cm, DE3menos, DE2menos, DE1menos, Mediana, DE1, DE2, DE3');
    if($data['genero'] == 'h') {
      $this->db->from('peso_talla_h'.$data['num_tabla']);
    }
    else {
      $this->db->from('peso_talla_m'.$data['num_tabla']);
    }
    $this->db->where('cm', $data['talla2']);
    $this->db->limit(1);
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }


 }
