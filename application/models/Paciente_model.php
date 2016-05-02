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

	public function todo(){//cve(cveusu,nombre(nombre usu), ap_paterno,ap_materno order by cve)
		$sql = "Select usuario.cve AS cve, usuario.nombre As nombre, usuario.ap_paterno As appat, usuario.ap_materno AS apmat from paciente inner join usuario on paciente.cve_usu = usuario.cve order by usuario.cve;";
		$getpac = $this->db->query($sql);
		return $getpac->result_array();
	}
}
?>