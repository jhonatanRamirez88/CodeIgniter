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



}
?>