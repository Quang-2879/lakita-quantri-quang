<?php

//------------------------
// project : omegamart
// coder: acetiendung
// time : 14/12/2011
//------------------------
class Student extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if (!isset($this->admin_id) || empty($this->admin_id)) {
            redirect('home/login');
        }
    }

    function index() {
        if ($this->admin_id != 35 && $this->admin_id != 38 && $this->admin_id != 41) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        $this->load->library('pagination');
        $per_page = 10;
        $session_per_page = $this->session->userdata('session_per_page');
        if (isset($session_per_page) && $session_per_page > 0)
            $per_page = $session_per_page;

        $total = $this->lib_mod->count('student', array());
        $data['rows'] = $this->lib_mod->load_all('student', '', array(), $per_page, $this->uri->segment(3), array('id' => 'desc'));
        $base_url = site_url('student/index/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'student/index';
        $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status' => 1), '', '', array('sort' => 'desc'));
        $this->load->view('template', $data);
    }

    function view($id = 0) {
        if ($this->admin_id != 35 && $this->admin_id != 38 && $this->admin_id != 41) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        $data['content'] = 'student/profile';
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['student_id'] = $id;
        $data['student'] = $this->lib_mod->detail('student', array("id" => $id));
        $data['list_courses'] = $this->lib_mod->load_all('student_courses', '', array('student_id' => $id), '', '', array('id' => 'desc'));
        foreach ($data['list_courses'] as $key => $value) {
            if ($value['trial_learn'] == 0) {
                $data['list_courses'][$key]['count_all_learn'] = count($this->lib_mod->detail('student_learn', array('student_id' => $id, 'courseID' => $value['courses_id'])));
            } else {
                $data['list_courses'][$key]['count_all_learn'] = 0;
            }
        }
        $this->load->view('template', $data);
    }

    function update_balance() {
        $post = $this->input->post();
        
        $this->load->model('student_courses_model');
        $this->load->model('student_model');
        $this->load->model('balance_change_model');
        $student_list = array();

        $input = array();
        $input['select'] = 'distinct(student_id)';
        $input['where_in'] = array('courses_id' => $post['courseID']);
        $student_list = $this->student_courses_model->load_all($input);
        
        foreach ($student_list as $s_key => $s_value) {
            $input = array();
            $input['select'] = 'balance';
            $input['where'] = array('id' => $s_value['student_id']);
            $old_balance = $this->student_model->load_all($input);

            $balance_from = $old_balance[0]['balance'];
            $balance_to = $balance_from + $post['balance_add'];

            $where = array('id' => $s_value['student_id']);
            $data = array('balance' => $balance_to);
            $this->student_model->update($where, $data);

            $data_bal = array();
            $data_bal['student_id'] = $s_value['student_id'];
            $data_bal['balance_from'] = $balance_from;
            $data_bal['balance_to'] = $balance_to;
            $data_bal['time'] = time();
            
            $this->balance_change_model->insert($data_bal);

        }
        echo '<script>alert("cập nhật danh sách thành công!"); </script>';
        echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }

    function update($id = 0) {
        // echo '<pre>';
        // print_r($this->input->post);
        // echo '<pre>';
        // die();
        $this->load->model('student_model');

        if ($this->admin_id != 35 && $this->admin_id != 41) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        if ($id)
            $module = 'edit_student';
        else
            $module = 'add_student';

        if (!$this->lib_mod->check_permission($module)) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . 'student/index"</script>';
            exit;
        }

        if ($id) {
            $list_courses = array();
            $list_courses1 = $this->lib_mod->load_all('student_courses', 'courses_id', array('student_id' => $id), '', '', array('id' => 'desc'));
            foreach ($list_courses1 as $key => $list) {
                $list_courses[] = $list['courses_id'];
            }
            $data['list_courses'] = $list_courses;
        } else {
            $data['list_courses'] = array();
        }

        $edit = $this->input->post('edit');
        if (!empty($edit)) {
            $error = '';
            $name = trim($this->input->post('name'));

            $email = trim($this->input->post('email'));

            $phone = trim($this->input->post('phone'));

            $address = trim($this->input->post('address'));

            $pass = trim($this->input->post('new_password'));
            $re_pass = trim($this->input->post('re_new_password'));
            if ($pass != '' && $re_pass != '') {
                if ($pass != $re_pass)
                    $error = 'Mật khẩu xác nhận không đúng';
                if (strlen($pass) < 6)
                    $error = 'Mật khẩu phải trên 6 kí tự';
            }
            $condition = array('email' => $email);
            if ($id)
                $condition = array("id !=" => $id, 'email' => $email);
            $email_exist = $this->lib_mod->count('student', $condition);
            if ($email_exist)
                $error = 'Email đã tồn tại';

            $data_stu = array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'createdate' => time(),
                'address' => $address,
                'status' => $this->input->post('status') == 1 ? 1 : 0,
                'gender' => $this->input->post('gender') == 1 ? 1 : 0,
                'is_tutor' => $this->input->post('is_tutor') == 1 ? 1 : 0,
                'is_exception' => $this->input->post('is_exception') == 1 ? 1 : 0,
                //'admin_id' => $this->admin_id,
                'note' => trim($this->input->post('note')),
                'birthday' => strtotime($this->input->post('birthday'))
            );

            if ($pass != '')
                $data_stu['password'] = md5(md5($pass));

            //$courses = array_filter($this->input->post('courses'));

            if (empty($error)) {
                $search = $this->lib_mod->make_url($name . ' ' . $email . ' ' . $phone . ' ' . $address);

                $data_stu['search'] = str_replace('-', ' ', $search);

                if (!empty($_FILES['thumbnail']['name'])) {
                    $image_news_path = realpath(UPLOAD . "data/source/student");
                    $image_thumb = $this->lib_mod->action_upload($image_news_path, 'thumbnail');
                    $data_stu['thumbnail'] = 'data/source/student/' . $image_thumb['file_name'];
                }

                if ($id) {
                    $input = array();
                    $input['select'] = 'balance';
                    $input['where']['id'] = $id;
                    $balance_from = $this->student_model->load_all($input);
                    $balance_to = $this->input->post('balance');
                    $balance_to = str_replace('_', '', $balance_to);
                    $balance_to = str_replace(' ', '', $balance_to);
                    $balance_to = str_replace('VND', '', $balance_to);
                    $balance_to = str_replace('.', '', $balance_to);

                    if (!empty($balance_from) && $balance_from[0]['balance'] != $balance_to) {
                        $data_stu['balance'] = $balance_to;
                        $this->load->model('balance_change_model');
                        $data_bal = array();
                        $data_bal['student_id'] = $id;
                        $data_bal['balance_from'] = $balance_from[0]['balance'];
                        $data_bal['balance_to'] = $balance_to;
                        $data_bal['time'] = time();
                        $this->balance_change_model->insert($data_bal);
                    }

                    $data_stu['search'] .= ' ' . $id;
                    $new_id = $id;
                    $this->lib_mod->update('student', array('id' => $id), $data_stu);
                    $action = 'Cập nhật Khách hàng "' . $data_stu['name'] . '"';
                    $this->lib_mod->insert_log($action);
                    $this->session->set_flashdata('success', $action . ' thành công.');
                } else {
                    $data_stu['status'] = 1;
                    $new_id = $this->lib_mod->insert_return_id('student', $data_stu, 'id');
                    $action = 'Thêm mới Khách hàng "' . $data_stu['name'] . '"';
                    $this->lib_mod->insert_log($action);
                    $this->session->set_flashdata('success', $action . ' thành công.');
                }

                //Thêm khóa học cho học viên
                $courses = array_filter($this->input->post('courses'));

                if ($id)
                    $courses = array_diff($courses, $list_courses);

                if (count($courses)) {
                    foreach ($courses as $key => $cour_id) {
                        $data_stu_cour = array(
                            'student_id' => $new_id,
                            'courses_id' => $cour_id,
                            //'admin_id' => $this->admin_id,
                            'status' => 1,
                            'create_date' => time(),
                        );

                        $this->lib_mod->insert('student_courses', $data_stu_cour);
                        $this->_send_id_lakita_to_crm($new_id, $cour_id);
                    }
                }

                redirect($this->session->userdata('curr_segment_student'));
            } else {
                $this->session->set_flashdata('error', $error);
                redirect('student/update/' . $id);
            }
        }

        $data['row'] = $this->lib_mod->detail('student', array('id' => $id));
        $data['id'] = $id;
        $data['content'] = 'student/update';
        $data['header'] = 'edit_adv_header';
        $data['footer'] = 'edit_adv_footer';
        $data['courses'] = $this->lib_mod->load_all('courses', 'id, name, course_code', array('status' => 1), '', '', array('sort' => 'desc'));

        $this->load->view('template', $data);
    }

    function status($id, $status) {
        if (!$this->lib_mod->check_permission('edit_student')) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . 'student/index"</script>';
            exit;
        }

        if ($status)
            $status = 0;
        else
            $status = 1;

        $data = $this->lib_mod->detail('student', array("id" => $id));

        if (isset($data[0])) {
            $this->lib_mod->update('student', array('id' => $id), array('status' => $status));
            $action = 'Cập nhật bản ghi "' . $data[0]['name'] . '" module Khách hàng';
            $this->lib_mod->insert_log($action);
            $this->session->set_flashdata('success', $action . ' thành công.');
        } else {
            $this->session->set_flashdata('error', 'Lỗi không xác định được bản ghi để cập nhật');
        }

        redirect($this->session->userdata('curr_segment_student'));
    }

    function delete($items_id = array()) {

        if ($this->admin_id != 35) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
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
                $detail = $this->lib_mod->detail('student', array("id" => $id));
                $name_del .= $detail[0]['name'] . ', ';
                $this->lib_mod->delete('student', array("id" => $id));
            }

            if (!empty($name_del)) {
                $action = 'Xóa bản ghi "' . $name_del . '" module Khách hàng';
                $this->lib_mod->insert_log($action);
                $this->session->set_flashdata('success', $action . ' thành công.');
            }
        } else {
            $this->session->set_flashdata('error', 'Bạn phải chọn ít nhất một bản ghi cần xóa.');
        }

        redirect($this->session->userdata('curr_segment_student'));
    }

    function search() {
        if ($this->admin_id != 35 && $this->admin_id != 38 && $this->admin_id != 41) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        $get = $this->input->get();
        if (!empty($get)) {
            $query = 'SELECT * FROM `tbl_student`';
            if ($get['name'] != '') {
                $query.= " WHERE `name` like '%" . $get['name'] . "%'";
            } else {
                $query.= " WHERE `name` like '/'";
            }
            if ($get['email'] != '') {
                $query.= " OR `email` like '%" . $get['email'] . "%'";
            } else {
                $query.= " OR `email` like '/'";
            }
            if ($get['phone'] != '') {
                $query.= " OR `phone` like '%" . $get['phone'] . "%'";
            } else {
                $query.= " OR `phone` like '/'";
            }
//            if ($get['name'] == '' && $get['email'] == '' && $get['phone'] == '') {
//                $query = 'SELECT * FROM `tbl_student`';
//            }
            $query .= 'ORDER BY `id` DESC';

            $query = $this->db->query($query);
            $data['rows'] = $query->result_array();
            $data['header'] = 'list_base_header';
            $data['footer'] = 'list_base_footer';
            $data['content'] = 'student/index';
            // $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status' => 1), '', '', array('sort' => 'desc'));
            $this->load->view('template', $data);
        }
    }

    function result_search() {

        $this->load->model('search_mod', 'search_mod');

        $result = $this->uri->segment_array();

        if (!isset($result[4]) || !isset($result[6])) {
            redirect('student/index');
        } else {
            $data['key_word'] = $key_word = $result[4];
            $data['status'] = $status = $result[6];

            $this->load->library('pagination');
            $per_page = 10;
            $session_per_page = $this->session->userdata('session_per_page');
            if (isset($session_per_page) && $session_per_page > 0)
                $per_page = $session_per_page;

            if ($this->uri->segment(7) == null || $this->uri->segment(7) == 1) {
                $offset = 0;
            } else {
                $offset = $this->uri->segment(7);
            }
            $total = $this->search_mod->count_student($key_word, $status);
            $data['rows'] = $this->search_mod->load_student($key_word, $status, $per_page, $offset);

            $base_url = site_url('student/result_search/key_word/' . $key_word . '/status/' . $status . '/');
            $config['base_url'] = $base_url;
            $config['per_page'] = $per_page;
            $config['total_rows'] = $total;
            $config['uri_segment'] = 7;
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();
            $data['total'] = $total;
            $data['is_search'] = 1;
            $data['header'] = 'list_base_header';
            $data['footer'] = 'list_base_footer';
            $data['content'] = 'student/index';
            $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status' => 1), '', '', array('sort' => 'desc'));
            $this->load->view('template', $data);
        }
    }

    function active_courses($student_id, $id, $status) {

        if ($this->admin_id != 35) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        if ($status)
            $status = 0;
        else
            $status = 1;

        $this->lib_mod->update('student_courses', array('id' => $id), array('status' => $status));
        $action = 'Cập nhật bản ghi student_courses "' . $id;
        $this->lib_mod->insert_log($action);
        $this->session->set_flashdata('success', $action . ' thành công.');

        redirect('student/view/' . $student_id);
    }

    function delete_courses($student_id, $items_id = array()) {

        if ($this->admin_id != 35) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        if (empty($items_id)) {
            $items_id = $this->input->post('items_id');
        } else {
            $items_id = array($items_id);
        }

        if (count($items_id)) {
            $name_del = '';
            foreach ($items_id as $id) {
                $name_del .= $id . ', ';
                $this->lib_mod->delete('student_courses', array("id" => $id));
            }

            if (!empty($name_del)) {
                $action = 'Xóa bản ghi student_courses "' . $name_del;
                $this->lib_mod->insert_log($action);
                $this->session->set_flashdata('success', $action . ' thành công.');
            }
        } else {
            $this->session->set_flashdata('error', 'Bạn phải chọn ít nhất một bản ghi cần xóa.');
        }

        redirect('student/view/' . $student_id);
    }

    function online() {
        if ($this->admin_id != 35 && $this->admin_id != 38 && $this->admin_id != 41) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
// ip thoi gian info email sdt
        $this->load->library('pagination');
        $per_page = 120;
        $session_per_page = $this->session->userdata('session_per_page');
        if (isset($session_per_page) && $session_per_page > 0)
            $per_page = $session_per_page;

        $sql1 = 'select * from tbl_watching_time where ' . time() . ' -  tbl_watching_time.time < 15';
        $sql2 = $this->db->query($sql1);
        $total = count($sql2->result_array());


        if (empty($this->uri->segment(3))) {
            $offset = '';
        } else {
            $offset = ' OFFSET ' . $this->uri->segment(3);
        }

        $sql3 = 'SELECT * FROM `tbl_watching_time` WHERE (' . time() . ' - `time` < 15) ORDER BY `time` DESC LIMIT ' . $per_page . $offset;
        $data['rows'] = $this->db->query($sql3)->result_array();

        $danhsachID = array();
        foreach ($data['rows'] as $key => $value) {
            array_push($danhsachID, $value['student_id']);
        }

        if (empty($danhsachID)) {
            $danhsachID = '2626';
        }

        $data['student'] = $this->lib_mod->load_all_where_in('student', 'id, name, email, phone', '', array('id' => $danhsachID), '', '', '');

        $base_url = site_url('student/online/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'student/online';
        $this->load->view('template', $data);
    }

    function _send_id_lakita_to_crm($student_id, $course_id) {
        require_once APPPATH . "../public/lakita/Rest_client/Rest_Client.php";
        $this->load->model('courses_model');
        $this->load->model('student_model');

        $input['select'] = 'id,email,phone';
        $input['where'] = array('id' => $student_id);

        $student = $this->student_model->load_all($input);
        $course_code = $this->courses_model->GetCourseCode($course_id);
        $post = [];

        $post['id_lakita'] = $student_id;
        $post['email'] = htmlspecialchars($student[0]['email']);
        $post['phone'] = $student[0]['phone'];
        $post['course_code'] = $course_code;
        $post['date_active'] = time();
        
        $config = array(
            'server' => 'https://crm2.lakita.vn/',
            //'server' => 'http://thanhloc.com/lakita-crm/',
            'api_key' => 'RrF3rcmYdWQbviO5tuki3fdgfgr4',
            'api_name' => 'lakita-key'
        );
        $restClient = new Rest_Client($config);
        $uri = "contact_api/update_id_lakita";

        $restClient->post($uri, $post);
    }

    function search_course(){
        $key = $this->input->post('data_search');
        //var_dump($key);die();
        // echo $key;die();
        $this->load->model('courses_model');
        $input = array();
        $input['select'] = 'id,name,course_code';
        $input['like'] = array('search' => $key);
        // $input['or_like'] = array('search' => $key)
        $test = $this->courses_model->load_all($input);

        echo json_encode($test);
    }
}
