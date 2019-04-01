<?php

class Purchase extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if (!isset($this->admin_id) || empty($this->admin_id)) {
            redirect('home/login');
        }
    }

    function index() {
        if ( $this->admin_id !=35 &&  $this->admin_id !=38 && $this->admin_id !=36) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        $this->load->library('pagination');
        $per_page = 10;
        $session_per_page = $this->session->userdata('session_per_page');
        if (isset($session_per_page) && $session_per_page > 0)
            $per_page = $session_per_page;

        $total = $this->lib_mod->count('purchase', array());
        $data['rows'] = $this->lib_mod->load_all('purchase', '', array(), $per_page, $this->uri->segment(3), array('id' => 'desc'));
        $base_url = site_url('purchase/index/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['method']='all';
        $data['content'] = 'purchase/index';
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
        $per_page = 10;
        $session_per_page = $this->session->userdata('session_per_page');
        if (isset($session_per_page) && $session_per_page > 0)
            $per_page = $session_per_page;

        $method = $this->input->post('method');
        $where['method'] = $method;
        $data['method'] = $method;
        $this->load->model('search_mod', 'search_mod');
        $key_word = $this->input->post('key_word');
        $this->db->select('*');
        if (isset($where)) {
            if ($method != 'all') {
                foreach ($where as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
        }
        if ($key_word != '') {
              $data['key_word'] = $key_word;
            $this->db->like(array('email' => $key_word));
            $this->db->or_like(array('phone' => $key_word));
        }
        $this->db->limit($per_page, $this->uri->segment(3));
        $this->db->order_by("id", "desc");
        $data['rows'] = $this->db->get("purchase")->result_array();
        $result = $data['rows'];

        $total = count($result);
        $base_url = site_url('purchase/search/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'purchase/index';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
    }

    function delete($items_id = array()) {
        if (!$this->lib_mod->check_permission('del_purchase')) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . 'student/index"</script>';
            exit;
        }

        if (empty($items_id)) {
            $items_id = $this->input->post('items_id');
        } else {
            $items_id = array($items_id);
        }

        if (count($items_id)) {
            $name_not_del = '';
            $name_del = '';
            foreach ($items_id as $id) {
                $detail = $this->lib_mod->detail('purchase', array("id" => $id));
                $name_del .= $detail[0]['name'] . ', ';
                $this->lib_mod->delete('purchase', array("id" => $id));
            }

            if (!empty($name_del)) {
                $action = 'Xóa bản ghi "' . $name_del . '" module Khách hàng';
                $this->lib_mod->insert_log($action);
                $this->session->set_flashdata('success', $action . ' thành công.');
            }
        } else {
            $this->session->set_flashdata('error', 'Bạn phải chọn ít nhất một bản ghi cần xóa.');
        }

        redirect('purchase/index');
    }
     function userVoucher() {
        if ( $this->admin_id !=35 &&  $this->admin_id !=38 && $this->admin_id !=36) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        $this->load->library('pagination');
        $per_page = 10;
        $session_per_page = $this->session->userdata('session_per_page');
        if (isset($session_per_page) && $session_per_page > 0)
            $per_page = $session_per_page;

        $total = $this->lib_mod->count('use_voucher', array());
        $data['rows'] = $this->lib_mod->load_all('use_voucher', '', array(), $per_page, $this->uri->segment(3), array('id' => 'desc'));
        $base_url = site_url('purchase/userVoucher/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['method']='all';
        $data['content'] = 'purchase/userVoucher';
        // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status'=>1), '', '', array('sort'=>'desc'));
        $this->load->view('template', $data);
    }

}
