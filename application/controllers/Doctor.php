<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('especialidad_model');
		$this->load->model('dia_model');
		$this->load->model('usuario_model');
		$this->load->model('doctor_model');
		$this->load->model('horario_model');
		$this->load->model('vigencia_model');
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
		$encabe = 'Nuevo doctor';
		$arg['page'] = 'doctor/nuevo';
		$arg['pollo'] = $this->especialidad_model->getLicenciaturas();
		$arg['dias'] = $this->dia_model->getAll();
		$this->view($encabe, $arg);		
	}

	public function recibirVerNuevo(){
		$data = array(
			'nom' => $this->input->post('nom'),
			'appat' => $this->input->post('appat'),
			'apmat' => $this->input->post('apmat'),
			'telpar' => $this->input->post('telpar')
		);
		$cveUsu = $this->usuario_model->insert_usuario($data);
		
    	foreach($cveUsu as $cve) {
        	$cveUsu = $cve['cve'];//Reuso la variable antes era un arreglo, en este paso solo tiene la cve
        	break;
    	}
		$data1 = array(
			'telmov' => $this->input->post('telmov'),
			'usuk' => $cveUsu,
			'espk' => $this->input->post('esp')
			);
		$cveDoc = $this->doctor_model->insert_doctor($data1);
    	foreach($cveDoc as $cve) {
        	$cveDoc = $cve['cve'];//Reuso la variable antes era un arreglo, en este paso solo tiene la cve
        	break;
    	}

		/*for($index = 1; $index < 7; $index += 1){//recorre del 1 al 6 por los dias
			$data2 = array(
				'fec_ini' => $this->input->post('ini_'.$index),
				'fec_fin' => $this->input->post('fin_'.$index),
				'cve_dia' => $index,
				'cve_doc' => $cveDoc
				);
			$this->horario_model->insert_horario($data2);
		}*/	
		redirect(base_url("index.php/doc/nuevo"));
	}
	
	public function verConsulta(){
		$encabe = 'Consulta Doctor';
		$arg['page'] = 'doctor/consultarTodo';
		$arg['datos'] = $this->usuario_model->get_all(); 
		$this->view($encabe,$arg);
	}
	/*
	recibe la clave que se va a consultar y llenar la vista update
	*/
	public function verUpdateConsulta($cve){
		$data = array(
			'cve' => $cve
			);
		$encabe = 'Modificar Doctor';
		$arg['page'] = 'doctor/up_doc';
		$arg['pollos'] = $this->especialidad_model->getLicenciaturas();
		$arg['vigencia']= $this->vigencia_model->getAll();
		$arg['datos'] = $this->usuario_model->get_inner_usuario($data);
		//var_dump($arg['datos']);
		$this->view($encabe,$arg);
	}
	public function executeUpdate(){
		$data = array(
			'nom' => $this->input->post('nom'),
			'appat' => $this->input->post('appat'),
			'apmat' => $this->input->post('apmat'),
			'telpar' => $this->input->post('telpar'),
			'telmov' => $this->input->post('telmov'),
			'esp' => $this->input->post('esp'),
			'vigencia' => $this->input->post('vigencia'),
			'cve_usu' => $this->input->post('cve_doc'),
		);

		$this->doctor_model->update_doctor($data);
		redirect(base_url("index.php/doc/ver"));	
	}

	public function delete_doctor($cve){
		$data = array('cve' => $cve);
		$this->doctor_model->delete_doctor($data);
		redirect(base_url("index.php/doc/ver"));
	}
}
?>