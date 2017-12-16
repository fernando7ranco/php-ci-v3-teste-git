<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('auth')):
			redirect('home','refresh');
			exit;
		endif;
		
	}

	public function index()
	{
		$this->load->helper('form');
		
		if(set_value('cadastro')):
			$this->cadastro();
		elseif(set_value('entrar')):
			$this->entrar();
		endif;
		
		$this->load->view('auth');
	}
	
	private function cadastro()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('emailc', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('passconf', 'Senha Confirmação', 'trim|required|matches[password]');
		
		if ($this->form_validation->run() == FALSE) return false;
		
		$this->load->model('user_model','user');
		
		$inputVal = $this->input->post();
		
		$data = [
			'email' => $inputVal['emailc'],
			'password' => password_hash($inputVal['password'], PASSWORD_DEFAULT),
		];
		
		$return = $this->user->create($data);
		
		if($return == -1)
			sessionMsg("form", "email já cadastrado no sistema");
		
		redirect('home','refresh');
	}
	
	private function entrar()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('emaile', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[6]');
		
		if ($this->form_validation->run() == FALSE)
			return "erro no login !!";
		
		$this->load->model('user_model','user');
		
		$inputVal = $this->input->post();
		
		$data = [
			'email' => $inputVal['emaile'],
			'password' => $inputVal['password'],
		];
		
		$return = $this->user->login($data);
		if( $return == 1 )
			redirect('home','refresh');
		if( $return == 2 )
			sessionMsg("form", "email não encontrado no sistema");
		else if( $return == 3 )
			sessionMsg("form", "senha não corresponde ao email");
	}
	
}
