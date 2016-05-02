<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cita_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}	

	

	public function get_all(){
		$sql = "Select cve, descripcion from dia;";
		$getdia=$this->db->query($sql);
		return $getdia->result_array();
	}

	public function horas_ocupadas($data){
		$sql = "Select hora from cita ";
		$gethoras=$this->db->query($sql);
		if ($gethoras->num_rows() > 0){
			return $gethoras->result_array();	
		}
		return FALSE;		
	}

	public function insert_cita($data){
		$sql = "insert into cita (cve_doc, cve_usu, cve_tcita,fecha,hora,nvo) values (".$data['cve_doc'].",".$data['cve_usu'].",1,'".$data['dia']."','".$data['hora']."',true);";
		$res = $this->db->query($sql);
	}


	public function eliminar_cita($data){
		//estoy en la parte de eliminacionnn
		$sql = "delete from cita where cve=;";
		$res = $this->db->query($sql);
	}


}
?>