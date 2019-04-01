

<?php

class Listpayment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if (!isset($this->admin_id) || empty($this->admin_id)) {
            redirect('home/login');
        }
    }

    function index() {
        if ( $this->admin_id !=35 &&  $this->admin_id !=36) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
         $data['success']=0;
        $data['courses'] = $this->lib_mod->load_all('courses', 'name, id', array(), '', '', '');
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'listpayment/index';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
    }

    function updateviabank() {
        if ( $this->admin_id !=35 &&  $this->admin_id !=36) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        $param['name'] = $this->input->post('name');
        $param['email'] = $this->input->post('email');
        $param['phone'] = $this->input->post('phone');
        $param['accountfrom'] = $this->input->post('accountfrom');
        $param['accountto'] = $this->input->post('accountto');
        $param['price'] = $this->input->post('amount');
        $param['time'] = $this->input->post('date1');
        $param['method'] = 'bank';
        $param['courseID'] = $this->input->post('courseSelected');
        if ($param['name'] != NULL) {
            $this->lib_mod->insert('purchase', $param);
            $data['success']=1;
        }
          $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'listpayment/index';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
    }

    function updateviadirect() {
        if ( $this->admin_id !=35 &&  $this->admin_id !=36) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        $param['name'] = $this->input->post('name');
        $param['email'] = $this->input->post('email');
        $param['phone'] = $this->input->post('phone');
        $param['dia_chi'] = $this->input->post('dia_chi');
        $param['price'] = $this->input->post('amount');
         $param['time'] = $this->input->post('date2');
        $param['method'] = 'direct';
        echo $param['courseID'] = $this->input->post('courseSelected2');
        if ($param['name'] != NULL) {
            $this->lib_mod->insert('purchase', $param);
            $data['success']=1;
        }
          $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'listpayment/index';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
    }
}
