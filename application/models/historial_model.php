<?php
/**
* HISTORIAL
*
* @copyright  2015 SoftGroup Perú
* @version    1.0
* @link       http://softgroup-peru.com/
*/

 class Historial_model extends CI_Model{
	 function __construct(){
        parent::__construct();
  }

  public function Cargar($idAlumno){
    $this->db->select('id, idEdad, idTalla, idPeso, fecha, observaciones, diagnosticoTE, diagnosticoPE, diagnosticoPT');
    $this->db->from('historial');
    $this->db->where('idAlumno', $idAlumno);
    $this->db->order_by('id', 'asc');
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
	}

  public function Guardar($data){
    $arr = array(
               'idAlumno' => $data['idAlumno'],
               'idEdad' => $data['idEdad'],
               'idTalla' => $data['idTalla'],
               'idPeso' => $data['idPeso'],
               'fecha' => $data['fecha'],
               'observaciones' => $data['observaciones'],
            );
    $this->db->insert('historial', $arr);
  }

 }
