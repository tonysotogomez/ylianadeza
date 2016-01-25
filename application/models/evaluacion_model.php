<?php
/**
* EVALUACION
*
* @copyright  2016 SoftGroup Perú
* @version    1.0
* @link       http://softgroup-peru.com/
*/

 class Evaluacion_model extends CI_Model{
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


    public function CargarEvaluaciones($idAula){
      $this->db->select('id, idAula, nombre, fecha, observacion, estado');
      $this->db->from('evaluacion');
      $this->db->where('idAula', $idAula);
      $this->db->order_by('fecha', 'desc');
      $consulta = $this->db->get();
      $resultado = $consulta->result();
      return $resultado;
    }

    public function Crear($data){
      $arr = array(
                 'idAula' => $data['idAula'],
                 'nombre' => $data['nombre'],
                 'fecha' => $data['fecha']
              );
      $this->db->insert('evaluacion', $arr);
    }


    public function InsertarDetalle($data){
      $arr = array(
                 'idEvaluacion' => $data['idEvaluacion'],
                 'idAlumno' => $data['idAlumno'],
                 'edad' => $data['edad'],
                 'peso' => $data['peso'],
                 'talla' => $data['talla'],
                 'fecha' => $data['fecha'],
                 'observaciones' => $data['observaciones']
              );
      ;
      if ($this->db->insert('detalle_evaluacion', $arr)) return true;
      else return false;
    }



 }
