<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Desk extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('user_type') == '')
		{
			redirect( base_url() . 'index.php?desk/login' , 'refresh');
		}
		
		$page_data['page_name']	=	'files';

		$this->load->view('index', $page_data);
	}

	// LOADS FILES PAGE
	function files($param1 = '' , $param2 = '')
	{	
		if ($this->session->userdata('user_type') == '')
		{
			redirect( base_url() . 'index.php?desk/login' , 'refresh');
		}
		
		$this->crud_model->file_operations($param1 , $param2);

		$this->load->view('files');
		$this->load->view('modal');
	}

	// LOADS FOLDERS PAGE
	function folders($param1 = '' , $param2 = '')
	{
		if ($this->session->userdata('user_type') == '')
		{
			redirect( base_url() . 'index.php?desk/login' , 'refresh');
		}

		$this->crud_model->folder_operations($param1 , $param2);

		$this->load->view('folders');
		$this->load->view('modal');
	}

	// LOADS FILES WITHIN FOLDER
	function files_in_folder($param = '')
	{	
		if ($this->session->userdata('user_type') == '')
		{
			redirect( base_url() . 'index.php?desk/login' , 'refresh');
		}

		$page_data['folder_id']	=	$param;

		$this->load->view('files_in_folder' , $page_data);
		$this->load->view('modal');	
	}

	// LOADS USERS PAGE
	function users($param1 = '' , $param2 = '')
	{
		if ($this->session->userdata('user_type') == '')
		{
			redirect( base_url() . 'index.php?desk/login' , 'refresh');
		}

		if ($this->session->userdata('user_type') == 'admin')
		{
			$this->crud_model->user_operations($param1 , $param2);
		}		

		$this->load->view('users');
		$this->load->view('modal');
	}

	// LOADS GROUP PAGE
	function groups($param1 = '' , $param2 = '')
	{
		if ($this->session->userdata('user_type') == '')
		{
			redirect( base_url() . 'index.php?desk/login' , 'refresh');
		}

		if ($this->session->userdata('user_type') == 'admin')
		{
			$this->crud_model->group_operations($param1 , $param2);
		}

		$this->load->view('groups');
		$this->load->view('modal');
	}

	// LOADS USERS WITHIN GROUPS
	function users_in_group($param = '')
	{	
		if ($this->session->userdata('user_type') == '')
		{
			redirect( base_url() . 'index.php?desk/login' , 'refresh');
		}

		$page_data['group_id']	=	$param;

		$this->load->view('users_in_group' , $page_data);
		$this->load->view('modal');	
	}

	// LOADS SETTINGS PAGE
	function settings($param = '')
	{
		if ($this->session->userdata('user_type') == '')
		{
			redirect( base_url() . 'index.php?desk/login' , 'refresh');
		}

		// CHECK IN CASE OF LOADING AFTER UPDATING PASSWORD
		if ($param != '' && $this->session->userdata('user_type') == 'admin')
		{
			$this->crud_model->setting_operations($param);
		}

		$this->load->view('settings');
		$this->load->view('modal');
	}

	// UPDATES EMAIL ADDRESS
	function update_email()
	{
		if ($this->session->userdata('user_type') == '')
		{
			redirect( base_url() . 'index.php?desk/login' , 'refresh');
		}

		$this->crud_model->update_email();
	}

	// LOADS LOGIN PAGE
	function login()
	{
		$this->load->view('login');
	}

	// UPDATES PASSWORD
	function update_password($param = '')
	{
		$this->crud_model->update_password($param);
	}

	// ZIP SYSTEM
	function zip($param = '')
	{
		$this->crud_model->zip_it($param);
	}

	// CHECK FOR DOWNLOADING FILE
	function download_file($param = '')
	{
		if ($this->session->userdata('user_type') == '')
		{
			redirect( base_url() . 'index.php?desk/login' , 'refresh');
		}

		$this->crud_model->download_it($param);
	}
}










