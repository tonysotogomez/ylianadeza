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
      $this->db->select('id, idAula, nombre, numero, fecha, observacion, completado, estado');
      $this->db->from('evaluacion');
      $this->db->where('idAula', $idAula);
      $this->db->where('estado', 1);
      $this->db->order_by('fecha', 'asc');
      $consulta = $this->db->get();
      $resultado = $consulta->result();
      return $resultado;
    }

    //carga la evaluacion por id
    public function CargarEvaluacion($idEvaluacion){
      $query = $this->db->query('SELECT e.nombre, e.numero, e.fecha, a.nombre as aula, count(d.id) as alumnos, e.completado
                                FROM detalle_evaluacion d
                                JOIN evaluacion e ON e.id = d.idEvaluacion
                                JOIN aula a ON a.id = e.idAula
                                WHERE e.id= '.$idEvaluacion.'
                                AND e.estado = 1');
      $resultado = $query->result();
      return $resultado;
    }



    public function Crear($data){
      $arr = array(
                 'idAula' => $data['idAula'],
                 'nombre' => $data['nombre'],
                 'numero' => $data['numero'],
                 'fecha' => date("Y-m-d H:i:s")
              );
      $this->db->insert('evaluacion', $arr);
    }

    public function CargarID($id){
      $this->db->select('id, idAula, nombre, fecha, observacion, estado');
      $this->db->from('evaluacion');
      $this->db->where('id', $id);
      $this->db->where('estado', 1);
      $this->db->limit(1);
      $consulta = $this->db->get();
      $resultado = $consulta->result();
      return $resultado;
    }

    public function Editar($data){
      $arr = array(
                 'nombre' => $data['nombre'],
                 'numero' => $data['numero'],
                 'completado' => $data['completado']
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
                 'idAula' => $data['idAula'],
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
        'idAula' => $data['idAula'],//NO ES NECESARIO PERO POR MIENTRAS HASTA FORMATEAR LA DATA
                 'edad' => $data['edad'],// se edita fecha manualmente, casos especiales
                 'peso' => $data['peso'],
                 'talla' => $data['talla'],
                 'gpeso' => $data['gpeso'],
                 'gtalla' => $data['gtalla'],
                 'diagnosticoTE' => $data['talla_edad'],
                 'diagnosticoPE' => $data['peso_edad'],
                 'diagnosticoPT' => $data['peso_talla'],
                 'idDiagnostico' => $data['final'],
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
      $this->db->select('d.id, e.fecha, e.nombre as evaluacion, e.numero, d.idEvaluacion, d.idAlumno, a.nombres, a.apellidos, d.edad, a.genero, d.peso, d.talla, d.fecha, d.observaciones, d.estado, d.diagnosticoTE, d.diagnosticoPE, d.diagnosticoPT, d.idDiagnostico');
      $this->db->from('detalle_evaluacion d');
      $this->db->join('alumno a', 'a.id = d.idAlumno');
      $this->db->join('evaluacion e', 'e.id = d.idEvaluacion');
      $this->db->where('idEvaluacion', $idEvaluacion);
      $this->db->where('d.estado', 1);
      $this->db->where('a.estado', 1);
      $this->db->order_by('a.apellidos', 'asc');
    //  $this->db->order_by('fecha', 'desc');
      $consulta = $this->db->get();
      $resultado = $consulta->result();
      return $resultado;
    }
/*
    public function VerDetalle($idEvaluacion, $idEvalAnt){
      $query = $this->db->query('SELECT
                                d.id,
                                e.fecha as fecha_e,
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
                                di.nombre as idDiagnostico
                              FROM
                                (detalle_evaluacion d)
                              JOIN alumno a ON a.id = d.idAlumno
                              JOIN evaluacion e ON e.id = d.idEvaluacion
                              LEFT JOIN diagnostico di ON di.id = d.idDiagnostico
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
    }*/

    public function VerDetalle($idEvaluacion){
      $query = $this->db->query('SELECT
                                d.id,
                                e.fecha as fecha_e,
                                e.nombre AS evaluacion,
                                d.idEvaluacion,
                                d.idAlumno,
                                a.nombres,
                                a.apellidos,
                                d.edad,
                                a.genero,
                                d.peso,
                                d.gpeso,
                                d.talla,
                                d.gtalla,
                                d.fecha,
                                d.observaciones,
                                d.estado,
                                d.diagnosticoTE,
                                d.diagnosticoPE,
                                d.diagnosticoPT,
                                di.nombre as idDiagnostico
                              FROM
                                (detalle_evaluacion d)
                              JOIN alumno a ON a.id = d.idAlumno
                              JOIN evaluacion e ON e.id = d.idEvaluacion
                              LEFT JOIN diagnostico di ON di.id = d.idDiagnostico
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
                                  d.gpeso,
                                	d.talla,
                                  d.gtalla,
                                	d.observaciones,
                                	d.diagnosticoTE,
                                	d.diagnosticoPE,
                                	d.diagnosticoPT,
                                	di.nombre as idDiagnostico
                                FROM
                                	(detalle_evaluacion d)
                                JOIN alumno a ON a.id = d.idAlumno
                                JOIN evaluacion e ON e.id = d.idEvaluacion
                                LEFT JOIN diagnostico di ON di.id = d.idDiagnostico
                                WHERE 1 = 1
                                $and
                                AND d.estado = 1
                                ORDER BY
                                	a.apellidos ASC");
      $resultado = $query->result();
      return $resultado;
    }

    public function count_diagnostico($idAula, $idEvaluacion){
      $query = $this->db->query('SELECT e.nombre as evaluacion, a.nombre as aula,
      (SELECT count(*) FROM detalle_evaluacion where idDiagnostico = 1 and idAula = '.$idAula.' and idEvaluacion = '.$idEvaluacion.') as normales,
      (SELECT count(*) FROM detalle_evaluacion where idDiagnostico = 2 and idAula = '.$idAula.' and idEvaluacion = '.$idEvaluacion.') as obesos,
      (SELECT count(*) FROM detalle_evaluacion where idDiagnostico = 3 and idAula = '.$idAula.' and idEvaluacion = '.$idEvaluacion.') as sobrepesos,
      (SELECT count(*) FROM detalle_evaluacion where idDiagnostico = 4 and idAula = '.$idAula.' and idEvaluacion = '.$idEvaluacion.') as agudas,
      (SELECT count(*) FROM detalle_evaluacion where idDiagnostico = 5 and idAula = '.$idAula.' and idEvaluacion = '.$idEvaluacion.') as severos,
      (SELECT count(*) FROM detalle_evaluacion where idDiagnostico = 6 and idAula = '.$idAula.' and idEvaluacion = '.$idEvaluacion.') as cronicos,
      (SELECT count(*) FROM detalle_evaluacion where idAula = '.$idAula.' and idEvaluacion = '.$idEvaluacion.') as totales
      FROM detalle_evaluacion d
      JOIN evaluacion e ON e.id = d.idEvaluacion
      JOIN alumno al ON al.id = d.idAlumno
      JOIN aula a ON a.id = al.idAula
      WHERE a.id = '.$idAula.'
      AND e.id = '.$idEvaluacion.'
      GROUP BY e.id');
      $resultado = $query->result();
      return $resultado;
    }
    //cantidad de alumnos por evaluacion y aula
    public function count_totales($idAula, $idEvaluacion){
      $query = $this->db->query('  SELECT e.nombre as evaluacion, a.nombre as aula,
          (SELECT count(*) FROM detalle_evaluacion d
    			JOIN alumno al ON al.id = d.idAlumno
    			where idEvaluacion = '.$idEvaluacion.' and al.genero = "m") as mujeres,
    			(SELECT count(*) FROM detalle_evaluacion d
          JOIN alumno al ON al.id = d.idAlumno
          where idEvaluacion = '.$idEvaluacion.' and al.genero = "h") as hombres,
          (SELECT count(*) FROM detalle_evaluacion d
          JOIN alumno al ON al.id = d.idAlumno
          where idEvaluacion = '.$idEvaluacion.') as totales
          FROM detalle_evaluacion d
          JOIN evaluacion e ON e.id = d.idEvaluacion
          JOIN alumno al ON al.id = d.idAlumno
          JOIN aula a ON a.id = al.idAula
          WHERE a.id = '.$idAula.'
          AND e.id = '.$idEvaluacion.'
          GROUP BY e.id');
      $resultado = $query->result();
      return $resultado;
    }

    public function totales(){
      $query = $this->db->query("SELECT (SELECT count(id) from alumno where estado = 1 and genero='h') as hombres,
          (SELECT count(id) from alumno where estado = 1 and genero='m') as mujeres, count(id)  as totales
          FROM alumno
          where estado = 1");
      $resultado = $query->result();
      return $resultado;
    }

    public function countEvaluacion($idAula, $completado){
      $this->db->from('evaluacion')->where('idAula', $idAula)->where('estado', 1)->where('completado', $completado);
      return $this->db->count_all_results();
    }


    //carga el detalle de evaluacion de un alumno
    public function CargarDetalleID($idEvaluacion, $idAlumno){
      $this->db->select('d.id, e.fecha, e.nombre as evaluacion, e.numero, d.idEvaluacion, d.idAlumno, d.idAlumno as idAlumno, a.nombres, a.apellidos, d.edad, a.genero, d.peso, d.talla, d.fecha, d.observaciones, d.estado, d.diagnosticoTE, d.diagnosticoPE, d.diagnosticoPT, d.idDiagnostico');
      $this->db->from('detalle_evaluacion d');
      $this->db->join('alumno a', 'a.id = d.idAlumno');
      $this->db->join('evaluacion e', 'e.id = d.idEvaluacion');
      $this->db->where('d.idEvaluacion', $idEvaluacion);
      $this->db->where('d.idAlumno', $idAlumno);
      $this->db->where('d.estado', 1);
      $this->db->order_by('a.apellidos', 'asc');
    //  $this->db->order_by('fecha', 'desc');
      $consulta = $this->db->get();
      $resultado = $consulta->result();
      return $resultado;
    }
    //obtengo numero de evaluaciones, completado y totales
    public function getNumeroEvaluaciones(){
      $query = $this->db->query("SELECT e.numero, DATE_FORMAT(MAX(e.fecha),'%d %b %Y - %h:%i %p') as fecha,count(e.id) as cantidad, (select count(*) from aula where estado=1) as total
        FROM `evaluacion` e
        JOIN aula a ON a.id = e.idAula
        WHERE e.estado = 1
        AND a.estado = 1
        GROUP BY numero");
      $resultado = $query->result();
      return $resultado;
    }

    //obtengo el nombre de aula, evaluacion, fecha, diagnostico, cantidad
    public function reporteEvaluacionAula($idEvaluacion){
      $query = $this->db->query("SELECT a.nombre as aula, e.nombre as evaluacion,
          date(e.fecha), d.nombre as diagnostico,count(de.idDiagnostico) as total
          FROM `detalle_evaluacion` de
          JOIN diagnostico d ON d.id = de.idDiagnostico
          JOIN evaluacion e ON e.id = de.idEvaluacion
          JOIN aula a ON a.id = de.idAula
          WHERE de.estado = 1
          AND de.idEvaluacion = $idEvaluacion
          GROUP BY de.idDiagnostico");
      $resultado = $query->result();
      return $resultado;
    }

    //cuenta el numero total de evaluaciones de todas las aulas
    public function countEvaluaciones(){
      $this->db->select('count(*) as totales');
      $this->db->select('(SELECT count(id) FROM evaluacion WHERE completado = 1 and estado=1) as completo');
      $this->db->select('(SELECT count(id) FROM evaluacion WHERE completado = 0 AND estado=1) as incompleto');
      $this->db->from('evaluacion');
      $this->db->where('estado', 1);
      $consulta = $this->db->get();
      $resultado = $consulta->result();
      return $resultado;
    }

    //obtengo las evaluaciones  N°X de todas las aulas
    public function getEvaluacioNumero($num,$completado = null){
      $this->db->select('e.id, e.idAula');
      $this->db->from('evaluacion e');
      $this->db->join('aula a', 'a.id = e.idAula');
      $this->db->where('e.estado', 1);
      $this->db->where('e.numero', $num);
      if(isset($completado)) $this->db->where('e.completado', $completado);
      $this->db->order_by('a.idTipo', 'asc');
      $consulta = $this->db->get();
      $resultado = $consulta->result();
      return $resultado;
    }
 }
