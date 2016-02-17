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
    $this->db->select('id, nombre, idTipo');
    $this->db->from('aula');
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

  public function CargarMenu($idTipo){
    $this->db->select('id, nombre');
    $this->db->from('aula');
    if($idTipo != 0) { $this->db->where('idTipo', $idTipo); }
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
	}

  public function contarAlumnos($genero, $aula){
    $this->db->select('count(genero) as num');
    $this->db->from('alumno');
    $this->db->where('estado != 3');
    $this->db->where('estado != 0');
    $this->db->where('idAula', $aula);
    if($genero != 'all'){ $this->db->where('genero', $genero); }
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

  public function CargarAlumnos($idAula){
    $this->db->select('id, nombres, apellidos, fecha_nacimiento, genero, titular, estado');
    $this->db->from('alumno');
    $this->db->where('idAula', $idAula);
    $this->db->where('estado != 3'); //estado 3 es eliminado
    $this->db->order_by('apellidos', 'asc');
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

//para EVALUACIONES
  public function CargarAlumnos2($idAula){
    $this->db->select('id, nombres, apellidos, fecha_nacimiento, genero, titular, estado');
    $this->db->from('alumno');
    $this->db->where('idAula', $idAula);
    $this->db->where('estado != 3'); //estado 3 es eliminado
    $this->db->where('estado != 0'); //estado 0 es desactivado
    $this->db->order_by('apellidos', 'asc');
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }


  public function CargarAula($idAula){
    $this->db->select('aula.id, aula.nombre as titulo, tipo.nombre as aula, aula.observacion as edades');
    $this->db->from('aula');
    $this->db->join('tipo', 'aula.idTipo = tipo.id');
    $this->db->where('aula.id', $idAula);
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

 }
