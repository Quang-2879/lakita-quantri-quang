<?php 
//------------------------
// project : omegamart
// coder: acetiendung
// time : 14/12/2011
//------------------------
class Chapter extends CI_Controller
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
        if( $this->admin_id  != 35 &&  $this->admin_id !=37)
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

        $total                  = $this->lib_mod->count('chapter', array());
        $data['rows'] = $this->lib_mod->load_all('chapter', '', array(), $per_page, $this->uri->segment(3), array('id'=>'desc', 'parent'=>'desc'));
        $base_url               = site_url('chapter/index/');
        $config['base_url']     = $base_url;
        $config['per_page']     = $per_page;
        $config['total_rows']   = $total;
        $config['uri_segment']  = 3;
        $this->pagination->initialize($config);
        $data['paging']         = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
		$data['content']	= 'chapter/index';
        $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
	}


	function update($id=0)
	{		
        if($id) $module = 'edit_chapter'; else $module = 'add_chapter';

        if( $this->admin_id  != 35 &&  $this->admin_id !=37)
        {
            header('Content-Type: text/html; charset=utf-8');            
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }

        $edit = $this->input->post('edit');
		$save_edit = $this->input->post('save_edit');
		if(!empty($edit) || !empty($save_edit))
		{	
            $name = trim($this->input->post('name'));
            $condition = array('name'=>$name);
            if($id) $condition = array("id !="=>$id, 'name'=>$name,'courses_id'=>$this->input->post('courses_id'));

       		$name_exist = $this->lib_mod->count('chapter', $condition);
            $error = '';
       		if($name_exist)
       			$error = 'Tên chương đã tồn tại';         
           
            if(empty($error))
            {
                $search = $this->lib_mod->make_url($name);

                $data = array(
                    'courses_id' => $this->input->post('courses_id'),
                    'name' => trim($this->input->post('name')),
                    'en_name' => trim($this->input->post('en_name')),
                    'hot' => $this->input->post('hot')==1?1:0,
                    'parent' => 0,
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
                    $image_path = realpath(UPLOAD. "data/source/chapter");
                    $image_thumb = $this->lib_mod->action_upload($image_path, 'image');
                    $data['image'] = 'data/source/chapter/'.$image_thumb['file_name'];
                }

            	if($id)
				{
                    $data['search'] .= ' '.$id;					
					$this->lib_mod->update('chapter', array('id'=>$id), $data);
					$action = 'Cập nhật chương "' . $data['name'] . '"';
	                $this->lib_mod->insert_log($action);
		            $this->session->set_flashdata('success', $action . ' thành công.');
				}
				else 
				{
					$data['status'] = 1;
					$this->lib_mod->insert('chapter', $data);
					$action = 'Thêm mới chương "' . $data['name'] . '"';
	                $this->lib_mod->insert_log($action);
		            $this->session->set_flashdata('success', $action . ' thành công.');
				}
                
                if(!empty($save_edit))
                    redirect('chapter/update/0');

                if(!empty($edit))
    	            redirect($this->session->userdata('curr_segment_chapter'));
        	}
            else
            {
                $this->session->set_flashdata('error', $error);
                redirect('chapter/update/'.$id);
            }
		}
		
        $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
		$data['row'] = $this->lib_mod->detail('chapter', array('id'=>$id));
		$data['id']	= $id;
		$data['content']	= 'chapter/update';
		$data['header'] = 'edit_base_header';
        $data['footer'] = 'edit_base_footer'; 
        $this->load->view('template', $data);
	}


	function status($id, $status)
	{
        if( $this->admin_id  != 35 &&  $this->admin_id !=37)
        {
            header('Content-Type: text/html; charset=utf-8');            
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }

		if($id==35) redirect(site_url().'chapter');
		
		if($status)
			$status = 0;
		else
			$status = 1;

        $data = $this->lib_mod->detail('chapter', array("id"=>$id));      

		if(isset($data[0]))
		{
			$this->lib_mod->update('chapter', array('id'=>$id), array('status'=>$status));
			$action = 'Cập nhật bản ghi "' . $data[0]['name'] . '" module chương';
            $this->lib_mod->insert_log($action);
            $this->session->set_flashdata('success', $action . ' thành công.');
		}
		else
		{
            $this->session->set_flashdata('error', 'Lỗi không xác định được bản ghi để cập nhật');
		}
       
        redirect($this->session->userdata('curr_segment_chapter'));
	}


	function delete($items_id=array())
	{
		 if( $this->admin_id  != 35 &&  $this->admin_id !=37)
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
                if($id!=35)
                {
                    $detail = $this->lib_mod->detail('chapter', array("id"=>$id));      
                    $name_del .= $detail[0]['name'] . ', ';
                    $this->lib_mod->delete('chapter', array("id"=>$id));
                }
            }

            if(!empty($name_del))
            {
	            $action = 'Xóa bản ghi "' . $name_del . '" module chương';
                $this->lib_mod->insert_log($action);
	            $this->session->set_flashdata('success', $action . ' thành công.');
            }
        }
        else
        {
        	$this->session->set_flashdata('error', 'Bạn phải chọn ít nhất một bản ghi cần xóa.');
        }

        redirect($this->session->userdata('curr_segment_chapter'));
	}


    function search()
    {       
        $courses_id = $this->input->post('courses_id'); 
        if(empty($courses_id))        
            $courses_id = 0;                
        else
            $courses_id = $courses_id;                    

      if( $this->admin_id  != 35 &&  $this->admin_id !=37)
        {
            header('Content-Type: text/html; charset=utf-8');            
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }

        $key_word = $this->lib_mod->make_url(trim($this->input->post('key_word')));
        if(empty($key_word)) $key_word = 'empty';
        $status = $this->input->post('status');
        $search = array('key_word'=>$key_word, 'status'=>$status, 'courses_id'=>$courses_id);        
        $param = $this->uri->assoc_to_uri($search);
        $param = str_replace('//','/0/',$param);
        redirect('chapter/result_search/'.$param);
    }
    

    function result_search()
    {
        $this->load->model('search_mod', 'search_mod');

        $result = $this->uri->segment_array();

        if (!isset($result[4]) || !isset($result[6]) || !isset($result[8]))
        {
            redirect('chapter/index');
        }
        else
        {           
            $data['key_word'] = $key_word = $result[4];           
            $data['status'] = $status = $result[6];           
            $data['courses_id'] = $courses_id = $result[8];      
            $this->load->library('pagination');
            $per_page                   = 10;
            $session_per_page = $this->session->userdata('session_per_page');
            if(isset($session_per_page) && $session_per_page>0)
                $per_page = $session_per_page;

            if ($this->uri->segment(9) == null || $this->uri->segment(9) == 1){           
                $offset = 0;    
            }else{
                $offset = $this->uri->segment(9);   
            }   
            $total                  = $this->search_mod->count_chapter($key_word, $status, $courses_id);
            $data['rows']      = $this->search_mod->load_chapter($key_word, $status, $courses_id, $per_page, $offset);

            $base_url                   = site_url('chapter/result_search/key_word/'.$key_word.'/status/'.$status.'/courses_id/'.$courses_id.'/');                                   
            $config['base_url']         = $base_url;
            $config['per_page']         = $per_page;    
            $config['total_rows']       = $total;
            $config['uri_segment']      = 9;                          
            $this->pagination->initialize($config); 
            $data['paging']         = $this->pagination->create_links();   
            $data['total'] = $total;
            $data['is_search'] = 1;
            $data['header'] = 'list_base_header';
            $data['footer'] = 'list_base_footer';
            $data['content']    = 'chapter/index';

            $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));           
            $this->load->view('template', $data);
        }
    }
}
