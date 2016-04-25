<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vigencia_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
		public function getAll(){
		$sql = "Select * from vigencia order by cve";
		$getvig = $this->db->query($sql);
		return $getvig->result_array();	
	}	
}
?>