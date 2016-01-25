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

  public function CargarAlumnos($idAula){
    $this->db->select('id, nro, nombres, apellidos, fecha_nacimiento, genero, titular, estado');
    $this->db->from('alumno');
    $this->db->where('idAula', $idAula);
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
