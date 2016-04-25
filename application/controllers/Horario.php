
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horario extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('horario_model');
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
	/*Obteemos los horarios de un doctor en especifico,
	regresa una tabla si lo logra hacer. De otro modo regresa un false*/
	public function get_horario_cve(){
		$valor = $this->input->get('cve_doc');
		$cont = $this->horario_model->get_all_by_cve($valor);
		if($cont==FALSE){
			$arrayName = array(
				'edo' => false				
				);
		}else{
			$arrayName = array(
				'edo' => true		
			);
			//Convertir result array to json
		}

		echo json_encode($arrayName);
	}
	/*Creamos un nuevo horario que se asocia en la vista /Doctor/ver_horario*/
	public function crear_nuevo(){
		for($index = 1; $index < 7; $index += 1){//recorre del 1 al 6 por los dias
			$data2 = array(
				'fec_ini' => $this->input->post('ini_'.$index),
				'fec_fin' => $this->input->post('fin_'.$index),
				'cve_dia' => $index,
				'doc' => $this->input->post('cvedoc')
				);
			$this->horario_model->insert_horario($data2);
		}	
		redirect(base_url("index.php/Doctor/ver_horario"));

	}
}
?>