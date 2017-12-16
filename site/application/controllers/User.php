<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		//$this->load->view('welcome_message');
		var_dump($this->uri->segment(3));
	}
	
	public function teste()
	{
		//$this->load->model('user_model','user');
		//die($this->user);
		
		$this->load->view('bootstrap-4');
	}
}
