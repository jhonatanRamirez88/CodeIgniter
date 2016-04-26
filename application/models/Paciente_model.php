<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paciente_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}	
	public function nuevo($data){
		$sql = "insert into paciente (cve_usu, nacimiento, sexo, direccion) values(".$data['usu'].",'".$data['nac']."','".$data['sex']."','".$data['dir']."');";
		$this->db->query($sql);
	}
}
?>