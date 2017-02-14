<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

    function file_operations($param1 = '' , $param2 = '')
    {
    	// ADDS A FILE
		if ($param1 == 'add')
		{	
			// FILTERING OUT THE PHP, HTML, JS, EXE
			$file_path = $_FILES['file']['name'];
			$file_type = pathinfo($file_path, PATHINFO_EXTENSION);

			if ($file_type == 'php' || $file_type == 'html' || $file_type == 'js' || $file_type == 'exe')
			{
				$file_type = 'txt';
			} 

			// IN CASE OF DUPLICATE NAME OF A FILE
			$file_name 	=	$this->input->post('name');
			$file_info	=	$this->db->get('file')->result_array();
			foreach ($file_info as $row)
			{
				if ($file_name == $row['name'])
				{
					$file_id 	 = $row['file_id'];
					$times 		 = ++$row['times'];
					$file_name 	 = $file_name . '_' . $times;
				}
			}

			$data['name']			=	$file_name;
			$data['user_id']		=	$this->session->userdata('user_id');
			$data['type']			=	$file_type;
			$data['size']			=	filesize($_FILES['file']['tmp_name']);
			$data['folder_id']		=	$this->input->post('folder_id');
			$data['timestamp']		=	time();
			$data1['times']			=	$times;

			$this->db->insert('file' , $data);

			$this->db->where('file_id' , $file_id);
			$this->db->update('file' , $data1);

			move_uploaded_file($_FILES['file']['tmp_name'] , 'uploads/'. $data['name'] . '.' . $data['type']);
		}

		// EDITS A FILE
		else if ($param1 == 'edit')
		{
			$data['name']			=	$this->input->post('name');
			$data['folder_id']		=	$this->input->post('folder_id');
			$data['timestamp']		=	time();
			// $data1['times']			=	$times;

			$file_name = $this->db->get_where('file' , array('file_id' => $param2))->row()->name;
			$file_type = $this->db->get_where('file' , array('file_id' => $param2))->row()->type;

			$file_name_type = $file_name . '.' . $file_type;

			rename('uploads/' . $file_name_type , 'uploads/'. $data['name'] . '.' . $file_type);

			$this->db->where('file_id' , $param2);
			$this->db->update('file' , $data);
		}

		// DELETS A FILE
		else if ($param1 == 'delete')
		{	
			$query = $this->db->get_where('file' , array('file_id' => $param2));
			
			if ($query->num_rows() != 0)
			{
				$file_name = $this->db->get_where('file' , array('file_id' => $param2))->row()->name;
				$file_type = $this->db->get_where('file' , array('file_id' => $param2))->row()->type;

				$file_name_type = $file_name . '.' . $file_type;

				unlink('uploads/' . $file_name_type);
			}

			$this->db->where('file_id' , $param2);
			$this->db->delete('file');
		}
    }

    function folder_operations($param1 = '' , $param2 = '')
    {
    	// ADDS A FOLDER
		if ($param1 == 'add')
		{	
			// IN CASE OF DUPLICATE NAME OF A FOLDER
			$folder_name = $this->input->post('name');
			$folder_info = $this->db->get('folder')->result_array();
			foreach ($folder_info as $row)
			{
				if ($folder_name == $row['name'])
				{
					$folder_id 	 = $row['folder_id'];
					$times 		 = ++$row['times'];
					$folder_name = $folder_name . '_' . $times;
				}
			}

			$data['name']			=	$folder_name;
			$data['timestamp']		=	time();
			$data1['times']			=	$times;

			$this->db->insert('folder' , $data);

			$this->db->where('folder_id' , $folder_id);
			$this->db->update('folder' , $data1);
		}

		// EDITS A FOLDER
		else if ($param1 == 'edit')
		{
			$data['name']			=	$this->input->post('name');
			$data['timestamp']		=	time();
			$data1['times']			=	$times;

			$this->db->where('folder_id' , $param2);
			$this->db->update('folder' , $data);
		}

		// DELETES A FOLDER
		else if ($param1 == 'delete')
		{
			$query = $this->db->get_where('folder' , array('folder_id' => $param2));

			if ($query->num_rows() != 0)
			{
				$folder_name = $this->db->get_where('folder' , array('folder_id' => $param2))->row()->name;
				unlink('uploads/' . $folder_name . '.' . 'zip');
			}

			$this->db->where('folder_id' , $param2);
			$this->db->delete('folder');
		}
    }

    function user_operations($param1 = '' , $param2 = '')
    {
    	// ADDS A USER
		if ($param1 == 'add')
		{	
			$permissions 		=	$this->input->post('permission');

			$data['name']			=	$this->input->post('name');
			$data['email']			=	$this->input->post('email');
			$data['permission']		=	$this->set_permission($permissions); // CALLS THE PERMISSION FUNCTION
			$data['password']		=	$this->input->post('password');
			$data['group_id']		=	$this->input->post('group_id');
			$data['type']			=	'user';
			$data['background_id']	=	rand(1,9);
			$data['timestamp']		=	time();

			$this->db->insert('user' , $data);
		}

		// EDITS A USER
		else if ($param1 == 'edit')
		{
			$permissions 		=	$this->input->post('permission');

			$data['name']			=	$this->input->post('name');
			$data['email']			=	$this->input->post('email');
			$data['permission']		=	$this->set_permission($permissions); // CALLS THE PERMISSION FUNCTION
			$data['password']		=	$this->input->post('password');
			$data['group_id']		=	$this->input->post('group_id');
			$data['timestamp']		=	time();

			$this->db->where('user_id' , $param2);
			$this->db->update('user' , $data);
		}

		// DELETES A USER
		else if ($param1 == 'delete')
		{
			$this->db->where('user_id' , $param2);
			$this->db->delete('user');
		}
    }

    function group_operations($param1 = '' , $param2 = '')
    {
    	// ADDS A GROUP
		if ($param1 == 'add')
		{
			$data['name']			=	$this->input->post('name');
			$data['description']	=	$this->input->post('description');
			$data['timestamp']		=	time();

			$this->db->insert('division' , $data);
		}

		// EDITS A GROUP
		else if ($param1 == 'edit')
		{
			$data['name']			=	$this->input->post('name');
			$data['description']	=	$this->input->post('description');
			$data['timestamp']		=	time();

			$this->db->where('division_id' , $param2);
			$this->db->update('division' , $data);						
		}

		// DELETES A GROUP
		else if ($param1 == 'delete')
		{
			$this->db->where('division_id' , $param2);
			$this->db->delete('division');
		}
    }

    // SETS PERMISSION
	function set_permission($param = '')
	{
		$final_permission	=	array();

		if ($param[0] == '')
		{
			$final_permission[0]	=	'-';
			$final_permission[1]	=	'-';
			$final_permission[2]	=	'-';
			$final_permission[3]	=	'-';
		}
		if ($param[0] == 'd')
		{
			$final_permission[0]	=	'd';
			$final_permission[1]	=	'-';
			$final_permission[2]	=	'-';
			$final_permission[3]	=	'-';
		}
		if ($param[0] == 'r')
		{
			$final_permission[0]	=	'-';
			$final_permission[1]	=	'r';
			$final_permission[2]	=	'-';
			$final_permission[3]	=	'-';
		}
		if ($param[0] == 'w')
		{
			$final_permission[0]	=	'-';
			$final_permission[1]	=	'-';
			$final_permission[2]	=	'w';
			$final_permission[3]	=	'-';
		}
		if ($param[0] == 'x')
		{
			$final_permission[0]	=	'-';
			$final_permission[1]	=	'-';
			$final_permission[2]	=	'-';
			$final_permission[3]	=	'x';
		}

		if ($param[1] == 'r')
		{
			$final_permission[1]	=	'r';
		}
		if ($param[1] == 'w')
		{
			$final_permission[2]	=	'w';
		}
		if ($param[1] == 'x')
		{
			$final_permission[3]	=	'x';
		}

		if ($param[2] == 'w')
		{
			$final_permission[2]	=	'w';
		}
		if ($param[2] == 'x')
		{
			$final_permission[3]	=	'x';
		}

		if ($param[3] == 'x')
		{
			$final_permission[3]	=	'x';
		}

		return $final_permission[0] . $final_permission[1] . $final_permission[2] . $final_permission[3];
	}

	function setting_operations($param = '')
	{
		// CHANGES SYSTEM NAME
		if ($param == 'change_system_name')
		{
			$data['value']		=	$this->input->post('name');
			$data['timestamp']	=	time();

			$this->db->where('setting_id' , '1');
			$this->db->update('setting' , $data);
		}

		// CHNAGES LOGO
		else if ($param == 'update_system_logo')
		{	
			$file_path = $_FILES['logo']['name'];
			$file_type = pathinfo($file_path, PATHINFO_EXTENSION);

			$data['name']		=	'logo';
			$data['value']		=	$_FILES['logo']['name'];
			$data['timestamp']	=	time();

			if (empty($_FILES['logo']['name']))
			{
				// NO FUNCTION NEEDED
			} 

			else if ($file_type == 'png' || $file_type == 'jpeg' || $file_type == 'jpg' || $file_type == 'gif' || $file_type == 'tif') 
			{
				$this->db->where('setting_id' , '2');
				$this->db->update('setting' , $data);

				move_uploaded_file($_FILES['logo']['tmp_name'], 'assets/system_images/' . $data['value']);
			} 
		}
	}

	// UPDATES PASSWORD
	function update_password($param = '')
	{
		$old_password = $this->db->get_where('user' , array('user_id' => $param))->row()->password;
		
		if ($old_password == $this->input->post('old_password'))
		{
			$data['password']		=	$this->input->post('new_password');

			$this->db->where('user_id' , $param);
			$this->db->update('user' , $data);

			$this->session->set_flashdata('password_match', 'You have set your new password succesfully');

		} else {
			$this->session->set_flashdata('password_match', 'Your old passwords did not match');
		}
	}

	// ZIPS ALL THE FILES WITHIN A FOLDER
	function zip_it($param = '')
	{
		$zip_name = $this->db->get_where('folder' , array('folder_id' => $param))->row()->name;
	
		$zip = new ZipArchive;

		$files =  $this->db->get_where('file' , array('folder_id' => $param))->result_array();

		if ($zip->open('uploads/' . $zip_name . '.zip',  ZipArchive::CREATE))
		{
			foreach ($files as $row)
			{
				$file_name = $this->db->get_where('file' , array('folder_id' => $row['folder_id']))->row()->name;
				$file_type = $this->db->get_where('file' , array('folder_id' => $row['folder_id']))->row()->type;

				$file_name_type = $file_name . '.' . $file_type;

				$zip->addFile('uploads/' . $file_name_type, basename($file_name_type));
			}
			$zip->close();
		}

		force_download($zip_name . '.zip' , file_get_contents("uploads/" . $zip_name . ".zip"));
	}

	// LETS YOU DOWNLOAD FILE AFTER CHECKING
	function download_it($param = '')
	{
		$file_name 	 =	$this->db->get_where('file' , array('file_id' => $param))->row()->name;
		$file_type 	 =	$this->db->get_where('file' , array('file_id' => $param))->row()->type;

		$file_name_type = $file_name . '.' . $file_type;
		$path_to_file 	= file_get_contents("uploads/" . $file_name_type); 

		force_download($file_name_type , $path_to_file);
	}

	// UPDATES ADMIN'S EMAIL
	function update_email()
	{
		$data['email']			=	$this->input->post('email');

		$this->db->where('user_id' , '1');
		$this->db->update('user' , $data);
	}
}










