<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//El módulos de altas, modificaciones y bajas de citas, muestra en un combo los nombres de los pacientes, los nombres de los médicos y el calendario disponible, de acuerdo al médico y la fecha elegida

class Cita extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('usuario_model');
		$this->load->model('paciente_model');
		$this->load->model('cita_model');
		$this->load->model('doctor_model');
		$this->load->model('dia_model');
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
		$encabe = 'Nueva cita.';
		$arg['page'] = 'cita/vista_1';
		$arg['pollo'] = $this->doctor_model->get_all();
		$arg['cita'] = $this->cita_model->get_all();
		//$arg['paciente'] = $this->paciente_model->todo();//obtengo cve, nombre, appat, apmat

		$this->view($encabe, $arg);
	}


	function buscar(){
		$encabe = 'Nueva cita.';
		$arg['page'] = 'cita/vista_2';
		$data = array(
			'doc' => $this->input->post('doctor'),
			'dia' => $this->input->post('dia'),			
		);	
		$arg['horas']=$this->dia_model->horario_dia($data);// cdoc, hini, hfin, nom(usuario), apppat, apmat //le enviamos en data el cve_doc y el cve_dia
		$arg['pac']=$this->paciente_model->todo($data); //cve(cveusu),nombre(nombre usu), ap_paterno,ap_materno order by cve
		$arg['ocu']=$this->cita_model->horas_ocupadas($data);//hora from cita
		$this->view($encabe, $arg);		
		//var_dump($arg['ocu']);
		
	}



	function buscar_paciente(){
		$encabe = 'Nueva cita.';
		$arg['page'] = 'cita/buscar_1';
		$arg['usuario']=$this->paciente_model->todo();//cve(cveusu),nombre(nombre usu), ap_paterno,ap_materno order by cve
		$this->view($encabe, $arg);
		
	}

	function citas_2(){
		$encabe = 'Consulta citas de paciente';
		$data = array(
			'doc' => $this->input->post('doctor'),
		);

		$arg['cveusua'] = $this->input->post('doctor');
		$arg['page'] = 'cita/buscar_2';
		$arg['citas']=$this->cita_model->citas_usu($data);//citas=>cve_doc,cve_usu,cve_tcita,fecha,hora,nvo,cve//
		$this->view($encabe, $arg);		
	}

	function decit($var2){
		$data = array('cve'=> urldecode($var2));
		$this->cita_model->eliminar_cita($data);
		redirect(base_url("index.php/cita/buscar_paciente"));
	}


	/*
	recibe la clave que se va a consultar y llenar la vista update
	*/
	public function verUpdateCita($cve){
		$data = array(
			'cita_cve' => $cve
			);
		$encabe = 'Modificar Cita';
		$arg['page'] = 'cita/up_cita';
		$arg['cita'] = $this->cita_model->get_cita_cve($data);//Contenido de esa cita
		$arg['docs'] = $this->doctor_model->get_all();
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
		$this->cita_model->update_cita($data);
		redirect(base_url("index.php/cita/buscar_paciente"));	
	}

	public function get_horarios_doc_fecha(){
		$edo = date_default_timezone_set ( "America/Mexico_City" );
		$fecha = $this->input->get('fecha');
		$str = date("l", strtotime($fecha));
		$data = array(
			'doc' => $this->input->get('cvedoc'),
			'fecha' => $fecha,
			'dia' =>  $str
		);
		//$resini = $this->dia_model->horario_dia($data);// cdoc, hini, hfin, nom(usuario), apppat, apmat //le enviamos en data el cve_doc y el cve_dia
		//$res = $this->cita_model->horas_ocupadas($data);
		//var_dump($resini);
		echo json_encode($data);
	}



	//insercion de la cita
	public function recibirVerNuevo(){
		$data = array(
			'cve_doc' => $this->input->post('cvedoc'),
			'cve_usu' => $this->input->post('doctor'),

			'hora' => $this->input->post('hora_cita'),

			'dia' => $this->input->post('dia_cita'),
			'hora' => $this->input->post('hora_cita')

		);
		$cveUsu = $this->cita_model->insert_cita($data);
		redirect(base_url("index.php/cita/nuevo"));
	}


}

?>