<?php

//------------------------
// project : omegamart
// coder: acetiendung
// time : 14/12/2011
//------------------------
class Courses extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if (!isset($this->admin_id) || empty($this->admin_id)) {
            redirect('home/login');
        }
    }

    function index() {
        if ($this->admin_id != 35 && $this->admin_id != 37) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        $this->load->library('pagination');
        $per_page = 10;
        $session_per_page = $this->session->userdata('session_per_page');
        if (isset($session_per_page) && $session_per_page > 0)
            $per_page = $session_per_page;

        $total = $this->lib_mod->count('courses', array());
        $data['rows'] = $this->lib_mod->load_all('courses', '', array(), $per_page, $this->uri->segment(3), array('id' => 'desc', 'parent' => 'desc'));
        $base_url = site_url('courses/index/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'courses/index';
        $data['group_courses'] = $this->lib_mod->load_all('group_courses', 'id, name', array('status' => 1), '', '', array('sort' => 'desc'));

        $this->load->model('courses_model');
        $input = array();
        $input['select'] = 'id,name,course_code';
        $input['where']['status'] = 1;
        $input['order']['name'] = 'desc';
        $data['courses'] = $this->courses_model->load_all($input);


        $this->load->view('template', $data);
    }

    function update($id = 0) {
        if ($id)
            $module = 'edit_courses';
        else
            $module = 'add_courses';

        if ($this->admin_id != 35 && $this->admin_id != 37) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }
        $this->load->model('courses_model');

//        var_dump($this->input->post('keyword'));die;

        $big_size = '360x260';
        $arr_big_size = explode('x', $big_size);
        $targ_w = intval($arr_big_size[0]);
        $targ_h = intval($arr_big_size[1]);
        $data['ratio'] = $targ_w / $targ_h;

        $edit = $this->input->post('edit');
        $save_edit = $this->input->post('save_edit');
        if (!empty($edit) || !empty($save_edit)) {
            $name = trim($this->input->post('name'));
            $title = trim($this->input->post('title'));
            $speaker = $this->input->post('speaker');
            $speaker_id = '';
            if (!empty($speaker))
                $speaker_id = implode(',', array_filter($speaker));

//            $video = $this->input->post('video');
//            $video = end(explode('?v=', $video));
            $video_link = trim($this->input->post('video'));
            $video = strstr($video_link, 'data');

            $att_name = $this->input->post('att_name');
            $att_description = $this->input->post('att_description');
            $attach_file = '';
            $attach_desc = '';
            if (!empty($att_name)) {
                $attach_file = implode('@', $att_name);
                $attach_file = str_replace(WEBSITE, '', $attach_file);
            }
            if (!empty($att_description)) {
                $attach_desc = implode('@', $att_description);
            }

            $error = '';
            $condition = array('name' => $name);
            if ($id) {
                $condition = array("id !=" => $id, 'name' => $name);
            }
            $name_exist = $this->lib_mod->count('courses', $condition);
            if ($name_exist)
                $error = 'Tên khóa học đã tồn tại';

            $course_code = strtoupper($this->input->post('course_code'));
            $input = array();
            $input['where']['id !='] = $id;
            $input['where']['course_code'] = $course_code;
            if ($this->courses_model->load_all($input) && $course_code != '') {
                $error = 'Mã khóa học đã tồn tại';
            }

            if (empty($error)) {
                $keyword = trim($this->input->post('keyword'));
                $search = $this->lib_mod->make_url($name . ' ' . $title . ' ' . str_replace(',', ' ', $keyword));
                $price_root = $this->input->post('price_root');
                $price_root = str_replace('_', '', $price_root);
                $price_root = str_replace(' ', '', $price_root);
                $price_root = str_replace('VND', '', $price_root);

                $price_sale = $this->input->post('price_sale');
                $price_sale = str_replace('_', '', $price_sale);
                $price_sale = str_replace(' ', '', $price_sale);
                $price_sale = str_replace('VND', '', $price_sale);


                if (empty($price_root))
                    $price_root = 0;
                if (empty($price_sale))
                    $price_sale = $price_root;

                $data = array(
                    'group_courses_id' => $this->input->post('group_courses_id'),
                    'name' => $name,
                    'title' => $title,
                    'course_code' => $course_code,
                    'video' => $video,
                    'speaker_id' => $speaker_id,
                    'attach_file' => $attach_file,
                    'attach_desc' => $attach_desc,
                    'en_name' => trim($this->input->post('en_name')),
                    'hot' => $this->input->post('hot') == 1 ? 1 : 0,
                    'free' => $this->input->post('free') == 1 ? 1 : 0,
                    'parent' => 0,
                    'status' => $this->input->post('status') == 1 ? 1 : 0,
                    'sort' => trim($this->input->post('sort')),
                    'price_root2' => $price_root,
                    'price_sale' => $price_sale,
                    'length' => trim($this->input->post('length')),
                    'create_date' => time(),
                    'time_release' => strtotime($this->input->post('time_release')),
                    'slug' => trim($this->input->post('slug')),
                    'content' => trim($this->input->post('content')),
                    'description' => trim($this->input->post('description')),
                    'keyword' => $keyword,
                    'language' => trim($this->input->post('language')),
                    'search' => str_replace('-', ' ', $search . ' ' . $this->input->post('slug')) . ' ' . $name . ' ' . str_replace(',', ' ', $keyword) . ' ' . $course_code,
                );

                $image = trim($this->input->post('image'));
                if (!empty($image)) {
                    $crop_x = intval(trim($this->input->post('crop_x')));
                    $crop_y = intval(trim($this->input->post('crop_y')));
                    $crop_w = intval(trim($this->input->post('crop_w')));
                    $crop_h = intval(trim($this->input->post('crop_h')));
                    $jpeg_quality = 100;
                    $path_default = UPLOAD . 'data/source/courses/';
                    $path_big_size = $path_default . $big_size . '/';
                    $this->lib_mod->make_dir($path_big_size);

                    $path = pathinfo($image);
                    $type = $path['extension'];
                    $new_filename = $this->lib_mod->make_url($path['filename']) . '-' . time() . '.' . $type;

                    $image_root = str_replace(WEBSITE, '', $image);
                    $src_root = str_replace(WEBSITE, UPLOAD, $image);

                    $img_root = imagecreatefromjpeg($src_root);

                    $dst_root = ImageCreateTrueColor($targ_w, $targ_h);

                    imagecopyresampled($dst_root, $img_root, 0, 0, $crop_x, $crop_y, $targ_w, $targ_h, $crop_w, $crop_h);

                    switch ($type) {
                        case 'bmp': imagewbmp($dst_root, $path_big_size . $new_filename, $jpeg_quality);
                            break;
                        case 'gif': imagegif($dst_root, $path_big_size . $new_filename, $jpeg_quality);
                            break;
                        case 'jpg': imagejpeg($dst_root, $path_big_size . $new_filename, $jpeg_quality);
                            break;
                        case 'jpeg': imagejpeg($dst_root, $path_big_size . $new_filename, $jpeg_quality);
                            break;
                        case 'png': imagepng($dst_root, $path_big_size . $new_filename, $jpeg_quality);
                            break;
                        default : return "Không hỗ trợ định dạng ảnh này";
                    }
                    $data['image'] = str_replace(UPLOAD, '', $path_big_size . $new_filename);
                }

                if (!empty($_FILES['image_share']['name'])) {
                    $image_share_path = realpath(UPLOAD . "data/source/courses");
                    $image_share_thumb = $this->lib_mod->action_upload($image_share_path, 'image_share');
                    $data['image_share'] = 'data/source/courses/' . $image_share_thumb['file_name'];
                }

                if ($id) {
                    $data['search'] .= ' ' . $id;
                    $this->lib_mod->update('courses', array('id' => $id), $data);
                    $action = 'Cập nhật danh mục "' . $data['name'] . '"';
                    $this->lib_mod->insert_log($action);
                    $this->session->set_flashdata('success', $action . ' thành công.');
                } else {
                    $data['status'] = 1;
                    $this->lib_mod->insert('courses', $data);
                    $action = 'Thêm mới danh mục "' . $data['name'] . '"';
                    $this->lib_mod->insert_log($action);
                    $this->session->set_flashdata('success', $action . ' thành công.');
                }

                if (!empty($save_edit))
                    redirect('courses/update');

                if (!empty($edit))
                    redirect($this->session->userdata('curr_segment_course'));
            }
            else {
                $this->session->set_flashdata('error', $error);
                redirect('courses/update/' . $id);
            }
        }

        $data['group_courses'] = $this->lib_mod->load_all('group_courses', 'id, name', array('status' => 1), '', '', array('sort' => 'desc'));
        $data['speaker'] = $this->lib_mod->load_all('speaker', 'id, name', array('status' => 1), '', '', array('sort' => 'desc'));
        $data['row'] = $this->lib_mod->detail('courses', array('id' => $id));
        $data['id'] = $id;
        $data['group_courses_id'] = isset($this->lib_mod->load_all('courses', '', array('id' => $id), '', '', '')[0]['group_courses_id']) ? $this->lib_mod->load_all('courses', '', array('id' => $id), '', '', '')[0]['group_courses_id'] : 0;
        $data['content'] = 'courses/update';
        $data['header'] = 'edit_adv_header';
        $data['footer'] = 'edit_adv_footer';
        $this->load->view('template', $data);
    }

    function status($id, $status) {
        if ($this->admin_id != 35 && $this->admin_id != 37) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        if ($id == 35)
            redirect(site_url() . 'courses');

        if ($status)
            $status = 0;
        else
            $status = 1;

        $data = $this->lib_mod->detail('courses', array("id" => $id));

        if (isset($data[0])) {
            $this->lib_mod->update('courses', array('id' => $id), array('status' => $status));
            $action = 'Cập nhật bản ghi "' . $data[0]['name'] . '" module Danh mục';
            $this->lib_mod->insert_log($action);
            $this->session->set_flashdata('success', $action . ' thành công.');
        } else {
            $this->session->set_flashdata('error', 'Lỗi không xác định được bản ghi để cập nhật');
        }

        redirect($this->session->userdata('curr_segment_course'));
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
                $count = $this->lib_mod->count('student_courses', array("courses_id" => $id));
                $detail = $this->lib_mod->detail('courses', array("id" => $id));
                if ($count) {
                    $name_not_del .= $detail[0]['name'] . ', ';
                } else {
                    $name_del .= $detail[0]['name'] . ', ';
                    $this->lib_mod->delete('courses', array("id" => $id));
                }
            }

            if (!empty($name_not_del))
                $this->session->set_flashdata('error', 'Bản ghi "' . $name_not_del . '" đang được sử dụng bạn không được phép xóa');


            if (!empty($name_del)) {
                $action = 'Xóa bản ghi "' . $name_del . '" module danh mục';
                $this->lib_mod->insert_log($action);
                $this->session->set_flashdata('success', $action . ' thành công.');
            }
        } else {
            $this->session->set_flashdata('error', 'Bạn phải chọn ít nhất một bản ghi cần xóa.');
        }

        redirect($this->session->userdata('curr_segment_course'));
    }

    function search() {
        $group_courses_id = $this->input->post('group_courses_id');
        if (empty($group_courses_id))
            $group_courses_id = 0;
        else
            $group_courses_id = $group_courses_id;

        if ($this->admin_id != 35 && $this->admin_id != 37) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }

        $key_word = $this->lib_mod->make_url(trim($this->input->post('key_word')));
        if (empty($key_word))
            $key_word = 'empty';
        $status = $this->input->post('status');
        $search = array('key_word' => $key_word, 'status' => $status, 'group_courses_id' => $group_courses_id);
        $param = $this->uri->assoc_to_uri($search);
        $param = str_replace('//', '/0/', $param);
        redirect('courses/result_search/' . $param);
    }

    function result_search() {
        $this->load->model('search_mod', 'search_mod');

        $result = $this->uri->segment_array();

        if (!isset($result[4]) || !isset($result[6]) || !isset($result[8])) {
            redirect('courses/index');
        } else {
            $data['key_word'] = $key_word = $result[4];
            $data['status'] = $status = $result[6];
            $data['group_courses_id'] = $group_courses_id = $result[8];
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
            $total = $this->search_mod->count_courses($key_word, $status, $group_courses_id);
            $data['rows'] = $this->search_mod->load_courses($key_word, $status, $group_courses_id, $per_page, $offset);

            $base_url = site_url('courses/result_search/key_word/' . $key_word . '/status/' . $status . '/group_courses_id/' . $group_courses_id . '/');
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
            $data['content'] = 'courses/index';

            $data['group_courses'] = $this->lib_mod->load_all('group_courses', 'id, name', array('status' => 1), '', '', array('sort' => 'desc'));
            $this->load->view('template', $data);
        }
    }

    function import_course_sale() {

        //cập nhật giá từ file google sheet
        $this->load->model('courses_model');
        $key = 'AIzaSyAcSOEs5nkmDXl5j39z0JQBzUkALnLGrDY';
        $tweets = file_get_contents('https://sheets.googleapis.com/v4/spreadsheets/1-qYJJ5f4BH-Js8jgqpTqjRFrcjabkMAbQq1oMWbvoFM/values/Sheet1!A:D?key=AIzaSyCdjll4ib79ZGtUEEEAxksl6zff2NkLCII');
        $tweets = json_decode($tweets);
        $data = $tweets->values;
        $time_start = $data[0][0];
        $time_end = $data[0][1];
        array_shift($data);
//
//            echo '<pre>';
//            print_r($data);
//            die;
        foreach ($data as $row) {
            if ($row[0] != '') {
                $where = array('course_code' => $row[0], 'status' => '1');
                $price_sale = array(
                    'price_sale' => $row[1],
                    'time_start_sale' => strtotime($time_start),
                    'time_end_sale' => strtotime($time_end)
                );
                $this->courses_model->update($where, $price_sale);
            }
        }



        //up banner và popup
        $config['upload_path'] = '../styles/v2.0/img/event';
        //$config['upload_path'] = './styles/event';
        $config['allowed_types'] = 'png';
        $config['max_size'] = '100000';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('banner')) {
            $data_banner = $this->upload->data();
            rename($data_banner['full_path'], $data_banner['file_path'] . 'banner.png');
        }
        if ($this->upload->do_upload('popup')) {
            $data_banner = $this->upload->data();
            rename($data_banner['full_path'], $data_banner['file_path'] . 'popup.png');
        }


        echo '<script>alert("cập nhật danh sách khuyến mại thành công!"); </script>';
        echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }

    function courses_flash_sale() {
        $this->load->model('flash_sale_model');
        $post = $this->input->post();

        if (isset($post['course_sale']) && !empty($post['course_sale'])) {
            $courses_sale = $post['course_sale'];
        } else {
            echo 'Bạn chưa chọn khóa giảm giá!';
            die;
        }

        $price_sale = $post['price_sale'];
        $start_sale = (empty($post['start_sale'])) ? time() : strtotime($post['start_sale']);
        $end_sale = (empty($post['end_sale'])) ? time() : strtotime($post['end_sale']);


        if ($price_sale == '') {
            echo 'Bạn chưa nhập giá flash sale!';
            die;
        }
        if ($start_sale >= $end_sale) {
            echo 'Thời gian bắt đầu khuyến mại phải lớn hơn thời gian kết thúc khuyến mại!';
            die;
        }
        if (empty($courses_sale)) {
            echo 'Bạn chưa chọn khóa được giảm giá';
            die;
        }

        $exist_course_sale = array();

        foreach ($courses_sale as $course_id) {

        //    echo $this->check_exist_course_sale($course_id, $start_sale, $end_sale);
            if ($this->check_exist_course_sale($course_id, $start_sale, $end_sale)) {
                $exist_course_sale[] = $course_id;
            } else {
                $data = array(
                    'course_id' => $course_id,
                    'price_sale' => $price_sale,
                    'time_start_sale' => $start_sale,
                    'time_end_sale' => $end_sale
                );
                $this->flash_sale_model->insert($data);
            }
        }
     
        if (empty($exist_course_sale)) {
            echo 'Cài đặt flash sale thành công';
        } else {
            $this->load->model('courses_model');
            $input = array();
            $input['select'] = 'id,name,course_code';
            $input['where_in']['id'] = $exist_course_sale;
            $course = $this->courses_model->load_all($input);
            $a = 'Các khóa sau đang được giảm giá trong khung giờ trùng với khung giờ bạn đã chọn : ';
            foreach ($course as $value) {
                $a .= $value['course_code'] . ', ';
            }
            echo rtrim($a, ', ');
        }
    }

    function check_exist_course_sale($course_id, $start_sale, $end_sale) {
      
            $input = array();
            $input['where']['course_id'] = $course_id;
            $input['where']['time_start_sale >='] = $start_sale;
            $input['where']['time_start_sale <='] = $end_sale;
            $exist_course_sale = '';
            $exist_course_sale = $this->flash_sale_model->load_all($input);
            if (empty($exist_course_sale)) {
                $input = array();
                $input['where']['course_id'] = $course_id;
                $input['where']['time_start_sale <='] = $start_sale;
                $input['where']['time_end_sale >='] = $end_sale;
                $exist_course_sale = '';
                $exist_course_sale = $this->flash_sale_model->load_all($input);
                if (empty($exist_course_sale)) {
                    $input = array();
                    $input['where']['course_id'] = $course_id;
                    $input['where']['time_end_sale >='] = $start_sale;
                    $input['where']['time_end_sale <='] = $end_sale;
                    $exist_course_sale = '';
                    $exist_course_sale = $this->flash_sale_model->load_all($input);
                    if (empty($exist_course_sale)) {
                        return FALSE;
                    } else {
                        return TRUE;
                    }
                } else {
                    //return 1; //true
                    return TRUE;
                }
            } else {
                //return 2; //true
                return TRUE;
            }
        
    }

}
