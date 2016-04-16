<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Horario_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}	
	public function insert_horario($data){
		$sql = "insert into horario (cve_dia, cve_doc, hora_inicio, hora_fin, intervalo) values(".$data['cve_dia'].",".$data['cve_doc'].",'".$data['fec_ini']."','".$data['fec_fin']."','00:00')";
		$this->db->query($sql);
	}
}
?>