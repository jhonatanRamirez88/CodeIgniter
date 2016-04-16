
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidad extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('especialidad_model');
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

	function nuevo(){
		$encabe = 'Nueva especialidad.';
		$arg['page'] = 'cr_esp';
		$this->view($encabe, $arg);
	}

	function recibirdatos(){
		$data = array(
			'descripcion' => $this->input->post('descripcion')
		);	
		$this->especialidad_model->insertarLicenciatura($data);
        $this->nuevo();
	}

	function getLic(){
		$tabla['pollo'] = $this->especialidad_model->getLicenciaturas();
		$this->load->view('alta_doctor',$tabla);
	}

	function consultarEspEditarBorrar(){
		$titulo = 'Especialidades existentes';
		$arg['page'] = 'ud_esp';
		$arg['data'] = $this->especialidad_model->getLicenciaturas();	
		$this->view($titulo, $arg);
		//$this->load->view('ud_esp',$tabla);
	}

	function upLic($cve, $var2){
		$desc = array('desc'=> urldecode($var2));
		$this->especialidad_model->updateLicenciatura($cve,$desc);
        redirect(base_url("index.php/esp/ver"));


	}

	function deLic($var2){
		$data = array('cve'=> urldecode($var2));
		$this->especialidad_model->deleteLicenciatura($data);
		redirect(base_url("index.php/esp/ver"));
	}

}

?>