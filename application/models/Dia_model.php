<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dia_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}	
	public function getAll(){
		$sql = "SELECT * FROM dia";
		$data = $this->db->query($sql);
		return $data->result_array();		
	}
}
?>