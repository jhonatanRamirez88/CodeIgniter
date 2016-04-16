<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Especialidad_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function insertarLicenciatura($data){
		$sql = "INSERT INTO especialidad(descripcion) values('".$data['descripcion']."')";
		$this->db->query($sql);
	}

	function getLicenciaturas(){
		$sql = "SELECT * FROM especialidad ORDER BY cve";
		$getlic = $this->db->query($sql);
		return $getlic->result_array();
	}

	function updateLicenciatura($cve,$data){
		$sql = "UPDATE especialidad set descripcion='".$data['desc']."' where cve=".$cve."";
		$this->db->query($sql);
	}


	function deleteLicenciatura($data){
		$sql = "delete from especialidad where cve = ".$data['cve']."";
		$this->db->query($sql);
	}
	
}

?>