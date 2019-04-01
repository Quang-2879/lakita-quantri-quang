<?php 
//------------------------
// project : omegamart
// coder: acetiendung
// time : 14/12/2011
//------------------------
class Admin extends CI_Controller
{

	function __construct()
    {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if(!isset($this->admin_id) || empty($this->admin_id))
        {
            redirect('home/login');
        }
    }

	
    function index()
	{
        if(!$this->lib_mod->check_permission('view_admin'))
        {
            header('Content-Type: text/html; charset=utf-8');            
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }

        $this->load->library('pagination');
        $per_page                   = 10;
        $session_per_page = $this->session->userdata('session_per_page');
        if(isset($session_per_page) && $session_per_page>0)
            $per_page = $session_per_page;

        $total                  = $this->lib_mod->count('admin', array('admin_id !='=>35));
        $data['rows'] = $this->lib_mod->load_all('admin', '', array('admin_id !='=>35), $per_page, $this->uri->segment(3), array('admin_id'=>'desc'));
        $base_url               = site_url('admin/index/');
        $config['base_url']     = $base_url;
        $config['per_page']     = $per_page;
        $config['total_rows']   = $total;
        $config['uri_segment']  = 3;
        $this->pagination->initialize($config);
        $data['paging']         = $this->pagination->create_links();
        $data['total'] = $total;
		$data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
		$data['content']	= 'admin/index';
        $this->load->view('template', $data);
	}


	function update($id=0)
	{		
        if($id) $module = 'edit_admin'; else $module = 'add_admin';

        if(!$this->lib_mod->check_permission($module))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'admin/index"</script>';
            exit;
        }

		if($id==35) redirect(site_url().'admin');

		$edit = $this->input->post('edit');
		$save_edit = $this->input->post('save_edit');
        if(!empty($edit) || !empty($save_edit))
		{	
			$admin_name = trim($this->input->post('admin_name'));
            
            $admin_fullname = trim($this->input->post('admin_fullname'));
            
            $admin_email = trim($this->input->post('admin_email'));

            $admin_phone = trim($this->input->post('admin_phone'));

            $admin_address = trim($this->input->post('admin_address'));

            $condition = array('admin_name'=>$admin_name);
            if($id) $condition = array("admin_id !="=>$id, 'admin_name'=>$admin_name);

       		$name_exist = $this->lib_mod->count('admin', $condition);
       		
       		$email_exist = $this->lib_mod->count('admin', $condition);

            $error = '';

       		if($name_exist)
       			$error = 'Tên tài khoản đã tồn tại';

       		if($email_exist)
       			$error = 'Email đã tồn tại';
            
            $data = array(
                'admin_name'   => $admin_name,
                'admin_email'   => $admin_email,
                'admin_fullname'   => $admin_fullname,
                'admin_phone'   => $admin_phone,
                'admin_create_id' => $this->admin_id,
                'admin_create_date' => time(), 
                'admin_address'   => $admin_address,
                'admin_status' => $this->input->post('admin_status')==1?1:0,
                'permission_id'   => $this->input->post('permission_id'),
            );            

            $new_password = trim($this->input->post('new_password'));

            $re_new_password = trim($this->input->post('re_new_password'));

            if(!empty($new_password) || !empty($re_new_password))
            {
                if(empty($new_password) || empty($re_new_password))
                {
                    $error = 'Bạn phải nhập mật khẩu';
                }
                if($new_password != $re_new_password)
                {
                    $error = 'Mật khẩu xác nhận chưa chính xác';
                }
                if(strlen($new_password)<6 || strlen($re_new_password)<6)
                {
                    $error = 'Mật khẩu phải trên 6 kí tự';
                }
                $data['admin_password'] = md5(md5($new_password));
            }

            if(empty($error))
            {
                $search = $this->lib_mod->make_url($admin_name .' ' . $admin_fullname .' ' . $admin_email .' ' . $admin_phone .' ' . $admin_address);
                
                $data['search'] = str_replace('-', ' ', $search);

            	if(!empty($_FILES['admin_thumbnail']['name']))
                {
                    $image_news_path = realpath(APPPATH. "../data/avatar");
                    $image_thumb = $this->lib_mod->action_upload($image_news_path, 'admin_thumbnail');
                    $data['admin_thumbnail'] = 'data/avatar/'.$image_thumb['file_name'];
                }

            	if($id)
				{
                    $data['search'] .= ' '.$id;					
					$this->lib_mod->update('admin', array('admin_id'=>$id), $data);
					$action = 'Cập nhật Quản trị viên "' . $data['admin_fullname'] . '"';
	                $this->lib_mod->insert_log($action);
		            $this->session->set_flashdata('success', $action . ' thành công.');
				}
				else
				{
					$this->lib_mod->insert('admin', $data);
					$action = 'Thêm mới Quản trị viên "' . $data['admin_fullname'] . '"';
	                $this->lib_mod->insert_log($action);
		            $this->session->set_flashdata('success', $action . ' thành công.');
				}

                if(!empty($save_edit))
                    redirect('admin/update/0');

                if(!empty($edit))
                    redirect('admin/index');
        	}
            else
            {
                $this->session->set_flashdata('error', $error);
                redirect('admin/update/'.$id);
            }
		}
		
