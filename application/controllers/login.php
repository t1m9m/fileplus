<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	// SIGNIN FUNCTION
	function signin()
	{
		$email				=	$this->input->post('email');
		$password			=	$this->input->post('password');
		$query				=	$this->db->get_where('user' , array('email' => $email , 'password' => $password));

		// MATCHES WITH THE USER TABLE
		if ($query->num_rows() > 0) 
		{
			$user_info			=	$query->row();

			$this->session->set_userdata('user_id' , $user_info->user_id);
			$this->session->set_userdata('user_type' , $user_info->type);

			redirect( base_url() , 'refresh');
		}
		else 
			redirect( base_url() , 'refresh');
	}

	// SIGNOUT FUNCTION
	function signout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_type');
		
		redirect( base_url() , 'refresh');
	}

}