<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function reporte(){
		$sql = "Select * from usuario;";
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0){
			return $res->result_array();	
		}
		return FALSE;	
	}//fin funcion login_usu


}//fin class
?>