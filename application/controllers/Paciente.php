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
        $this->load->view('base/menu');     
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
}

?>