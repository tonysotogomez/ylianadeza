<?php
/**
* AULAS
*
* @copyright  2015 SoftGroup Perú
* @version    1.0
* @link       http://softgroup-peru.com/
*/

 class Aula_model extends CI_Model{
	 function __construct(){
        parent::__construct();
  }

  public function getAulas(){
    $this->db->select('id, nombre, idTipo, Observacion');
    $this->db->from('aula');
    $this->db->where('estado',1);
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

  public function CargarMenu($idTipo){
    $this->db->select('id, nombre');
    $this->db->from('aula');
    if($idTipo != 0) { $this->db->where('idTipo', $idTipo); }
    $this->db->where('estado', 1);
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
	}

  public function contarAlumnos2($genero, $aula = null){
    $this->db->select('count(genero) as num');
    $this->db->from('alumno');
    $this->db->where('estado != 3');
    $this->db->where('estado != 0');
    if($aula) { $this->db->where('idAula', $aula); }
    if($genero != 'all'){ $this->db->where('genero', $genero); }
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

  public function contarAlumnos($idAula){
    $query = $this->db->query('SELECT
                      (SELECT count(id) FROM alumno WHERE idAula ='.$idAula.' and estado = 1 and genero="h") as hombres,
                      (SELECT count(id) FROM alumno WHERE idAula ='.$idAula.' and estado = 1 and genero="m") as mujeres,
                      (SELECT count(id) FROM alumno WHERE idAula ='.$idAula.' and estado = 1) as totales
                      FROM aula
                      WHERE id = '.$idAula);
    $resultado = $query->result();
    return $resultado;
  }

  public function contarallAlumnos(){
    $query = $this->db->query('SELECT
                      (SELECT count(id) FROM alumno WHERE estado = 1 and genero="h") as hombres,
                      (SELECT count(id) FROM alumno WHERE estado = 1 and genero="m") as mujeres,
                      (SELECT count(id) FROM alumno WHERE estado = 1) as totales
                      FROM aula');
    $resultado = $query->result();
    return $resultado;
  }

  public function CargarAlumnos($idAula = null){
    $this->db->select('a.id, nombres, apellidos, fecha_nacimiento, genero, dni, titular, a.estado, aula.nombre as aula');
    $this->db->from('alumno a');
    $this->db->join('aula', 'a.idAula = aula.id');
    if($idAula) { $this->db->where('idAula', $idAula); }
    $this->db->where('a.estado != 2'); //estado 2 es eliminado
    $this->db->where('a.estado != 0');
    $this->db->order_by('apellidos', 'asc');
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

  public function CargarAlumnos_all($idAula = null){
    $this->db->select('a.id, nombres, apellidos, fecha_nacimiento, genero, dni, titular, a.estado, aula.nombre as aula');
    $this->db->from('alumno a');
    $this->db->join('aula', 'a.idAula = aula.id');
    $this->db->where('a.estado != 2'); //estado 2 es eliminado
    if($idAula) { $this->db->where('idAula', $idAula); }
    $this->db->order_by('apellidos', 'asc');
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

//pno debe utilizarse
  public function CargarAlumnos2($idAula){
    $this->db->select('id, nombres, apellidos, fecha_nacimiento, genero, titular, estado');
    $this->db->from('alumno');
    $this->db->where('idAula', $idAula);
    $this->db->where('estado != 2'); //estado 2 es eliminado
    $this->db->where('estado != 0'); //estado 0 es desactivado
    $this->db->order_by('apellidos', 'asc');
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }


  public function CargarAula($idAula = null){
    $this->db->select('aula.id, aula.nombre as titulo, aula.idTipo, tipo.nombre as aula, aula.observacion as edades, aula.estado');
    $this->db->from('aula');
    $this->db->join('tipo', 'aula.idTipo = tipo.id');
    if($idAula) { $this->db->where('aula.id', $idAula); }
    $this->db->where('aula.estado',1); //estado 0 es desactivado
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

  //MANTENIMIENTO
  public function Insertar($data){
    $arr = array(
               'nombre' => $data['nombre'],
               'idTipo' => $data['tipo'],
               'Observacion' => $data['descripcion'],
               'estado' => $data['estado']
            );
   if ($this->db->insert('aula', $arr)) return true;
   else return false;
  }

  public function Editar($data){
    $arr = array(
               'nombre' => $data['nombre'],
               'idTipo' => $data['tipo'],
               'Observacion' => $data['descripcion'],
               'estado' => $data['estado']
            );
    $this->db->where('id', $data['id']);
    if ($this->db->update('aula', $arr)) return true;
    else return false;
  }

  public function activardesactivar($data){
    $arr = array(
          'estado' => $data['estado']
         );
    $this->db->where('id', $data['id']);
    if($this->db->update('aula', $arr)) return true;
    else return false;
  }
 }
