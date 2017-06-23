<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() {
		//$this->doctrine->generate_classes();
		$this->template->load("layouts/template", "home");
		//$this->load->view('welcome_message');
	}
}
