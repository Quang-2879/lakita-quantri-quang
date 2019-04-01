<?php 
//------------------------
// project : omegamart
// coder: acetiendung
// time : 14/12/2011
//------------------------
class Video extends CI_Controller
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
        if(!$this->lib_mod->check_permission('view_video'))
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

        $total                  = $this->lib_mod->count('video', array());
        $data['rows'] = $this->lib_mod->load_all('video', '', array(), $per_page, $this->uri->segment(3), array('id'=>'desc'));
        $base_url               = site_url('video/index/');
        $config['base_url']     = $base_url;
        $config['per_page']     = $per_page;
        $config['total_rows']   = $total;
        $config['uri_segment']  = 3;
        $this->pagination->initialize($config);
        $data['paging']         = $this->pagination->create_links();
        $data['total'] = $total;
		$data['header']   = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content']    = 'video/index';
        $data['parent_cate'] = $this->lib_mod->load_all('category_3s', 'id, name', array('status'=>1, 'type_id'=>4, 'parent'=>0), '', '', array('sort'=>'desc'));
        foreach ($data['parent_cate'] as $key => $value) 
        {
            $data['child_cate'][$key] = $this->lib_mod->load_all('category_3s', 'id, name', array('status'=>1, 'type_id'=>4, 'parent'=>$value['id']), '', '', array('sort'=>'desc'));            
        }
        $this->load->view('template', $data);
	}


	function update($id=0)
	{		
        if($id) $module = 'edit_video'; else $module = 'add_video';

        if(!$this->lib_mod->check_permission($module))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'video/index"</script>';
            exit;
        }

        $config = $this->lib_mod->detail('setting', array('id'=>1)); 
        $targ_w = 0;
        $targ_h = 0;
        $ratio = 1;
        $big_size = '504x284';
        $size_video_other = '';
        if(!empty($config[0]['size_video_big']))
        {
            $big_size = $config[0]['size_video_big'];
            $size_video_other = $config[0]['size_video_other'];
        }   

        $arr_big_size = explode('x', $big_size);
        if(isset($arr_big_size[0]) && isset($arr_big_size[1]))                
        {
            $targ_w = intval($arr_big_size[0]);
            $targ_h = intval($arr_big_size[1]);
            $data['ratio'] = $targ_w / $targ_h;
        } 


		$edit = $this->input->post('edit');
	
    	if(!empty($edit))
		{	
            $att_name = $this->input->post('att_name');
            $att_description = $this->input->post('att_description');
            $attach_file = '';
            $attach_desc = '';
            if(!empty($att_name))
            {            
                $attach_file = implode('@', $att_name);
                $attach_file = str_replace(WEBSITE, '', $attach_file);
            }
            if(!empty($att_description))
            {
                $attach_desc = implode('@', $att_description);
            }

            $name = trim($this->input->post('name'));
            $title = trim($this->input->post('title'));
            $thumbnail = trim($this->input->post('thumbnail'));
            $meta_keywords = trim($this->input->post('meta_keywords'));
			$tag = trim($this->input->post('tag'));
            
            $category = $this->input->post('category'); 

            if(empty($category))
            {
                $menu_id = $menu_parent = 0;                
            }
            else
            {                
                $cate_label = substr($category, 0, 1);
                $cate_id = str_replace($cate_label, '', $category);
            
                if($cate_label=='p')
                {
                    $menu_parent = $cate_id;
                    $menu_id = 0;
                }
                else
                {
                    $menu_child = $this->lib_mod->detail('category_3s', array('id'=>$cate_id, 'status'=>1));
                    if(isset($menu_child[0]))
                        $menu_parent = $menu_child[0]['parent'];
                    else
                        $menu_parent = 0;

                    $menu_id = $cate_id;
                }
            }

            $data = array(
                'name'   => $name,
                'title'   => $title,
                'attach_file'   => $attach_file,
                'attach_desc'   => $attach_desc,
                'meta_keywords'   => $meta_keywords,
                'tag'   => $tag,
                'create_date' => time(), 
                'menu_id'   => $menu_id,
                'menu_parent'   => $menu_parent,
                'video_file'   => trim($this->input->post('video_file')),
                'slug'   => trim($this->input->post('slug')),
                'hot' => $this->input->post('hot')==1?1:0,
                'status' => $this->input->post('status')==1?1:0,
                'description'   => trim($this->input->post('description')),
                'meta_description'   => trim($this->input->post('meta_description')),
                'content'   => trim($this->input->post('content')),
                'admin_id_add'   => $this->admin_id,
                'time_release'   => strtotime($this->input->post('time_release')),
            );            

            $search = $this->lib_mod->make_url($name .' ' . $title .' ' . $meta_keywords .' ' . $tag .' ' . $id);
                
            $data['search'] = str_replace('-', ' ', $search);            
            //
            if(!empty($thumbnail))
            {              
                $crop_x = intval(trim($this->input->post('crop_x'))); 
                $crop_y = intval(trim($this->input->post('crop_y'))); 
                $crop_w = intval(trim($this->input->post('crop_w'))); 
                $crop_h = intval(trim($this->input->post('crop_h'))); 
                $jpeg_quality = 100;               
                $path_default = UPLOAD.'data/source/video/';
                $path_big_size = $path_default.$big_size.'/';
                $this->lib_mod->make_dir($path_big_size);
               
                $path = pathinfo($thumbnail);
                $type = $path['extension'];
                $new_filename = $this->lib_mod->make_url($path['filename']).'-'.time().'.'.$type;                
                
                $image_root = str_replace(WEBSITE, '', $thumbnail);
                $src_root = str_replace(WEBSITE, UPLOAD, $thumbnail);
             
                $img_root = imagecreatefromjpeg($src_root);

                $dst_root = ImageCreateTrueColor($targ_w, $targ_h);

                imagecopyresampled($dst_root, $img_root, 0, 0, $crop_x, $crop_y, $targ_w, $targ_h, $crop_w, $crop_h);                

                /*header('Content-type: image/jpeg');
                imagejpeg($dst_root,null,$jpeg_quality);*/

                switch($type)
                {
                    case 'bmp': imagewbmp($dst_root, $path_big_size.$new_filename, $jpeg_quality); break;
                    case 'gif': imagegif($dst_root, $path_big_size.$new_filename, $jpeg_quality); break;
                    case 'jpg': imagejpeg($dst_root, $path_big_size.$new_filename, $jpeg_quality); break;
                    case 'jpeg': imagejpeg($dst_root, $path_big_size.$new_filename, $jpeg_quality); break;
                    case 'png': imagepng($dst_root, $path_big_size.$new_filename, $jpeg_quality); break;
                    default : return "Không hỗ trợ định dạng ảnh này";
                }

                if(is_file($path_big_size.$new_filename) && !empty($size_video_other))
                {
                    $this->load->library('image_lib');
                    $arr_size_video_other = explode(',', $size_video_other);            
                    foreach ($arr_size_video_other as $key => $value) 
                    {
                        $arr_value = explode('x', $value);
                        if(isset($arr_value[0]) && isset($arr_value[1]))                
                        {
                            $width = intval($arr_value[0]);
                            $height = intval($arr_value[1]);
                            $path_new = $path_default.$value.'/';
                            $this->lib_mod->make_dir($path_new);
                            $this->image_lib->create_thumb($new_filename, $path_big_size, $path_new, $width, $height, TRUE, 0);
                        }
                    }
                }
                $data['image_share'] = str_replace(UPLOAD, '', $path_big_size.$new_filename);
                $data['image_root'] = $image_root;
                $data['thumbnail'] = $new_filename;
            }

            if($id)
            {
                $data['search'] .= ' '.$id;                 
                $this->lib_mod->update('video', array('id'=>$id), $data);
                $action = 'Cập nhật album "' . $data['name'] . '"';
                $this->lib_mod->insert_log($action);
                $this->session->set_flashdata('success', $action . ' thành công.');
            }
            else
            {
                $this->lib_mod->insert('video', $data);
                $action = 'Thêm mới album "' . $data['name'] . '"';
                $this->lib_mod->insert_log($action);
                $this->session->set_flashdata('success', $action . ' thành công.');
            }
            redirect('video/index');
		}
		
        $data['parent_cate'] = $this->lib_mod->load_all('category_3s', 'id, name', array('status'=>1, 'type_id'=>4, 'parent'=>0), '', '', array('sort'=>'desc'));
        foreach ($data['parent_cate'] as $key => $value) 
        {
            $data['child_cate'][$key] = $this->lib_mod->load_all('category_3s', 'id, name', array('status'=>1, 'type_id'=>4, 'parent'=>$value['id']), '', '', array('sort'=>'desc'));            
        }

		$data['row'] = $this->lib_mod->detail('video', array('id'=>$id));
		$data['id']	= $id;
		$data['content']	= 'video/update';
		$data['header']   = 'edit_adv_header';
        $data['uploadify']  = '1';
        $data['footer'] = 'edit_adv_footer';
        $this->load->view('template', $data);
	}

    
    function myupload()
    {
        $targetPath = UPLOAD.'data/source/video_source/'.date('Y/m/d');
        $this->lib_mod->make_dir($targetPath);
        $token_input = $this->input->post('token');
        $token = $token_input.'AceTienDung';
        $verifyToken = $this->input->post('verifyToken');
        if (!empty($_FILES) && $token == $verifyToken) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $extend = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
            $nice_name = $this->lib_mod->make_url($_FILES['Filedata']['name']).'-'.time().'.'.$extend;
            $targetFile = rtrim($targetPath,'/') . '/' . $nice_name;
            
            // Validate the file type
            $fileTypes = array('flv', 'mp4', 'avi'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            
            if (in_array($fileParts['extension'], $fileTypes)) 
            {
                move_uploaded_file($tempFile, $targetFile);
                echo str_replace(UPLOAD, '', $targetFile);
            } 
            else 
            {
                echo '0';
            }
        }
    }


	function status($id, $status)
	{
        if(!$this->lib_mod->check_permission('edit_video'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'video/index"</script>';
            exit;
        }

		if($id==35) redirect(site_url().'video');
		
		if($status)
			$status = 0;
		else
			$status = 1;

        $data = $this->lib_mod->detail('video', array("id"=>$id));      

		if(isset($data[0]))
		{
			$this->lib_mod->update('video', array('id'=>$id), array('status'=>$status));
			$action = 'Cập nhật bản ghi "' . $data[0]['name'] . '" module album';
            $this->lib_mod->insert_log($action);
            $this->session->set_flashdata('success', $action . ' thành công.');
		}
		else
		{
            $this->session->set_flashdata('error', 'Lỗi không xác định được bản ghi để cập nhật');
		}
       
        redirect('video/index');
	}


	function delete($items_id=array())
	{
		if(!$this->lib_mod->check_permission('del_video'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'video/index"</script>';
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
                    $detail = $this->lib_mod->detail('video', array("id"=>$id));      
                    $name_del .= $detail[0]['name'] . ', ';
                    $this->lib_mod->delete('video', array("id"=>$id));
                }
            }

            if(!empty($name_del))
            {
	            $action = 'Xóa bản ghi "' . $name_del . '" module album';
                $this->lib_mod->insert_log($action);
	            $this->session->set_flashdata('success', $action . ' thành công.');
            }
        }
        else
        {
        	$this->session->set_flashdata('error', 'Bạn phải chọn ít nhất một bản ghi cần xóa.');
        }

        redirect('video/index');
	}


    function search()
    {       
        $category = $this->input->post('category'); 
        if(empty($category))        
            $menu_id = 0;                
        else
            $menu_id = $category;                    

        if(!$this->lib_mod->check_permission('view_video'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }

        $key_word = $this->lib_mod->make_url(trim($this->input->post('key_word')));
        if(empty($key_word)) $key_word = 'empty';
        $status = $this->input->post('status');
        $search = array('key_word'=>$key_word, 'status'=>$status, 'category'=>$menu_id);        
        $param = $this->uri->assoc_to_uri($search);
        $param = str_replace('//','/0/',$param);
        redirect('video/result_search/'.$param);
    }
    

    function result_search()
    {
        $this->load->model('search_mod', 'search_mod');

        $result = $this->uri->segment_array();

        if (!isset($result[4]) || !isset($result[6]) || !isset($result[8]))
        {
            redirect('video/index');
        }
        else
        {           
            $data['key_word'] = $key_word = $result[4];           
            $data['status'] = $status = $result[6];           
            $data['category'] = $category = $menu_parent = $menu_id = $result[8];      

            if($category!='0')
            {
                $cate_label = substr($category, 0, 1);
                $cate_id = str_replace($cate_label, '', $category);
            
                if($cate_label=='p')
                {
                    $menu_parent = $data['pid'] = $cate_id;
                    $menu_id = 0;
                }
                else
                {
                    $menu_parent = 0;
                    $menu_id = $data['cid'] = $cate_id;
                }
            }

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
            $total                  = $this->search_mod->count_video($key_word, $status, $menu_id, $menu_parent);
            $data['rows']      = $this->search_mod->load_video($key_word, $status, $menu_id, $menu_parent, $per_page, $offset);

            $base_url                   = site_url('video/result_search/key_word/'.$key_word.'/status/'.$status.'/category/'.$category.'/');                                   
            $config['base_url']         = $base_url;
            $config['per_page']         = $per_page;    
            $config['total_rows']       = $total;
            $config['uri_segment']      = 9;                        
            $this->pagination->initialize($config); 
            $data['paging']         = $this->pagination->create_links();     
            $data['total'] = $total;
            $data['is_search'] = 1;
            $data['header']   = 'list_base_header';
            $data['footer'] = 'list_base_footer';
            $data['content']    = 'video/index';

            $data['parent_cate'] = $this->lib_mod->load_all('category_3s', 'id, name', array('status'=>1, 'type_id'=>4, 'parent'=>0), '', '', array('sort'=>'desc'));
            foreach ($data['parent_cate'] as $key => $value) 
            {
                $data['child_cate'][$key] = $this->lib_mod->load_all('category_3s', 'id, name', array('status'=>1, 'type_id'=>4, 'parent'=>$value['id']), '', '', array('sort'=>'desc'));            
            }
            $this->load->view('template', $data);
        }
    }
}
