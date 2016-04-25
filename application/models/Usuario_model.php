<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function insert_usuario($data){
		$sql = "insert into usuario (nombre, ap_paterno, ap_materno,telefono_particular) values('".$data['nom']."','".$data['appat']."','".$data['apmat']."','".$data['telpar']."') RETURNING cve";
		$res = $this->db->query($sql);
		return $res->result_array();
	}
	/*Se obtienen */
	public function get_all(){		
		//$sql = "SELECT * FROM usuario ORDER BY cve"; // esto regresa (cve_usu)cve,nombre,appat, apmat,telefono particular
		$sql = "Select usuario.cve AS cve, usuario.nombre AS nombre, usuario.ap_paterno AS ap_paterno, usuario.ap_materno AS ap_materno,usuario.telefono_particular AS par, vigencia.descripcion AS vig FROM usuario inner join doctor on  doctor.cve_usu = usuario.cve inner join vigencia on vigencia.cve = doctor.cve_vigencia ORDER BY cve";
		$getusu = $this->db->query($sql);
		return $getusu->result_array();
	}
	public function get_inner_usuario($data){
		$sql = "select usuario.nombre AS nom, usuario.ap_paterno AS pat, usuario.ap_materno AS mat,usuario.telefono_particular AS par,doctor.telefono_movil AS mov ,especialidad.descripcion AS esp,vigencia.descripcion AS vig,doctor.cve AS cve_doc  from doctor inner join usuario on usuario.cve = doctor.cve_usu inner join especialidad on especialidad.cve = doctor.cve_esp inner join vigencia on vigencia.cve = doctor.cve_vigencia WHERE usuario.cve = ".$data['cve'];
		$getusu = $this->db->query($sql);
		return $getusu->row_array();	
	}
}
?>