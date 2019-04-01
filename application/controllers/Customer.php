<?php 
//------------------------
// project : omegamart
// coder: acetiendung
// time : 14/12/2011
//------------------------
class Customer extends CI_Controller
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
        if(!$this->lib_mod->check_permission('view_customer'))
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

        $total                  = $this->lib_mod->count('customer', array());
        $data['rows'] = $this->lib_mod->load_all('customer', '', array(), $per_page, $this->uri->segment(3), array('id'=>'desc'));
        $base_url               = site_url('customer/index/');
        $config['base_url']     = $base_url;
        $config['per_page']     = $per_page;
        $config['total_rows']   = $total;
        $config['uri_segment']  = 3;
        $this->pagination->initialize($config);
        $data['paging']         = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content']    = 'customer/index';
        $this->load->view('template', $data);
    }


    function view($id=0)
    {
        if(!$this->lib_mod->check_permission('view_customer'))
        {
            header('Content-Type: text/html; charset=utf-8');            
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }
        
        $data['customer'] = $this->lib_mod->detail('customer', array("id"=>$id));          
        $data['content']    = 'customer/profile';
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $this->load->view('template', $data);
    }


    function update($id=0)
    {       
        if($id) $module = 'edit_customer'; else $module = 'add_customer';

        if(!$this->lib_mod->check_permission($module))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'customer/index"</script>';
            exit;
        }

        if($id==35) redirect(site_url().'customer');

        $edit = $this->input->post('edit');
        if(!empty($edit))
        {   
            $name = trim($this->input->post('name'));
            
            $email = trim($this->input->post('email'));

            $phone = trim($this->input->post('phone'));

            $address = trim($this->input->post('address'));

            $condition = array('email'=>$email);
            if($id) $condition = array("id !="=>$id, 'email'=>$email);

            $email_exist = $this->lib_mod->count('customer', $condition);

            $error = '';

            if($email_exist)
                $error = 'Email đã tồn tại';
            
            $data = array(
                'name'   => $name,
                'email'   => $email,
                'phone'   => $phone,
                'create_id' => $this->admin_id,
                'createdate' => time(), 
                'address'   => $address,
                'service'   => $this->input->post('service'),
                'note'   => trim($this->input->post('note')),
            );            
          
            if(empty($error))
            {
                $search = $this->lib_mod->make_url($name  .' ' . $email .' ' . $phone .' ' . $address);
                
                $data['search'] = str_replace('-', ' ', $search);

                if(!empty($_FILES['thumbnail']['name']))
                {
                    $image_news_path = realpath(APPPATH. "../data/avatar");
                    $image_thumb = $this->lib_mod->action_upload($image_news_path, 'thumbnail');
                    $data['thumbnail'] = 'data/avatar/'.$image_thumb['file_name'];
                }

                if($id)
                {
                    $data['search'] .= ' '.$id;                 
                    $this->lib_mod->update('customer', array('id'=>$id), $data);
                    $action = 'Cập nhật Khách hàng "' . $data['name'] . '"';
                    $this->lib_mod->insert_log($action);
                    $this->session->set_flashdata('success', $action . ' thành công.');
                }
                else
                {
                    $data['status'] = 1;
                    $this->lib_mod->insert('customer', $data);
                    $action = 'Thêm mới Khách hàng "' . $data['name'] . '"';
                    $this->lib_mod->insert_log($action);
                    $this->session->set_flashdata('success', $action . ' thành công.');
                }
                redirect('customer/index');
            }
            else
            {
                $this->session->set_flashdata('error', $error);
                redirect('customer/update/'.$id);
            }
        }
        
        $data['permission'] = $this->lib_mod->load_all('permission', '', array('status'=>1), '', '', array('id'=>'asc'));
        $data['row'] = $this->lib_mod->detail('customer', array('id'=>$id));
        $data['id'] = $id;
        $data['content']    = 'customer/update';
        $data['header'] = 'edit_base_header';
        $data['footer'] = 'edit_base_footer';    
        $this->load->view('template', $data);
    }


    function status($id, $status)
    {
        if(!$this->lib_mod->check_permission('edit_customer'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'customer/index"</script>';
            exit;
        }

        if($id==35) redirect(site_url().'customer');
        
        if($status)
            $status = 0;
        else
            $status = 1;

        $data = $this->lib_mod->detail('customer', array("id"=>$id));      

        if(isset($data[0]))
        {
            $this->lib_mod->update('customer', array('id'=>$id), array('status'=>$status));
            $action = 'Cập nhật bản ghi "' . $data[0]['name'] . '" module Khách hàng';
            $this->lib_mod->insert_log($action);
            $this->session->set_flashdata('success', $action . ' thành công.');
        }
        else
        {
            $this->session->set_flashdata('error', 'Lỗi không xác định được bản ghi để cập nhật');
        }
       
        redirect('customer/index');
    }


    function delete($items_id=array())
    {
        if(!$this->lib_mod->check_permission('del_customer'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'customer/index"</script>';
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
                    $detail = $this->lib_mod->detail('customer', array("id"=>$id));      
                    $name_del .= $detail[0]['name'] . ', ';
                    $this->lib_mod->delete('customer', array("id"=>$id));
                }
            }

            if(!empty($name_del))
            {
                $action = 'Xóa bản ghi "' . $name_del . '" module Khách hàng';
                $this->lib_mod->insert_log($action);
                $this->session->set_flashdata('success', $action . ' thành công.');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'Bạn phải chọn ít nhất một bản ghi cần xóa.');
        }

        redirect('customer/index');
    }


    function search()
    {       
        if(!$this->lib_mod->check_permission('view_customer'))
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
        redirect('customer/result_search/'.$param);
    }
    

    function result_search()
    {
        $this->load->model('search_mod', 'search_mod');

        $result = $this->uri->segment_array();

        if (!isset($result[4]) || !isset($result[6]))
        {
            redirect('customer/index');
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
            $total                  = $this->search_mod->count_customer($key_word, $status);
            $data['rows']      = $this->search_mod->load_customer($key_word, $status, $per_page, $offset);

            $base_url                   = site_url('customer/result_search/key_word/'.$key_word.'/status/'.$status.'/');                                   
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
            $data['content']    = 'customer/index';
            $this->load->view('template', $data);
        }
    }
}
