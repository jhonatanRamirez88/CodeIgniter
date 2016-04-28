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

public function disponibilidad_dia($data){
	$sql="select * from horario inner join cita on horario.cve_doc=cita.cve_doc where cita.cve_doc = '".$data['doc']."' and horario.cve_dia = '".$data['dia']."';"
	//$sql = "select * from cita where cita.cve_doc='".$data['doc']."' and  horario.cve_dia= '".$data['dia']."';";
	$data = $this->db->query($sql);
		if ($data->num_rows() == 0){
		$sql = "select horario.hora_inicio AS inicio, horario.hora_fin As fin  from horario inner join cita on horario.cve_doc=cita.cve_doc where cita.cve_doc='".$data['doc']."' and  horario.cve_dia= '".$data['dia']."';";	
			$data = $this->db->query($sql);
			return $data->result_array();		
		}else{

		}	
	}
}
?>