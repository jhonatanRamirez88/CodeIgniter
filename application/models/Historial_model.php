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


	public function select_paciente($data){
		$sql = "select paciente.cve_usu, usuario.nombre as nom, usuario.ap_paterno as pat, usuario.ap_materno as mat from paciente inner join usuario on usuario.cve = paciente.cve_usu where usuario.cve = ".$data['numero'];
		$getpac = $this->db->query($sql);
		return $getpac->row_array();
	}

	public function insert_historial($data){
		$sql = "insert into historial (cve_cit, diagnostico, desc_consulta, observaciones) values(".$data['cvcita'].",'".$data['di']."','".$data['de']."','".$data['ob']."');";
		$this->db->query($sql);
	}

	public function get_historial($data){
		$sql = "select * from historial where cve = '".$data['cvehisto']."';";
		$gethisto = $this->db->query($sql);
		return $gethisto->row_array();	
	}
	
	public function up_historial($data){
		$sql = "update historial set diagnostico='".$data['di']."', desc_consulta='".$data['de']."', observaciones='".$data['ob']."' where cve = '".$data['cve']."';";
		$this->db->query($sql);
	}
}
?>