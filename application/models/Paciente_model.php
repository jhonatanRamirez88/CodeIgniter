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

	public function todo(){//cve(cveusu),nombre(nombre usu), ap_paterno,ap_materno order by cve
		$sql = "Select usuario.cve AS cve, usuario.nombre As nombre, usuario.ap_paterno As appat, usuario.ap_materno AS apmat from paciente inner join usuario on paciente.cve_usu = usuario.cve order by usuario.cve;";
		$getpac = $this->db->query($sql);
		return $getpac->result_array();
	}
	/*Regres los datos de los pacientes que estan registrados.*/
	public function select_all(){
		$sql = "select paciente.cve_usu, usuario.nombre as nom, usuario.ap_paterno as pat, usuario.ap_materno as mat, usuario.telefono_particular as telpar, paciente.nacimiento as nac, paciente.sexo as sex, paciente.direccion as dir from paciente inner join usuario on usuario.cve = paciente.cve_usu";
		$getpac = $this->db->query($sql);
		return $getpac->result_array();
	}
	public function select_paciente($data){
		$sql = "select paciente.cve_usu, usuario.nombre as nom, usuario.ap_paterno as pat, usuario.ap_materno as mat, usuario.telefono_particular as telpar, paciente.nacimiento as nac, paciente.sexo as sex, paciente.direccion as dir from paciente inner join usuario on usuario.cve = paciente.cve_usu where usuario.cve = ".$data['numero'];
		$getpac = $this->db->query($sql);
		return $getpac->row_array();
	}

	public function update($data){
		/*update en la tabla usuario*/
		$sql = "update usuario set (nombre, ap_paterno, ap_materno, telefono_particular) = ('".$data['cam1']."','".$data['cam2']."','".$data['cam3']."','".$data['cam4']."') where cve = ".$data['numero'];
		$this->db->query($sql);
		/*update en la tabla paciente*/
		$sql = "update paciente set (nacimiento, sexo, direccion) = ('".$data['cam5']."','".$data['cam6']."','".$data['cam7']."') where cve_usu = ".$data['numero'];
		$this->db->query($sql);		
	}
}
?>