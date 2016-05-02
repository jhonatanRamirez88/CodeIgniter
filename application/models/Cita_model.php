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
		$sql = "select cita.cve as cve,doctor.cve_usu as cdoc,usuario.nombre as nombre,cita.hora as hora,cita.fecha as fecha from cita,doctor,usuario where cita.cve_doc=doctor.cve and usuario.cve=doctor.cve_usu and cita.cve_usu=".$data['doc'].";";
		$res = $this->db->query($sql);
		return $res->result_array();
	}


	public function eliminar_cita($data){
		//estoy en la parte de eliminacionnn
		$sql = "delete from cita where cve=".$data['cve'].";";
		$res = $this->db->query($sql);
	}

	public function update_cita($data){
		$sql = "UPDATE usuario set nombre='".$data['nom']."', ap_paterno='".$data['appat']."', ap_materno='".$data['apmat']."' ,telefono_particular='".$data['telpar']."' where cve= (SELECT cve_usu FROM doctor WHERE cve=".$data['cve_usu'].")";		
		$this->db->query($sql);
		$sql = "UPDATE doctor set telefono_movil='".$data['telmov']."', cve_esp='".$data['esp']."', cve_vigencia='".$data['vigencia']."' where cve='".$data['cve_usu']."'";		
		$this->db->query($sql);
	}

}
?>