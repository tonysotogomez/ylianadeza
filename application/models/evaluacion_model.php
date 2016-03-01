<?php
date_default_timezone_set('America/Lima');
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
    $this->db->select('id, idEvaluacion, idAlumno, edad, peso, talla, fecha, observaciones, diagnosticoTE, diagnosticoPE, diagnosticoPT, observaciones');
    $this->db->from('detalle_evaluacion');
    $this->db->where('estado', 1);
    $this->db->where('idAlumno', $idAlumno);
    $this->db->order_by('fecha', 'desc');
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
	}

  //de la mas antigua a la mas actual
    public function CargarEvaluaciones($idAula){
      $this->db->select('id, idAula, nombre, fecha, observacion, estado');
      $this->db->from('evaluacion');
      $this->db->where('idAula', $idAula);
      $this->db->where('estado', 1);
      $this->db->order_by('fecha', 'asc');
      $consulta = $this->db->get();
      $resultado = $consulta->result();
      return $resultado;
    }


    public function Crear($data){
      $arr = array(
                 'idAula' => $data['idAula'],
                 'nombre' => $data['nombre'],
                 'fecha' => date("Y-m-d H:i:s")
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

    public function Eliminar($id){
      $arr = array(
                 'estado' => 0
              );
      $this->db->where('id', $id);
      $this->db->update('evaluacion', $arr);
    }

    //tabla  DETALLE_EVALUACION
    public function InsertarDetalle($data){
      $arr = array(
                 'idEvaluacion' => $data['idEvaluacion'],
                 'idAlumno' => $data['idAlumno'],
                 'edad' => $data['edad'],
                 'peso' => $data['peso'],
                 'talla' => $data['talla'],
                 'fecha' => $data['fecha'],
                 'diagnosticoTE' => $data['talla_edad'],
                 'diagnosticoPE' => $data['peso_edad'],
                 'diagnosticoPT' => $data['peso_talla'],
                 'created_at' => date("Y-m-d H:i:s"),
                 //'observaciones' => $data['obs'] //queries
                 'observaciones' => $data['observaciones']
              );
      if ($this->db->insert('detalle_evaluacion', $arr)) return true;
      else return false;
    }

    public function EditarDetalle($data){
      $arr = array(
                 'edad' => $data['edad'],// se edita fecha manualmente, casos especiales
                 'peso' => $data['peso'],
                 'talla' => $data['talla'],
                 'diagnosticoTE' => $data['talla_edad'],
                 'diagnosticoPE' => $data['peso_edad'],
                 'diagnosticoPT' => $data['peso_talla'],
                 'diagnosticoF' => $data['final'],
                 'updated_at' => date("Y-m-d H:i:s"),
                 'observaciones' => $data['observaciones']
              );
      $this->db->where('id', $data['idDetalle']);
      if ($this->db->update('detalle_evaluacion', $arr)) return true;
      else return false;
    }

    public function EliminarDetalle($id){
      $arr = array(
                 'estado' => 0
              );
      $this->db->where('id', $id);
      if ($this->db->update('detalle_evaluacion', $arr)) return true;
      else return false;
    }

    public function CargarDetalle($idEvaluacion){
      $this->db->select('d.id, e.fecha, e.nombre as evaluacion, d.idEvaluacion, d.idAlumno, a.nombres, a.apellidos, d.edad, a.genero, d.peso, d.talla, d.fecha, d.observaciones, d.estado, d.diagnosticoTE, d.diagnosticoPE, d.diagnosticoPT, d.diagnosticoF');
      $this->db->from('detalle_evaluacion d');
      $this->db->join('alumno a', 'a.id = d.idAlumno');
      $this->db->join('evaluacion e', 'e.id = d.idEvaluacion');
      $this->db->where('idEvaluacion', $idEvaluacion);
      $this->db->where('d.estado', 1);
      $this->db->order_by('a.apellidos', 'asc');
    //  $this->db->order_by('fecha', 'desc');
      $consulta = $this->db->get();
      $resultado = $consulta->result();
      return $resultado;
    }

    public function VerDetalle($idEvaluacion, $idEvalAnt){
      $query = $this->db->query('SELECT
                                d.id,
                                e.fecha,
                                e.nombre AS evaluacion,
                                d.idEvaluacion,
                                d.idAlumno,
                                a.nombres,
                                a.apellidos,
                                d.edad,
                                a.genero,
                                 ant.peso as peso_ant,
                                d.peso,
                                 ant.talla as talla_ant,
                                d.talla,
                                d.fecha,
                                d.observaciones,
                                d.estado,
                                d.diagnosticoTE,
                                d.diagnosticoPE,
                                d.diagnosticoPT,
                                d.diagnosticoF
                              FROM
                                (detalle_evaluacion d)
                              JOIN alumno a ON a.id = d.idAlumno
                              JOIN evaluacion e ON e.id = d.idEvaluacion
                              LEFT JOIN (
                                  SELECT d2.idAlumno as evalu, d2.talla, d2.peso
                                  FROM detalle_evaluacion d2
                                  where d2.idEvaluacion = '.$idEvalAnt.'
                                  and d2.estado != 2) ant ON ant.evalu = d.idAlumno
                              WHERE
                                idEvaluacion = '.$idEvaluacion.'
                              AND d.estado != 2
                            ORDER BY a.apellidos asc');
      $resultado = $query->result();
      return $resultado;
    }


    public function VerDetalle2($idAlumno = null){
      $and = ($idAlumno)?'AND a.id='.$idAlumno:'';
      $query = $this->db->query("SELECT
                                	d.id as idDetalle,
                                	date(e.fecha) as fecha,
                                	e.nombre AS evaluacion,
                                	d.idEvaluacion,
                                	d.idAlumno,
                                	CONCAT(a.apellidos,', ',a.nombres) as alumno,
                                	d.edad,
                                	a.genero,
                                	d.peso,
                                	d.talla,
                                	d.observaciones,
                                	d.diagnosticoTE,
                                	d.diagnosticoPE,
                                	d.diagnosticoPT,
                                	d.diagnosticoF
                                FROM
                                	(detalle_evaluacion d)
                                JOIN alumno a ON a.id = d.idAlumno
                                JOIN evaluacion e ON e.id = d.idEvaluacion
                                $and
                                AND d.estado = 1
                                ORDER BY
                                	a.apellidos ASC");
      $resultado = $query->result();
      return $resultado;
    }

 }
