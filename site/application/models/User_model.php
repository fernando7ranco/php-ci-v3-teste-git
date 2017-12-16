<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	
	const TABLE = 'users';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function create($data): int
	{
		//var_dump($this->db->insert_string('users', $data));
		
		// data email and password
		
		$queryEmail = $this->queryEmail($data['email'])->num_rows();

		if( !$queryEmail ):
			$this->db->insert(SELF::TABLE, $data);
			return $this->db->insert_id();
		endif;
		
		return -1;//email ja cadastrado
	}
	
	public function login($data): int
	{
		//var_dump($this->db->insert_string('users', $data));
		
		// data email and password
		
		$queryEmail = $this->queryEmail($data['email']);
		
		$queryEmailNumRows = $queryEmail->num_rows();

		if( $queryEmailNumRows and password_verify($data['password'] , $queryEmail->first_row('array')['password'] ) ):
			$this->session->set_userdata('auth-check', true);
			$this->session->set_userdata('auth',  $queryEmail->first_row());
			return 1;
		else:
		
			if( $queryEmailNumRows == 0 )
				return 2; //email não encontrado
			
			return 3; // erro da senha
			
		endif;
		
	}
	
	public function queryEmail($email)
	{
		return $this->db->get_where(SELF::TABLE, [ 'email' => $email ]);
	}
	
	public function __toString()
	{
		return 'class User_model';
	}
}
