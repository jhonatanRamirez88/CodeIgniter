<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Codigofacilito extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->load->view('codigofacilito/bienvenido');
	}


	function holaMundo(){
		$this->load->view('codigofacilito/headers');
		$this->load->view('codigofacilito/bienvenido');
	}

}

?>