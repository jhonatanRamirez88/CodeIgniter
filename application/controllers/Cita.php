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
        session_start();
		if($_SESSION['tipo'] == '0'){
			$this->load->view('base/menu');     
		}elseif ($_SESSION['tipo'] == '1') {
			$this->load->view('base/menu2');     
		}elseif ($_SESSION['tipo'] == '2') {
			$this->load->view('base/menu3');     
		}        
        //$this->load->view('base/menu');        
        $this->load->view($arg['page'], $arg);
        $this->load->view('base/foot');
	}	


	function nuevo(){
		$encabe = 'Nueva cita.';
		$arg['page'] = 'cita/vista_1';
		$arg['pollo'] = $this->doctor_model->get_docs_si_horario();
		//$arg['paciente'] = $this->paciente_model->todo();//obtengo cve, nombre, appat, apmat

		$this->view($encabe, $arg);
	}


	function buscar(){
		$encabe = 'Nueva cita.';
		$arg['page'] = 'cita/vista_2';
		$data = array(
			'doc' => $this->input->post('doctor'),//cve_doc
			'fecha' => $this->input->post('dia'),	//fecha completa
			'dia' => $this->input->post('cve_dia'), //cve_dia			
		);	
		$arg['fechacom'] = $this->input->post('dia');	//fecha completa
		$arg['cve_dia']=$this->input->post('cve_dia');
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
			'doc' => $this->input->post('paciente'),
		);
		$arg['cveusua'] = $this->input->post('paciente');
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
		$arg['pacientedatos'] = $this->usuario_model->get_user_by_cve($arg['cita']['cve_usu']);		
		$arg['docs'] = $this->doctor_model->get_docs_si_horario();
		$arg['cve_cita'] = $cve;
		$this->view($encabe,$arg);
		
	}
	public function executeUpdate(){
		$data = array(
			'cve_cita' => $this->input->post('cita'),
			'cve_doc' => $this->input->post('doctor'),
			'hora' => $this->input->post('hora'),
			'fecha' => $this->input->post('fecha')
		);
		//var_dump($data);
		$this->cita_model->update_cita($data);
		redirect(base_url("index.php/cita/buscar_paciente"));	
	}

	public function get_horarios_doc_fecha(){
		$edo = date_default_timezone_set ( "America/Mexico_City" );
		$fecha = $this->input->post('fecha');
		$str = date("l", strtotime($fecha));
		$var = 0;
		switch ($str) {
    		case "Monday":
        		$var = 1;
        		break;
    		case "Tuesday":
        		$var = 2;
        		break;
    		case "Wednesday":
        		$var = 3;
        		break;
    		case "Thursday":
        		$var = 4;
        		break;
    		case "Friday":
        		$var = 5;
        		break;
    		case "Saturday":
        		$var = 6;
        		break;        		        		        		
		}
		$data = array(
			'doc' => $this->input->post('cvedoc'),
			'fecha' => $fecha,
			'dia' =>  $var
		);
		$vars = $this->dia_model->horario_dia($data);// cdoc, hini, hfin, nom(usuario), apppat, apmat //le enviamos en data el cve_doc y el cve_dia
		//SI $VARS = FALSE, no tiene ningun valor el doctor no tiene horario de atencion en ese dia..
		if($vars == FALSE){
			array_push($data, FALSE);
		}else{
			//Pedimos todos los horarios que tiene ocupados dicho doctor con dicha fecha
			$arw = $this->cita_model->horas_ocupadas($data);//arw:: array of rows
			//Creamos los arreglos que se van a mostrar en las horas disponibles.
			$ini = $vars[0]['hini'];
			$fin = $vars[0]['hfin'];
			$arreglo= array();
			$max = (int)$fin - (int)$ini;
			$acum = (int)$ini;
			for ( $i = 0; $i < $max; $i+=1)
			{
				$arreglo[$i] = $acum;
				$acum++;
			}//fin del for		
			if($arw == FALSE){
				$disponible = $arreglo;//Todas las horas disponibles
			}else{
				$index = 0;
				foreach ($arw as $var => $value) {
					$modificado[$index] = (int)$value['hora'];//nos dice los dias ocupados
					$index++;
				}

				foreach($arreglo as $key => $value){//arreglo tiene los dias completos 
				  if(!isset($modificado[$key])){
				       unset($modificado[$key]);
				  }
				}	 
				// Si $aDatos es un array de estructura que deberia guardarse como referencia crea un nuevo array con la diferencia de valores
				$index = 0;
				foreach($arreglo as $key => $value){
				  	if(!isset($modificado[$key])){
				       	$disponible[$index] = $value; //horas disponibles que mostrare en el combobox
						$index++;
				  	}
				}
			}
			array_push($data, $disponible);
		}
		echo json_encode($data);
	}



	//insercion de la cita
	public function recibirVerNuevo(){
		$data = array(
			'cve_doc' => $this->input->post('cvedoc'),
			'cve_usu' => $this->input->post('doctor'),
			'hora' => $this->input->post('hora_cita'),
			'dia' => $this->input->post('dia_cita'),
			'hora' => $this->input->post('hora_cita'),
		);
		$cveUsu = $this->cita_model->insert_cita($data);
		redirect(base_url("index.php/cita/nuevo"));
	}


}

?>