        $data['permission'] = $this->lib_mod->load_all('permission', '', array('status'=>1), '', '', array('id'=>'asc'));
		$data['row'] = $this->lib_mod->detail('admin', array('admin_id'=>$id));
		$data['id']	= $id;
		$data['content']	= 'admin/update';
		$data['header'] = 'edit_base_header';
        $data['footer'] = 'edit_base_footer';    
        $this->load->view('template', $data);
	}


	function status($id, $admin_status)
	{
        if(!$this->lib_mod->check_permission('edit_admin'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'admin/index"</script>';
            exit;
        }

		if($id==35) redirect(site_url().'admin');
		
		if($admin_status)
			$admin_status = 0;
		else
			$admin_status = 1;

        $data = $this->lib_mod->detail('admin', array("admin_id"=>$id));      

		if(isset($data[0]))
		{
			$this->lib_mod->update('admin', array('admin_id'=>$id), array('admin_status'=>$admin_status));
			$action = 'Cập nhật bản ghi "' . $data[0]['admin_name'] . '" module Quản trị viên';
            $this->lib_mod->insert_log($action);
            $this->session->set_flashdata('success', $action . ' thành công.');
		}
		else
		{
            $this->session->set_flashdata('error', 'Lỗi không xác định được bản ghi để cập nhật');
		}
       
        redirect('admin/index');
	}


	function delete($items_id=array())
	{
		if(!$this->lib_mod->check_permission('del_admin'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'admin/index"</script>';
            exit;
        }

        if(empty($items_id)) 
        {
            $items_id = $this->input->post('items_id');
        }
        else
        {
            $items_id = array($items_id);
        }

        if(count($items_id))
        {
        	$name_not_del = '';
			$name_del = '';
        	foreach ($items_id as $id) 
            {	    
                if($id!=35)
                {
                    $detail = $this->lib_mod->detail('admin', array("admin_id"=>$id));      
                    $name_del .= $detail[0]['admin_name'] . ', ';
                    $this->lib_mod->delete('admin', array("admin_id"=>$id));
                }
            }

            if(!empty($name_del))
            {
	            $action = 'Xóa bản ghi "' . $name_del . '" module Quản trị viên';
                $this->lib_mod->insert_log($action);
	            $this->session->set_flashdata('success', $action . ' thành công.');
            }
        }
        else
        {
        	$this->session->set_flashdata('error', 'Bạn phải chọn ít nhất một bản ghi cần xóa.');
        }

        redirect('admin/index');
	}


    function search()
    {       
        if(!$this->lib_mod->check_permission('view_admin'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }

        $key_word = $this->lib_mod->make_url(trim($this->input->post('key_word')));
        if(empty($key_word)) $key_word = 'empty';
        $admin_status = $this->input->post('admin_status');
        $search = array('key_word'=>$key_word, 'admin_status'=>$admin_status);        
        $param = $this->uri->assoc_to_uri($search);
        $param = str_replace('//','/0/',$param);
        redirect('admin/result_search/'.$param);
    }
    

    function result_search()
    {
        $this->load->model('search_mod', 'search_mod');

        $result = $this->uri->segment_array();

        if (!isset($result[4]) || !isset($result[6]))
        {
            redirect('admin/index');
        }
        else
        {           
            $data['key_word'] = $key_word = $result[4];           
            $data['admin_status'] = $admin_status = $result[6];           

            $this->load->library('pagination');
            $per_page                   = 10;
            $session_per_page = $this->session->userdata('session_per_page');
            if(isset($session_per_page) && $session_per_page>0)
                $per_page = $session_per_page;

            if ($this->uri->segment(7) == null || $this->uri->segment(7) == 1){           
                $offset = 0;    
            }else{
                $offset = $this->uri->segment(7);   
            }   
            $total                  = $this->search_mod->count_admin($key_word, $admin_status);
            $data['rows']      = $this->search_mod->load_admin($key_word, $admin_status, $per_page, $offset);

            $base_url                   = site_url('admin/result_search/key_word/'.$key_word.'/admin_status/'.$admin_status.'/');                                   
            $config['base_url']         = $base_url;
            $config['per_page']         = $per_page;    
            $config['total_rows']       = $total;
            $config['uri_segment']      = 7;                            
            $this->pagination->initialize($config);
            $data['paging']         = $this->pagination->create_links(); 
            $data['total'] = $total;
            $data['is_search'] = 1;
            $data['header'] = 'list_base_header';
            $data['footer'] = 'list_base_footer';
            $data['content']    = 'admin/index';
            $this->load->view('template', $data);
        }
    }
}
