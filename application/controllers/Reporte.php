<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//El módulos de altas, modificaciones y bajas de citas, muestra en un combo los nombres de los pacientes, los nombres de los médicos y el calendario disponible, de acuerdo al médico y la fecha elegida

class reporte extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('reporte_model');
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
	
	public function reporte(){
		$encabe = 'Reporte';
		$arg['page'] = 'reporte';
		$arg['reporte']=$this->reporte_model->reporte();
		$this->view($encabe, $arg);	

	}//fin funcion

}//fin clase

?>