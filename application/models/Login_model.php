<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function login_usu($data){
		$sql = "Select tipo from usuario where usuario = '".$data['usuario']."' and password = '".$data['password']."';";
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0){
			return $res->result_array();	
		}
		return FALSE;	
	}//fin funcion login_usu


}//fin class
?>