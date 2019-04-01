<?php

class Examination extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if (!isset($this->admin_id) || empty($this->admin_id)) {
            redirect('home/login');
        }
    }

    function index() {
        $this->load->model('examination_model');
        $this->load->model('courses_model');
        $this->load->library('pagination');
        $per_page = 15;

        $total = count($this->examination_model->load_all());

        $input = array();
        $input['limit'] = array($per_page, $this->uri->segment(3));
        $input['order'] = array('id' => 'desc');
        $data['rows'] = $this->examination_model->load_all($input);
        $base_url = site_url('examination/index/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();

        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'examination/index';
        $data['courses'] = $this->courses_model->load_all(array('order' => array('sort' => 'desc')));
        $this->load->view('template', $data);
    }

    function update($id = 0) {
        $this->load->model('examination_model');
        $this->load->model('examination_question_model');
        $this->load->model('examination_answer_model');
        if ($id)
            $module = 'edit_examination';
        else
            $module = 'add_examination';

        if ($this->admin_id != 35 && $this->admin_id != 37) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        $edit = $this->input->post('edit');
        $save_edit = $this->input->post('save_edit');
        if (!empty($edit) || !empty($save_edit)) {
            $post = $this->input->post();

            $input = array();
            $input['where']['name'] = $post['name'];
            $input['where']['id !='] = $id;
            $name_exist = $this->examination_model->load_all($input);
            $error = '';
            if ($name_exist)
                $error = 'Tên khóa học đã tồn tại';

            if (empty($error)) {

//                echo '<pre>';
//                print_r($post);
//                die;

                $exam_name = $post['name'];
                $exam_course = implode(',', $post['courses']);

                if ($id) {
                    $param['course_id'] = $exam_course;
                    $param['name'] = $exam_name;
                    $param['slug'] = $post['slug'];
                    $param['status'] = $post['status'] == 1 ? 1 : 0;
                    $param['admin_id_add'] = $this->admin_id;
                    $where = array('id' => $id);
                    $this->examination_model->update($where, $param);
                } else {
                    $param['course_id'] = $exam_course;
                    $param['name'] = $exam_name;
                    $param['create_date'] = time();
                    $param['slug'] = $post['slug'];
                    $param['status'] = $post['status'] == 1 ? 1 : 0;
                    $param['admin_id_add'] = $this->admin_id;
                    $id = $this->examination_model->insert_return_id($param, 'id');
                }

                foreach ($post['exam'] as $e_key => $e_value) {
                    $question_id = $e_value['question_id'];
                    if ($question_id == 0) {
                        $param_question = array();
                        $param_question['examination_id'] = $id;
                        $param_question['question'] = $e_value['question'];
                        $param_question['status'] = 1;
                        $param_question['create_date'] = time();
                        $question_id = $this->examination_question_model->insert_return_id($param_question, 'id');
                    } else {
                        $param_question = array();
                        $param_question['question'] = $e_value['question'];
                        $param_question['status'] = 1;
                        $where = array('id' => $question_id);
                        $question_id = $this->examination_question_model->update($where, $param_question);
                    }
                    for ($i = 1; $i < 5; $i++) {
                        if ($e_value['answer' . $i . '_id'] == 0) {
                            $param_answer = array();
                            $param_answer['examination_id'] = $id;
                            $param_answer['question_id'] = $question_id;
                            $param_answer['answer'] = $e_value['answer' . $i];
                            $param_answer['right_answer'] = isset($e_value['answer' . $i . '_right']) ? 1 : 0;
                            $param_answer['create_date'] = time();
                            $this->examination_answer_model->insert($param_answer);
                        } else {
                            $param_answer = array();
                            $param_answer['answer'] = $e_value['answer' . $i];
                            $param_answer['right_answer'] = isset($e_value['answer' . $i . '_right']) ? 1 : 0;
                            $where = array('id' => $e_value['answer' . $i . '_id']);
                            $this->examination_answer_model->update($where, $param_answer);
                        }
                    }
                }
            }

            if ($id) {
                $action = 'Cập nhật examination "' . $data['name'] . '"';
                $this->lib_mod->insert_log($action);
                $this->session->set_flashdata('success', $action . ' thành công.');
            } else {
                $action = 'Thêm mới examination "' . $data['name'] . '"';
                $this->lib_mod->insert_log($action);
                $this->session->set_flashdata('success', $action . ' thành công.');
            }

            if (!empty($save_edit))
                redirect('examination/update');

            if (!empty($edit))
                redirect($this->session->userdata('curr_segment_examination'));
        }

        $input = array();
        $input['where']['id'] = $id;
        $row = $this->examination_model->load_all($input);
        if (!empty($row)) {
            $row[0]['course_id'] = (strpos($row[0]['course_id'], ',')) ? implode(',', $row[0]['course_id']) : array($row[0]['course_id']);
        }
        $input = array();
        $input['where']['examination_id'] = $id;
        $row['exam'] = $this->examination_question_model->load_all($input);
        foreach ($row['exam'] as $key => $value) {
            $inpput = array();
            $inpput['where']['question_id'] = $value['id'];
            $row['exam'][$key]['answer'] = $this->examination_answer_model->load_all($inpput);
        }

//                      echo '<pre>';
//        print_r($row);die;  



        $data['row'] = $row;
        $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status' => 1), '', '', ''); //array('sort' => 'desc'));
//        if (isset($data['row'][0]))
//            $courses_id = $data['row'][0]['courses_id'];
//        else
//            $courses_id = $data['courses'][0]['id'];
        $data['id'] = $id;
        $this->load->model('courses_model');
        $data['courses'] = $this->courses_model->load_all(array('order' => array('sort' => 'desc')));
        $data['content'] = 'examination/update';
        $data['header'] = 'edit_adv_header';
        $data['footer'] = 'edit_adv_footer';
        $data['uploadify'] = '1';
        $data['courses_change'] = '1';
        $this->load->view('template', $data);
    }

    function status($id, $status) {
        if ($this->admin_id != 35 && $this->admin_id != 37) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        if ($id == 35)
            redirect(site_url() . 'learn');

        if ($status)
            $status = 0;
        else
            $status = 1;

        $data = $this->lib_mod->detail('learn', array("id" => $id));

        if (isset($data[0])) {
            $this->lib_mod->update('learn', array('id' => $id), array('status' => $status));
            $action = 'Cập nhật bản ghi "' . $data[0]['name'] . '" module album';
            $this->lib_mod->insert_log($action);
            $this->session->set_flashdata('success', $action . ' thành công.');
        } else {
            $this->session->set_flashdata('error', 'Lỗi không xác định được bản ghi để cập nhật');
        }

        redirect($this->session->userdata('curr_segment_learn'));
    }

    function delete($items_id = array()) {
        if ($this->admin_id != 35 && $this->admin_id != 37) {
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
                if ($id != 35) {
                    $detail = $this->lib_mod->detail('learn', array("id" => $id));
                    $name_del .= $detail[0]['name'] . ', ';
                    $this->lib_mod->delete('learn', array("id" => $id));
                }
            }

            if (!empty($name_del)) {
                $action = 'Xóa bản ghi "' . $name_del . '" module album';
                $this->lib_mod->insert_log($action);
                $this->session->set_flashdata('success', $action . ' thành công.');
            }
        } else {
            $this->session->set_flashdata('error', 'Bạn phải chọn ít nhất một bản ghi cần xóa.');
        }

        redirect($this->session->userdata('curr_segment_learn'));
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
        redirect('learn/result_search/' . $param);
    }

    function result_search() {
        $this->load->model('search_mod', 'search_mod');

        $result = $this->uri->segment_array();
        if (!isset($result[4]) || !isset($result[6]) || !isset($result[8])) {
            redirect('learn/index');
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
            $total = $this->search_mod->count_learn($key_word, $status, $courses_id);


            $data['rows'] = $this->search_mod->load_learn($key_word, $status, $courses_id, $per_page, $offset);




            $base_url = site_url('learn/result_search/key_word/' . $key_word . '/status/' . $status . '/courses_id/' . $courses_id . '/');
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
            $data['content'] = 'learn/index';
            $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status' => 1), '', '', array('sort' => 'desc'));
            $this->load->view('template', $data);
        }
    }

}
