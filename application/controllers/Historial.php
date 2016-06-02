
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historial extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('horario_model');
		$this->load->model('paciente_model');
		$this->load->model('historial_model');
		session_start();
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
	public function get_paciente($var,$var2){
		$data['numero'] = $var;
		$_SESSION['cvecita']=$var2;
		$arg['page']='paciente/atender';
		$arg['paciente'] = $this->paciente_model->select_paciente($data);
		$arg['historial'] = $this->historial_model->get_by_cvepaciente($data);
		$this->view($arg['page'], $arg);
	}

	public function get_paciente2($var){
		$data['numero'] = $var;
		$arg['page']='paciente/atender';
		$arg['paciente'] = $this->paciente_model->select_paciente($data);
		$arg['historial'] = $this->historial_model->get_by_cvepaciente($data);
		$this->view($arg['page'], $arg);
	}

	public function nuevo_historial($var){
		$arg['cvecita'] = $_SESSION['cvecita']; //recive la clave primaria de la cita
		$data['numero']=$var;//numero recibe la cve primaria de paciente
		$arg['page']='crea_histo';
		$arg['pac'] = $this->historial_model->select_paciente($data);
		//var_dump($arg['pac']);
		$this->view($arg['page'], $arg);
	}

	public function crearhisto(){
		//$data['cvecita'] = $var;
		$data = array(
			'cvcita' => $this->input->post('cvecita'),
			'di' => $this->input->post('diag'),
			'de' => $this->input->post('desc'),
			'ob' => $this->input->post('obser'),
			
		);
		//var_dump($data);
		$this->historial_model->insert_historial($data);
		
		redirect(base_url("index.php/Cita/verCitasDelDoctor"));
	}

	public function uphisto($var){
		$data['cvehisto'] = $var;
		$arg['historial']=$this->historial_model->get_historial($data);
		$arg['page']='uphistorial';
		//var_dump($arg['historial']);
		$this->view($arg['page'], $arg);
	}

	public function update(){
		$data = array(
			'cve' => $this->input->post('cve'),
			'di' => $this->input->post('diag'),
			'de' => $this->input->post('desc'),
			'ob' => $this->input->post('obser'),
			
		);
		$this->historial_model->up_historial($data);
		redirect(base_url("index.php/Cita/verCitasDelDoctor"));
	}

}
?>