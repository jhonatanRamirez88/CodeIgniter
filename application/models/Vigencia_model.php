<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vigencia_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function getAll(){
		$sql = "SELECT * FROM vigencia";
		$getlic = $this->db->query($sql);
		return $getlic->result_array();		
	}	
}
?>