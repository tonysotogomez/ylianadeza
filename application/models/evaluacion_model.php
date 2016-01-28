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

    public function CargarDetalle($idEvaluacion){
      $this->db->select('d.id, e.fecha, e.nombre as evaluacion, d.idEvaluacion, d.idAlumno, a.nombres, a.apellidos, d.edad, d.peso, d.talla, d.fecha, d.observaciones, d.estado');
      $this->db->from('detalle_evaluacion d');
      $this->db->join('alumno a', 'a.id = d.idAlumno');
      $this->db->join('evaluacion e', 'e.id = d.idEvaluacion');
      $this->db->where('idEvaluacion', $idEvaluacion);
    //  $this->db->order_by('fecha', 'desc');
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

    public function Editar($data){
      $arr = array(
                 'nombre' => $data['nombre']
              );
      $this->db->where('id', $data['id']);
      $this->db->update('evaluacion', $arr);
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
      if ($this->db->insert('detalle_evaluacion', $arr)) return true;
      else return false;
    }

    public function EditarDetalle($data){
      $arr = array(
                // 'edad' => $data['edad'], edad no se debe actualizar
                 'peso' => $data['peso'],
                 'talla' => $data['talla'],
                 //'fecha' => $data['fecha'],
                 'observaciones' => $data['observaciones']
              );
      $this->db->where('id', $data['idDetalle']);
      if ($this->db->update('detalle_evaluacion', $arr)) return true;
      else return false;
    }


 }
