<?php 
//------------------------
// project : omegamart
// coder: ACETIENDUNG
// time : 14/12/2011
//------------------------
class Permission extends CI_Controller
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
		if(!$this->lib_mod->check_permission('view_permission'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }

        $this->load->library('pagination');
        $per_page                   = 1;
        $session_per_page = $this->session->userdata('session_per_page');
        if(isset($session_per_page) && $session_per_page>0)
            $per_page = $session_per_page;

        $total                  = $this->lib_mod->count('permission', array());
        $data['rows'] = $this->lib_mod->load_all('permission', '', array(), $per_page, $this->uri->segment(3), array('id'=>'asc'));
        $base_url               = site_url('permission/index/');
        $config['base_url']     = $base_url;
        $config['per_page']     = $per_page;
        $config['total_rows']   = $total;
        $config['uri_segment']  = 3;
        $this->pagination->initialize($config);
        $data['paging']         = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
		$data['content']	= 'permission/index';
        $this->load->view('template', $data);
	}


	function update($id=0)
	{		
		if($id) $module = 'edit_permission'; else $module = 'add_permission';

        if(!$this->lib_mod->check_permission($module))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'permission/index"</script>';
            exit;
        }

		$edit = $this->input->post('edit');
		if(!empty($edit))
		{	
			$permission = $this->input->post('permission');
			$permission = implode('#', $permission);

			$data = array(
				'name' => $this->input->post('name'),
				'permission' => $permission,
				'admin_id' => $this->admin_id,
				'createdate' => time(),
				'description' => $this->input->post('description'),
			);

			$search = $this->lib_mod->make_url($data['name']);
            $data['search'] = str_replace('-', ' ', $search);

			if($id)
			{
                $data['search'] .= ' '.$id;					
				$this->lib_mod->update('permission', array('id'=>$id), $data);
				$action = 'Cập nhật bản ghi "' . $data['name'] . '" module Nhóm quyền';
                $this->lib_mod->insert_log($action);
	            $this->session->set_flashdata('success', $action . ' thành công.');
			}
			else
			{
                $data['status'] = 1;					
				$this->lib_mod->insert('permission', $data);
				$action = 'Thêm mới bản ghi "' . $data['name'] . '" module Nhóm quyền';
                $this->lib_mod->insert_log($action);
	            $this->session->set_flashdata('success', $action . ' thành công.');
			}
            redirect('permission/index');
		}
		
		$data['row'] = $this->lib_mod->detail('permission', array('id'=>$id));
		$per_arr = array();
		if(!empty($data['row'][0]['permission']))
			$per_arr = array_filter(explode('#', $data['row'][0]['permission']));

		$data['id']	= $id;
		$data['per_arr'] = $per_arr;
		$data['content'] = 'permission/update';
		$data['header'] = 'edit_base_header';
        $data['footer'] = 'edit_base_footer';
        $this->load->view('template', $data);
	}


	function status($id, $status)
	{
		if(!$this->lib_mod->check_permission('edit_permission'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }

		if($id==35) redirect(site_url().'admin');
		
		if($status)
			$status = 0;
		else
			$status = 1;

        $data = $this->lib_mod->detail('permission', array("id"=>$id));      

		if(isset($data[0]))
		{
			$this->lib_mod->update('permission', array('id'=>$id), array('status'=>$status));
			$action = 'Cập nhật bản ghi "' . $data[0]['name'] . '" module Nhóm quyền';
            $this->lib_mod->insert_log($action);
            $this->session->set_flashdata('success', $action . ' thành công.');
		}
		else
		{
            $this->session->set_flashdata('error', 'Lỗi không xác định được bản ghi để cập nhật');
		}
       
        redirect('permission/index');
	}


	function delete($items_id=array())
	{
		if(!$this->lib_mod->check_permission('del_permission'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
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
            	$detail = $this->lib_mod->detail('permission', array("id"=>$id));      
                if($this->lib_mod->count('admin', array("permission_id"=>$id)))
                {
                	$name_not_del .= $detail[0]['name'] . ', ';
                }
                else
                {
                	$name_del .= $detail[0]['name'] . ', ';
                	$this->lib_mod->delete('permission', array("id"=>$id));
                }	                
            }

            if(!empty($name_not_del))
        		$this->session->set_flashdata('error', 'Bản ghi "' . $name_not_del . '" đang được sử dụng bạn không được phép xóa');

            if(!empty($name_del))
            {
	            $action = 'Xóa bản ghi "' . $name_del . '" module Nhóm quyền';
                $this->lib_mod->insert_log($action);
	            $this->session->set_flashdata('success', $action . ' thành công.');
            }
        }
        else
        {
        	$this->session->set_flashdata('error', 'Bạn phải chọn ít nhất một bản ghi cần xóa.');
        }
        redirect('permission/index');
	}


	function search()
    {       
    	if(!$this->lib_mod->check_permission('view_permission'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }

        $key_word = $this->lib_mod->make_url(trim($this->input->post('key_word')));
        if(empty($key_word)) $key_word = 'empty';
        $status = $this->input->post('status');
        $search = array('key_word'=>$key_word, 'status'=>$status);        
        $param = $this->uri->assoc_to_uri($search);
        $param = str_replace('//','/0/',$param);
        redirect('permission/result_search/'.$param);
    }

    function result_search()
    {
        $this->load->model('search_mod', 'search_mod');

        $result = $this->uri->segment_array();

        if (!isset($result[4]) || !isset($result[6]))
        {
            redirect('permission/index');
        }
        else
        {           
            $data['key_word'] = $key_word = $result[4];           
            $data['status'] = $status = $result[6];           

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
            $total                  = $this->search_mod->count_permission($key_word, $status);
            $data['rows']      = $this->search_mod->load_permission($key_word, $status, $per_page, $offset);

            $base_url                   = site_url('permission/result_search/key_word/'.$key_word.'/status/'.$status.'/');                                   
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
            $data['content']    = 'permission/index';
            $this->load->view('template', $data);
        }
    }
}
