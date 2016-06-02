<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Historial_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}	
	/*Obtenemos todo el historial de un paciente en especifico*/
	public function get_by_cvepaciente($data){
		$sql = "select historial.cve as cvediag, cita.cve as cvecita, cita.cve_usu as cveusu, historial.diagnostico as diag, historial.desc_consulta as desc, historial.observaciones as obs, cita.fecha  from cita  inner join historial on cita.cve = historial.cve_cit where cita.cve_usu = ".$data['numero']." order by fecha";
		$getpac = $this->db->query($sql);
		return $getpac->result_array();		
	}
}
?>