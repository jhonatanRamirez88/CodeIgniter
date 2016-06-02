<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function reporte($data){
		$sql = "CREATE OR REPLACE VIEW usuarios AS select usuario.nombre as nomusu, cita.hora, cita.fecha from usuario,cita where cita.cve_usu=usuario.cve;";
		$this->db->query($sql);
		$sql = "CREATE OR REPLACE VIEW doctores AS select usuario.nombre as nomdoc, cita.fecha, cita.hora from usuario,cita,doctor where usuario.cve=doctor.cve_usu and cita.cve_doc=doctor.cve;";
		$this->db->query($sql);

		$sql ="CREATE OR REPLACE VIEW reporte AS select doctores.nomdoc, usuarios.nomusu, usuarios.fecha, usuarios.hora from usuarios,doctores 
where usuarios.fecha=doctores.fecha and usuarios.hora=doctores.hora;";
		$this->db->query($sql);
		$sql = "select * from reporte where fecha between '".$data['di']."' and '".$data['df']."' order by fecha;";
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0){
			return $res->result_array();	
		}
		return FALSE;	
	}//fin funcion login_usu


}//fin class
?>