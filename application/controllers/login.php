<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//El módulos de altas, modificaciones y bajas de citas, muestra en un combo los nombres de los pacientes, los nombres de los médicos y el calendario disponible, de acuerdo al médico y la fecha elegida

class login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('usuario_model');
		$this->load->model('login_model');
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
        //$this->load->view('base/menu');        
        $this->load->view($arg['page'], $arg);
        $this->load->view('base/foot');
	}	
	public function inicio(){
		$encabe = 'Login usuarios';
		$arg['page'] = 'login';
		$this->view($encabe, $arg);		
	}//fin funcion inicio


	public function login(){
		$encabe = 'Login usuarios';
		$data = array(
			'usuario' => $this->input->post('usuario'),
			'password' => $this->input->post('pass'),
		);
		$arg['page'] = 'login';
		$arg['login']=$this->login_model->login_usu($data);
		if ($arg['login'] == FALSE){
			$this->view($encabe, $arg);	
		}else{
			$x = $arg['login'];
				$z = $x[0];
				$w = $z['usuario'];
			if ($z['usuario'] == 'secretaria'){
				$this->load->view('base/menu2');        
				$arg['page'] = 'bienvenido';
				$this->view($encabe, $arg);					
			}else{
				$this->load->view('base/menu');        
				$arg['page'] = 'bienvenido';
				$this->view($encabe, $arg);		
			}//fin if			
		}//fin if		
	}//fin funcion

}//fin clase

?>