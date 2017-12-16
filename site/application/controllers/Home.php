<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('auth')):
			redirect('auth','refresh');
			exit;
		endif;
		
	}

	public function index()
	{
		$this->load->view('home');
		
	}
	
	public function logout()
	{
		$this->session->unset_userdata('auth-check');
		$this->session->unset_userdata('auth');
		redirect('auth','refresh');
	}
	
}
