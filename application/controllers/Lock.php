<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lock extends CI_Controller {

	function index()
	{
        $this->session->sess_destroy();
        $this->load->view('home/lock');
	}
    
	function action_login() 
	{
		$submit = trim($this->input->post('submit'));
		if($submit)
		{
            $admin_name = $this->input->post('admin_name');   
            $admin_fullname = $this->input->post('admin_fullname');   
            $admin_email = $this->input->post('admin_email');   
            $admin_thumbnail = $this->input->post('admin_thumbnail');   

            $password = md5(md5($this->input->post('password')));   
            $admin = $this->lib_mod->detail('admin', array('admin_name'=>$admin_name, 'admin_password'=>$password, 'admin_status'=>1));
            if(count($admin))
            {
            	$this->session->set_userdata('admin_id', $admin[0]['admin_id']);
                $this->session->set_userdata('admin_fullname', $admin[0]['admin_fullname']);
                $this->session->set_userdata('admin_name', $admin[0]['admin_name']);
                $this->session->set_userdata('admin_email', $admin[0]['admin_email']);
                $this->session->set_userdata('admin_thumbnail', $admin[0]['admin_thumbnail']);

                $config = $this->lib_mod->detail('setting', array('id'=>1));
                $this->session->set_userdata('title', $config[0]['name']);
            	$this->session->set_userdata('logo', $config[0]['logo_admin']);
                $this->session->set_userdata('favicon', $config[0]['favicon']);

            	redirect(site_url());
    		}
    		else
    		{
                $this->session->set_userdata('admin_fullname', $admin_fullname);
                $this->session->set_userdata('admin_name', $admin_name);
                $this->session->set_userdata('admin_email', $admin_email);
                $this->session->set_userdata('admin_thumbnail', $admin_thumbnail);

    	        $this->session->set_flashdata('error', 'Mật khẩu không đúng.');
    			redirect('lock/index');
            }
		}
	}	
}

	