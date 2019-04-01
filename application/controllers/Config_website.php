<?php 
//------------------------
// project : omegamart
// coder: ACETIENDUNG
// time : 14/12/2011
//------------------------
class Config_website extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
        $admin_id = $this->session->userdata('admin_id');
        if(!isset($admin_id) || empty($admin_id))
        {
            redirect('home/login');
        }

        if($admin_id!=35)
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }
    }

	function index()
	{
		$data['config_detail'] = $this->lib_mod->detail('setting', array('id'=>1));
		$data['content']	= 'config_website/config_detail';		
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $this->load->view('template', $data);
	}

	function edit()
	{
		$edit = $this->input->post('edit');
		if(!empty($edit))
		{	
			$data = array(
				'intro' => $this->input->post('intro'),
				'name' => $this->input->post('name'),
				'en_name' => $this->input->post('en_name'),
				'address' => $this->input->post('address'),
				'en_address' => $this->input->post('en_address'),
				'sign' => $this->input->post('sign'),
				'en_sign' => $this->input->post('en_sign'),
				'email2' => $this->input->post('email2'),
				'email1' => $this->input->post('email1'),
				'homephone' => $this->input->post('homephone'),
				'fax' => $this->input->post('fax'),
				'phone1' => $this->input->post('phone1'),
				'phone2' => $this->input->post('phone2'),
				'skype' => $this->input->post('skype'),
				'size_news_big' => $this->input->post('size_news_big'),
				'size_news_other' => $this->input->post('size_news_other'),
				'size_product_big' => $this->input->post('size_product_big'),
				'size_product_other' => $this->input->post('size_product_other'),
				'description' => $this->input->post('description'),
				'en_description' => $this->input->post('en_description'),
				'keyword' => $this->input->post('keyword'),
				'en_keyword' => $this->input->post('en_keyword'),
				'analytic' => $this->input->post('analytic'),
				'livechat' => $this->input->post('livechat'),
				'map' => $this->input->post('map'),
				'email_send' => $this->input->post('email_send'),
				'password' => $this->input->post('password'),
				'email_port' => $this->input->post('email_port'),
				'email_host' => $this->input->post('email_host'),
				'time_repeat' => $this->input->post('time_repeat'),
				'mail_title' => $this->input->post('mail_title'),
				'mail_template' => $this->input->post('mail_template'),
			);

			if(!empty($_FILES['logo']['name']))
            {
                $image_news_path = realpath(UPLOAD. "data/source/setting");
                $image_thumb = $this->lib_mod->action_upload($image_news_path, 'logo');
                $data['logo'] = 'data/source/setting/'.$image_thumb['file_name'];
                $this->session->unset_userdata('logo');
                $this->session->set_userdata('logo', $data['logo']);
            }	

            if(!empty($_FILES['favicon']['name']))
            {
                $image_news_path = realpath(UPLOAD. "data/source/setting");
                $image_thumb = $this->lib_mod->action_upload($image_news_path, 'favicon');
                $data['favicon'] = 'data/source/setting/'.$image_thumb['file_name'];
                $this->session->unset_userdata('favicon');
                $this->session->set_userdata('favicon', $data['favicon']);
            }	

            if(!empty($_FILES['logo_admin']['name']))
            {
                $image_news_path = realpath(UPLOAD. "data/source/setting");
                $image_thumb = $this->lib_mod->action_upload($image_path, 'logo_admin');
                $data['logo_admin'] = 'data/source/setting/'.$image_thumb['file_name'];
            }	


            $this->session->unset_userdata('title');
            $this->session->set_userdata('title', $data['name']);
			
			$this->lib_mod->update('setting', array('id'=>1), $data);
            $this->session->set_flashdata('success', 'Cập nhật thông tin cấu hình website thành công.');
            redirect('config_website/index');
		}
		$data['config'] = $this->lib_mod->detail('setting', array('id'=>1));
		$data['content']	= 'config_website/config_website';
        $data['header'] = 'edit_base_header';
        $data['footer'] = 'edit_base_footer';
        $this->load->view('template', $data);
	}
}
