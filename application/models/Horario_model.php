<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Horario_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}	
	/*Obtener los horarios de un usuario especifico*/
	public function get_all_by_cve($cve){
		$sql = "select dia.cve AS cdia, dia.descripcion AS ddia, horario.hora_inicio AS ini, horario.hora_fin AS fin from dia inner join horario on dia.cve = horario.cve_dia where horario.cve_doc=".$cve;
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0){
			return $res->result_array();	
		}
		return FALSE;
	}
	public function insert_horario($data){
		$sql = "insert into horario (cve_dia, cve_doc, hora_inicio, hora_fin, intervalo) values(".$data['cve_dia'].",".$data['doc'].",'".$data['fec_ini']."','".$data['fec_fin']."','00:00')";
		$this->db->query($sql);
	}

	public function delete_horario_by_cve($data){
		$sql = "DELETE FROM horario WHERE cve_doc =".$data['doc'];
		$this->db->query($sql);
	}

	/*Regresa los dias faltantes que el usuario no agrego cuando los dio de alta*/
	public function get_dias_faltantes_doctor($data){
		$sql = "select * from dia where cve not in (select cve_dia from horario where cve_doc = ".$data['cve_doc'].")";
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0){
			return $res->result_array();	
		}
		return FALSE;

	}
}
?>