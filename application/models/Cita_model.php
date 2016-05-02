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
		return $gethoras->result_array();
	}

	public function insert_cita($data){
		//nombre(cve_doc),hini,hfin,doctor(cve_pac),hora_cita,".$data['hora']."
		$sql = "insert into cita (cve_doc, cve_usu, cve_tcita,fecha,hora,nvo) values (".$data['cve_doc'].",".$data['cve_usu'].",1,'2016-04-02','".$data['hora']."',true);";
		$res = $this->db->query($sql);
	}

	public function citas_usu($data){
		$sql = "Select * from cita where cve_usu = ".$data['doc'].";";
		$res = $this->db->query($sql);
		return $res->result_array();
	}


	public function eliminar_cita($data){
		//estoy en la parte de eliminacionnn
		$sql = "delete from cita where cve=".$data['cve'].";";
		$res = $this->db->query($sql);
	}


}
?>