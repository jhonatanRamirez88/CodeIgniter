<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('usuario_model');
		$this->load->model('paciente_model');
	}

	public function view($titulo = 'home', $arg)
	{

        if ( ! file_exists(APPPATH.'views/'.$arg['page'].'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
        $data['title'] = ucfirst($titulo);
        $this->load->view('base/head', $data);
		session_start();
		if($_SESSION['tipo'] == '0'){
			$this->load->view('base/menu');     
		}elseif ($_SESSION['tipo'] == '1') {
			$this->load->view('base/menu2');     
		}elseif ($_SESSION['tipo'] == '2') {
			$this->load->view('base/menu3');     
		}        
        $this->load->view($arg['page'], $arg);
        $this->load->view('base/foot');
	}
	public function verNuevo(){
		
		$par1 = 'Crear Paciente';
		$arg['page'] = 'paciente/nuevo';
		$this->view($par1,$arg);		
	}

	public function crearPaciente(){
		$data = array(
			'nom' => $this->input->post('nom'),
			'appat' => $this->input->post('appat'),
			'apmat' => $this->input->post('apmat'),
			'telpar' => $this->input->post('telpar'),
		);
		$res = $this->usuario_model->insert_usuario($data);
    	foreach($res as $cve) {
        	$res = $cve['cve'];//Reuso la variable antes era un arreglo, en este paso solo tiene la cve
        	break;
    	}
		$data1 = array(
			'nac' => $this->input->post('fnac'),
			'dir' => $this->input->post('dir'),
			'sex' => $this->input->post('sex'),
			'usu' => $res
		);
		$this->paciente_model->nuevo($data1);
		redirect(base_url("index.php/Paciente/verNuevo"));
	}

	public function verTodo(){
		$arg['data'] = $this->paciente_model->select_all();
		$arg['page'] = 'paciente/consultar';
		$this->view('holo', $arg);
	}

	public function verUpdate($val){
		$data['numero'] = $val;
		$arg['data'] = $this->paciente_model->select_paciente($data);
		$arg['page'] = 'paciente/cambiar';
		$this->view('wu', $arg);
	}

	public function doUpdate(){
		$data = array(
			'cam1' => $this->input->post('nom'),
			'cam2' => $this->input->post('appat'),
			'cam3' => $this->input->post('apmat'),
			'cam4' => $this->input->post('telpar'),
			'cam5' => $this->input->post('fnac'),
			'cam6' => $this->input->post('sex'),
			'cam7' => $this->input->post('dir'),
			'numero' => $this->input->post('oculto')
		);
		$this->paciente_model->update($data);
		redirect(base_url("index.php/Paciente/verTodo"));	
	}
	public function doUpdateParaDoctorMenu(){
		$data = array(
			'cam1' => $this->input->post('nom'),
			'cam2' => $this->input->post('appat'),
			'cam3' => $this->input->post('apmat'),
			'cam4' => $this->input->post('telpar'),
			'cam5' => $this->input->post('fnac'),
			'cam6' => $this->input->post('sex'),
			'cam7' => $this->input->post('dir'),
			'numero' => $this->input->post('oculto')
		);
		$this->paciente_model->update($data);
		redirect(base_url("index.php/Historial/get_paciente2/".$this->input->post('oculto')));	
	}
}

?>