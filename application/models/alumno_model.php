<?php
/**
* ALUMNOS
*
* @copyright  2015 SoftGroup Perú
* @version    1.0
* @link       http://softgroup-peru.com/
*/

 class Alumno_model extends CI_Model{
	 function __construct(){
        parent::__construct();
  }

	public function Listar(){
	  $query=$this->db->query("SELECT PKID, Nombre FROM CATEGORIA WHERE Estado = 1");
		$data=$query->result();
		$query->free_result();
		return $data;
	}

  public function countAlumno(){
    $this->db->from('alumno')->where('estado', 1);
    return $this->db->count_all_results();
	}

  public function Insertar($data){
    $arr = array(
               'idAula' => $data['aula'],
               'nombres' => $data['nombres'],
               'apellidos' => $data['apellidos'],
               'fecha_nacimiento' => $data['fecha'],
               'genero' => $data['genero'],
               'dni' => $data['dni'],
               'titular' => $data['titular'],
               'estado' => $data['estado'],
               'register_at' => date("Y-m-d H:i:s")
            );
   if ($this->db->insert('alumno', $arr)) return true;
   else return false;
  }

  public function Verificar($data){
    $this->db->select('id, nombres, apellidos');
    $this->db->from('alumno');
    $this->db->where('nombres', $data['nombres']);
    $this->db->where('estado', 1);
    $this->db->limit(1);
    return $this->db->count_all_results();
  }

  public function CargarAlumno($id){
    $this->db->select('id, idAula, nombres, apellidos, fecha_nacimiento as fecha, genero, titular, estado');
    $this->db->from('alumno');
    $this->db->where('id', $id);
    $this->db->limit(1);
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

    public function CargarAlumnoID($idAula){
      $this->db->select('id');
      $this->db->from('alumno');
      $this->db->where('idAula', $idAula);
      $this->db->where('estado', 1);
      $consulta = $this->db->get();
      $resultado = $consulta->result();
      return $resultado;
    }

  public function Editar($data){
    $arr = array(
               'idAula'           => $data['aula'],
               'nombres'          => $data['nombres'],
               'apellidos'        => $data['apellidos'],
               'fecha_nacimiento' => $data['fecha'],
               'genero'           => $data['genero'],
               'dni'              => $data['dni'],
               'titular'          => $data['titular'],
               'estado'           => $data['estado'],
               'update_at'        => date("Y-m-d H:i:s")
            );
    $this->db->where('id', $data['id']);
    if ($this->db->update('alumno', $arr)) return true;
    else return false;
  }

  public function activardesactivar($data){
    $arr = array(
          'estado' => $data['estado'],
          'update_at' => date("Y-m-d")
         );
    $this->db->where('id', $data['id']);
    if($this->db->update('alumno', $arr)) return true;
    else return false;
  }

  public function Eliminar($id){
    $arr = array(
          'estado' => 2,
        //  'deleted_at' => date("Y-m-d")  FALTA CAMPO EN LA BD
         );
    $this->db->where('id', $id);
    if($this->db->update('alumno', $arr)) return true;
    else return false;
  }


  public function PerfilAlumno($id){
    $this->db->select('a.id, a.nombres, a.apellidos, a.fecha_nacimiento, a.genero, a.titular, a.dni');
    $this->db->select("CONCAT( a.nombres, ' ', a.apellidos) as nombre_alumno", false);
    $this->db->select("IF(d.estado = 1, d.edad,'Sin Evaluación') as edad,
                      IF(d.estado = 1, d.peso,'0') as peso,
                      IF(d.estado = 1, d.talla,'0') as talla", FALSE);
    $this->db->select('di.nombre as diagnostico,al.nombre as aula');
    $this->db->from('alumno a');
    $this->db->join('detalle_evaluacion d', 'd.idAlumno = a.id', 'left');
    $this->db->join('diagnostico di', 'd.idDiagnostico = di.id', 'left');
    $this->db->join('aula al', 'a.idAula = al.id');
    $this->db->where('a.id', $id);
    $this->db->where('a.estado', 1);
    $this->db->order_by('d.fecha', 'desc');
    $this->db->limit(1);
    $consulta = $this->db->get();
    $resultado = $consulta->result();
    return $resultado;
  }

  public function ActualizarDatos($data){
    $arr = array(
               'idEdad'  => $data['idEdad'],
               'idTalla' => $data['idTalla'],
               'idPeso'  => $data['idPeso'],
            );
    $this->db->where('id', $data['idAlumno']);
    $this->db->update('alumno', $arr);
  }

  //contadores

    public function CountAll(){
      $this->db->where('estado', 1);
      $resultado = $this->db->count_all_results('alumno');
      return $resultado;
    }


 }
