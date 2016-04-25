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

	public function nuevo_paciente(){
		$data = array(
			'nom' => $this->input->post('nom'),
			'appat' => $this->input->post('appat'),
			'apmat' => $this->input->post('apmat'),
			'telpar' => $this->input->post('telpar'),
		);

		$data1 = array(
			'nac' => $this->input->post('nom'),
			'sex' => $this->input->post('nom'),
			'dir' => $this->input->post('nom'),
			'usu' => $this->input->post('nom')
			);
	}

}

?>