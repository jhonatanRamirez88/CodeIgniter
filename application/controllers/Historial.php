
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historial extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('horario_model');
		$this->load->model('paciente_model');
		$this->load->model('historial_model');
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
	/*Obtenemos los datos del usuario */
	public function get_paciente($var){
		$data['numero'] = $var;
		$arg['page']='paciente/atender';
		$arg['paciente'] = $this->paciente_model->select_paciente($data);
		$arg['historial'] = $this->historial_model->get_by_cvepaciente($data);
		$this->view($arg['page'], $arg);
	}

}
?>