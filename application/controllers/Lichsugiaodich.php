<?php

class Lichsugiaodich extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if (!isset($this->admin_id) || empty($this->admin_id)) {
            redirect('home/login');
        }
    }

    function lichsunapthe() {
         if ( $this->admin_id !=35 &&  $this->admin_id !=38 && $this->admin_id !=36) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        //if($this->input->post("date1")!= '') 

        $this->load->library('pagination');
        $per_page = 10;
        $session_per_page = $this->session->userdata('session_per_page');
        if (isset($session_per_page) && $session_per_page > 0)
            $per_page = $session_per_page;

        $total = $this->lib_mod->count('lichsunapthe', array());
        $data['rows'] = $this->lib_mod->load_all('lichsunapthe', '', array(), $per_page, $this->uri->segment(3), array('id' => 'desc'));
        $base_url = site_url('lichsugiaodich/lichsunapthe/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'lichsugiaodich/lichsunapthe';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
    }

    function search() {
        if ( $this->admin_id !=35 &&  $this->admin_id !=38 && $this->admin_id !=36) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        $this->load->library('pagination');
        $per_page = 10000;
        $session_per_page = $this->session->userdata('session_per_page');
        if (isset($session_per_page) && $session_per_page > 0)
            $per_page = $session_per_page;

        $date1 = $this->input->post("date1");
        $date2 = $this->input->post("date2");
        if ($date2 > 0 && $date1 > 0) {
            if ($date2 == $date1) $date2 = $date1 + 86400;
            $data['date1']=$date1;
            $data['date2']=$date2;
            $where['ngaynap >='] = $date1;
            $where['ngaynap <='] = $date2;
        }

        $this->load->model('search_mod', 'search_mod');
        $key_word = $this->input->post('key_word');
        if($key_word!='') {$data['key_word']=$key_word;
        $notWhereArr = $this->search_mod->search_transaction($key_word);}
        $this->db->select('*');
        if(isset($where)){
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        }
         if(isset($notWhereArr)){
        foreach ($notWhereArr as $key => $value) {
            $this->db->where($key, $value);
        }
         }
         $this->db->limit($per_page,  $this->uri->segment(3));
         $this->db->order_by("id","desc");
       $data['rows'] =  $this->db->get("lichsunapthe")->result_array();
$result = $data['rows'];

        $total = count($result);
        $base_url = site_url('lichsugiaodich/search/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'lichsugiaodich/lichsunapthe';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);



//      echo '<pre>';
//      print_r($result);
    }

}
