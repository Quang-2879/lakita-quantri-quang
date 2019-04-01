<?php 
//------------------------
// project : omegamart
// coder: acetiendung
// time : 14/12/2011
//------------------------
class Log extends CI_Controller
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
        if(!$this->lib_mod->check_permission('view_log'))
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

        $total                  = $this->lib_mod->count('log', array());
        $data['rows'] = $this->lib_mod->load_all('log', '', array(), $per_page, $this->uri->segment(3), array('log_id'=>'desc'));
        $base_url               = site_url('log/index/');
        $config['base_url']     = $base_url;
        $config['per_page']     = $per_page;
        $config['total_rows']   = $total;
        $config['uri_segment']  = 3;
        $this->pagination->initialize($config);
        $data['paging']         = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content']    = 'log/index';
        $data['admin'] = $this->lib_mod->load_all('admin', 'admin_name, admin_id', array('admin_id !='=>35), '', '', array('admin_id'=>'desc'));
        $this->load->view('template', $data);
    }

    function view($id=0)
    {
        if(!$this->lib_mod->check_permission('view_log'))
        {
            header('Content-Type: text/html; charset=utf-8');            
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }
        
        $data['log'] = $this->lib_mod->detail('log', array("log_id"=>$id));      
        $data['customer'] = $this->lib_mod->detail('admin', array("admin_id"=>$data['log'][0]['admin_id']));      
        $data['content']    = 'log/detail';
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $this->load->view('template', $data);
    }

//    function delete($items_id=array())
//    {
//        if(!$this->lib_mod->check_permission('del_log'))
//        {
//            header('Content-Type: text/html; charset=utf-8');
//            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'log/index"</script>';
//            exit;
//        }
//
//        if(empty($items_id)) 
//        {
//            $items_id = $this->input->post('items_id');
//        }
//        else
//        {
//            $items_id = array($items_id);
//        }
//
//        if(count($items_id))
//        {
//            $name_not_del = '';
//            $name_del = '';
//            foreach ($items_id as $id) 
//            {       
//                $this->lib_mod->delete('log', array("log_id"=>$id));
//            }
//
//            $action = 'Xóa nhật ký hệ thống';
//            $this->lib_mod->insert_log($action);
//            $this->session->set_flashdata('success', $action . ' thành công.');
//        }
//        else
//        {
//            $this->session->set_flashdata('error', 'Bạn phải chọn ít nhất một bản ghi cần xóa.');
//        }
//
//        redirect('log/index');
//    }


    function search()
    {       
        if(!$this->lib_mod->check_permission('view_log'))
        {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }

        $key_word = $this->lib_mod->make_url(trim($this->input->post('key_word')));
        if(empty($key_word)) $key_word = 'empty';
        $admin_id = $this->input->post('admin_id');
        $search = array('key_word'=>$key_word, 'admin_id'=>$admin_id);        
        $param = $this->uri->assoc_to_uri($search);
        $param = str_replace('//','/0/',$param);
        redirect('log/result_search/'.$param);
    }
    

    function result_search()
    {
        $this->load->model('search_mod', 'search_mod');

        $result = $this->uri->segment_array();

        if (!isset($result[4]) || !isset($result[6]))
        {
            redirect('log/index');
        }
        else
        {           
            $data['key_word'] = $key_word = $result[4];           
            $data['admin_id'] = $admin_id = $result[6];           

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
            $total                  = $this->search_mod->count_log($key_word, $admin_id);
            $data['rows']      = $this->search_mod->load_log($key_word, $admin_id, $per_page, $offset);

            $base_url                   = site_url('log/result_search/key_word/'.$key_word.'/admin_id/'.$admin_id.'/');                                   
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
            $data['content']    = 'log/index';

            $config['base_url']     = $base_url;
            $config['per_page']     = $per_page;
            $config['total_rows']   = $total;
            $config['uri_segment']  = 7;
            $this->pagination->initialize($config);
            $data['paging']         = $this->pagination->create_links();
            $data['total'] = $total;


            $data['admin'] = $this->lib_mod->load_all('admin', 'admin_name, admin_id', array('admin_id !='=>35), '', '', array('admin_id'=>'desc'));
            $this->load->view('template', $data);
        }
    }
}
