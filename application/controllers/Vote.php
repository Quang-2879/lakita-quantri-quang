<?php

class Vote extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if (!isset($this->admin_id) || empty($this->admin_id)) {
            redirect('home/login');
        }
    }

    function index() {
        $this->load->model('vote_model');
        $this->load->model('courses_model');
        if ($this->admin_id != 35 && $this->admin_id != 37) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        $this->load->library('pagination');
        $per_page         = 10;
        $session_per_page = $this->session->userdata('session_per_page');
        if (isset($session_per_page) && $session_per_page > 0)
            $per_page = $session_per_page;
        $total                 = count($this->vote_model->load_all(array()));
        $input = array();
        $input['limit'] = array($this->uri->segment(3),$per_page);
        $input['order']['id'] = 'desc';
        $data['rows']          = $this->vote_model->load_all($input);
        $base_url              = site_url('vote/index/');
        $config['base_url']    = $base_url;
        $config['per_page']    = $per_page;
        $config['total_rows']  = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging']  = $this->pagination->create_links();
        $data['total']   = $total;
        $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status' => 1), '', '', array('name' => 'asc'));
        $data['header']  = 'list_base_header';
        $data['footer']  = 'list_base_footer';
        $data['content'] = 'vote/index';
        $this->load->view('template', $data);
        
    }
    
    function status($id, $status) {
        if ($this->admin_id != 35 && $this->admin_id != 37) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        if ($id == 35)
            redirect(site_url() . 'vote');

        if ($status)
            $status = 0;
        else
            $status = 1;

        $data = $this->lib_mod->detail('vote', array("id" => $id));

        if (isset($data[0])) {
            $this->lib_mod->update('vote', array('id' => $id), array('is_hide' => $status));
            $action = 'Cập nhật bản ghi "' . $data[0]['name'] . '" module album';
            $this->lib_mod->insert_log($action);
            $this->session->set_flashdata('success', $action . ' thành công.');
        } else {
            $this->session->set_flashdata('error', 'Lỗi không xác định được bản ghi để cập nhật');
        }

        redirect($this->session->userdata('curr_segment_vote'));
    }
    
    function search() {
        $courses_id = $this->input->post('courses_id');
        if (empty($courses_id))
            $menu_id = 0;
        else
            $menu_id = $courses_id;

        if ($this->admin_id != 35 && $this->admin_id != 37) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        $key_word = $this->lib_mod->make_url(trim($this->input->post('key_word')));
        if (empty($key_word))
            $key_word = 'empty';
        $status = $this->input->post('status');
        $search = array('key_word' => $key_word, 'status' => $status, 'courses_id' => $menu_id);
        $param = $this->uri->assoc_to_uri($search);
        $param = str_replace('//', '/0/', $param);
        redirect('vote/result_search/' . $param);
    }

    function result_search() {
        $this->load->model('search_mod', 'search_mod');
        $this->load->model('courses_model');

        $result = $this->uri->segment_array();
        if (!isset($result[4]) || !isset($result[6]) || !isset($result[8])) {
            redirect('vote/index');
        } else {
            $data['key_word'] = $key_word = $result[4];
            $data['status'] = $status = $result[6];
            $data['courses_id'] = $courses_id = $menu_parent = $menu_id = $result[8];



//            if ($courses_id != '0') {
//                var_dump($courses_id);
//                $cate_label = substr($courses_id, 0, 1);
//                var_dump($cate_label);
//                die;
//                $cate_id = str_replace($cate_label, '', $courses_id);
//
//                if ($cate_label == 'p') {
//                    $menu_parent = $data['pid'] = $cate_id;
//                    $menu_id = 0;
//                } else {
//                    $menu_parent = 0;
//                    $menu_id = $data['cid'] = $cate_id;
//                }
//            }

            $this->load->library('pagination');
            $per_page = 10;
            $session_per_page = $this->session->userdata('session_per_page');
            if (isset($session_per_page) && $session_per_page > 0)
                $per_page = $session_per_page;

            if ($this->uri->segment(9) == null || $this->uri->segment(9) == 1) {
                $offset = 0;
            } else {
                $offset = $this->uri->segment(9);
            }
            $total = $this->search_mod->count_vote($key_word, $status, $courses_id);


            $data['rows'] = $this->search_mod->load_vote($key_word, $status, $courses_id, $per_page, $offset);




            $base_url = site_url('vote/result_search/key_word/' . $key_word . '/status/' . $status . '/courses_id/' . $courses_id . '/');
            $config['base_url'] = $base_url;
            $config['per_page'] = $per_page;
            $config['total_rows'] = $total;
            $config['uri_segment'] = 9;
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();
            $data['total'] = $total;
            $data['is_search'] = 1;
            $data['header'] = 'list_base_header';
            $data['footer'] = 'list_base_footer';
            $data['content'] = 'vote/index';
            $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status' => 1), '', '', array('sort' => 'desc'));
            $this->load->view('template', $data);
        }
    }

}
