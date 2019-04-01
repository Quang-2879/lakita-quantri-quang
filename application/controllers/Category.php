<?php 
//------------------------
// project : omegamart
// coder: acetiendung
// time : 14/12/2011
//------------------------
class Category extends CI_Controller
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
        if(!$this->lib_mod->check_permission('view_category'))
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

        $total                  = $this->lib_mod->count('category', array());
        $data['rows'] = $this->lib_mod->load_all('category', '', array(), $per_page, $this->uri->segment(3), array('id'=>'desc', 'parent'=>'desc'));
        $base_url               = site_url('category/index/');
        $config['base_url']     = $base_url;
        $config['per_page']     = $per_page;
        $config['total_rows']   = $total;
        $config['uri_segment']  = 3;
        $this->pagination->initialize($config);
        $data['paging']         = $this->pagination->create_links();
        $data['total'] = $total;
		$data['header']	= 'common/inc_list_header';
		$data['footer']	= 'common/inc_list_footer';
		$data['content']	= 'category/index';
        $this->load->view('template', $data);
	}


	function update($id=0)
	{		
        if($id) $module = 'edit_category'; else $module = 'add_category';

        if(!$this->lib_mod->check_permission($module))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'category/index"</script>';
            exit;
        }

        $edit = $this->input->post('edit');
		$save_edit = $this->input->post('save_edit');
		if(!empty($edit) || !empty($save_edit))
		{	
            $name = trim($this->input->post('name'));
            $condition = array('name'=>$name);
            if($id) $condition = array("id !="=>$id, 'name'=>$name);

       		$name_exist = $this->lib_mod->count('category', $condition);
            $error = '';
       		if($name_exist)
       			$error = 'Tên danh mục đã tồn tại';         
           
            if(empty($error))
            {
                $search = $this->lib_mod->make_url($name);

                $data = array(
                    'type_id' => $this->input->post('type_id'),
                    'name' => trim($this->input->post('name')),
                    'en_name' => trim($this->input->post('en_name')),
                    'hot' => $this->input->post('hot')==1?1:0,
                    'parent' => $this->input->post('parent'),
                    'status' => $this->input->post('status')==1?1:0,
                    'sort' => trim($this->input->post('sort')),
                    'create_date' => time(),
                    'slug' => trim($this->input->post('slug')),
                    'en_slug' =>trim( $this->input->post('en_slug')),
                    'description' => trim($this->input->post('description')),
                    'keyword' => trim($this->input->post('keyword')),
                    'en_description' => trim($this->input->post('en_description')),
                    'search' => str_replace('-', ' ', $search . ' ' . $this->input->post('slug')),
                );   

            	if(!empty($_FILES['image']['name']))
                {
                    $image_path = realpath(UPLOAD. "data/category");
                    $image_thumb = $this->lib_mod->action_upload($image_path, 'image');
                    $data['image'] = 'data/category/'.$image_thumb['file_name'];
                }

            	if($id)
				{
                    $data['search'] .= ' '.$id;					
					$this->lib_mod->update('category', array('id'=>$id), $data);
					$action = 'Cập nhật danh mục "' . $data['name'] . '"';
	                $this->lib_mod->insert_log($action);
		            $this->session->set_flashdata('success', $action . ' thành công.');
				}
				else 
				{
					$data['status'] = 1;
					$this->lib_mod->insert('category', $data);
					$action = 'Thêm mới danh mục "' . $data['name'] . '"';
	                $this->lib_mod->insert_log($action);
		            $this->session->set_flashdata('success', $action . ' thành công.');
				}
                
                if(!empty($save_edit))
                    redirect('category/update/0');

                if(!empty($edit))
    	            redirect('category/index');
        	}
            else
            {
                $this->session->set_flashdata('error', $error);
                redirect('category/update/'.$id);
            }
		}
		
        $data['category'] = $this->lib_mod->load_all('category', '', array('parent'=>0), '', '', array('id'=>'desc'));
		$data['row'] = $this->lib_mod->detail('category', array('id'=>$id));
		$data['id']	= $id;
		$data['content']	= 'category/update';
		$data['header']	= 'common/inc_edit_header';
		$data['footer']	= 'common/inc_edit_footer';
        $this->load->view('template', $data);
	}


	function status($id, $status)
	{
        if(!$this->lib_mod->check_permission('edit_category'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'category/index"</script>';
            exit;
        }

		if($id==35) redirect(site_url().'category');
		
		if($status)
			$status = 0;
		else
			$status = 1;

        $data = $this->lib_mod->detail('category', array("id"=>$id));      

		if(isset($data[0]))
		{
			$this->lib_mod->update('category', array('id'=>$id), array('status'=>$status));
			$action = 'Cập nhật bản ghi "' . $data[0]['name'] . '" module Danh mục';
            $this->lib_mod->insert_log($action);
            $this->session->set_flashdata('success', $action . ' thành công.');
		}
		else
		{
            $this->session->set_flashdata('error', 'Lỗi không xác định được bản ghi để cập nhật');
		}
       
        redirect('category/index');
	}


	function delete($items_id=array())
	{
		if(!$this->lib_mod->check_permission('del_category'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'category/index"</script>';
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
                    $detail = $this->lib_mod->detail('category', array("id"=>$id));      
                    $name_del .= $detail[0]['name'] . ', ';
                    $this->lib_mod->delete('category', array("id"=>$id));
                }
            }

            if(!empty($name_del))
            {
	            $action = 'Xóa bản ghi "' . $name_del . '" module danh mục';
                $this->lib_mod->insert_log($action);
	            $this->session->set_flashdata('success', $action . ' thành công.');
            }
        }
        else
        {
        	$this->session->set_flashdata('error', 'Bạn phải chọn ít nhất một bản ghi cần xóa.');
        }

        redirect('category/index');
	}


    function search()
    {       
        if(!$this->lib_mod->check_permission('view_category'))
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
        redirect('category/result_search/'.$param);
    }
    

    function result_search()
    {
        $this->load->model('search_mod', 'search_mod');

        $result = $this->uri->segment_array();

        if (!isset($result[4]) || !isset($result[6]))
        {
            redirect('category/index');
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
            $total                  = $this->search_mod->count_category($key_word, $status);
            $data['rows']      = $this->search_mod->load_category($key_word, $status, $per_page, $offset);

            $base_url                   = site_url('category/result_search/key_word/'.$key_word.'/status/'.$status.'/');                                   
            $config['base_url']         = $base_url;
            $config['per_page']         = $per_page;    
            $config['total_rows']       = $total;
            $config['uri_segment']      = 7;                           
            $this->pagination->initialize($config); 
            $data['paging']         = $this->pagination->create_links();  
            $data['total'] = $total;
            $data['is_search'] = 1;
            $data['header'] = 'common/inc_list_header';
            $data['footer'] = 'common/inc_list_footer';
            $data['content']    = 'category/index';
            $this->load->view('template', $data);
        }
    }
}
