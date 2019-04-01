<?php

//------------------------
// project : omegamart
// coder: acetiendung
// time : 14/12/2011
//------------------------
class learn extends CI_Controller {

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

        $total = $this->lib_mod->count('learn', array());
        $data['rows'] = $this->lib_mod->load_all('learn', '', array(), $per_page, $this->uri->segment(3), array('id' => 'desc'));
        $base_url = site_url('learn/index/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'learn/index';
        $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status' => 1), '', '', array('sort' => 'desc'));
        $this->load->view('template', $data);
    }

    function update($id = 0) {
        if ($id)
            $module = 'edit_learn';
        else
            $module = 'add_learn';

        if ($this->admin_id != 35 && $this->admin_id != 37) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "' . base_url() . '"</script>';
            exit;
        }


        $big_size = '268x150';
        $arr_big_size = explode('x', $big_size);
        $targ_w = intval($arr_big_size[0]);
        $targ_h = intval($arr_big_size[1]);
        $data['ratio'] = $targ_w / $targ_h;

        $edit = $this->input->post('edit');
        $save_edit = $this->input->post('save_edit');
        if (!empty($edit) || !empty($save_edit)) {
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



            $name = trim($this->input->post('name'));
            $title = trim($this->input->post('title'));
            $thumbnail = trim($this->input->post('thumbnail'));
            $meta_keywords = trim($this->input->post('meta_keywords'));
            $tag = trim($this->input->post('tag'));
            $chapter_id = $this->input->post('chapter_id');
            if (!isset($chapter_id))
                $chapter_id = 0;

            $youtube = $this->input->post('youtube');
            $youtube = end(explode('?v=', $youtube));
            $trial_learn = ( $this->input->post('trial_learn') != '' ) ? 1 : 0;

            $video_link = trim($this->input->post('video_link'));
            $video = strstr($video_link, 'data');

            $data = array(
                'name' => $name,
                'youtube' => $youtube,
                'title' => $title,
                'attach_file' => $attach_file,
                'attach_desc' => $attach_desc,
                'meta_keywords' => $meta_keywords,
                'tag' => $tag,
                'create_date' => time(),
                'video_file' => $video,
                'courses_id' => trim($this->input->post('courses_id')),
                'chapter_id' => $chapter_id,
                'slug' => trim($this->input->post('slug')),
                'hot' => $this->input->post('hot') == 1 ? 1 : 0,
                'sort' => $this->input->post('sort'),
                'length' => $this->input->post('length'),
                'status' => $this->input->post('status') == 1 ? 1 : 0,
                'description' => trim($this->input->post('description')),
                'meta_description' => trim($this->input->post('meta_description')),
                'content' => trim($this->input->post('content')),
                'admin_id_add' => $this->admin_id,
                'time_release' => strtotime($this->input->post('time_release')),
                'trial_learn' => $trial_learn
            );

            $search = $this->lib_mod->make_url($name . ' ' . $title . ' ' . $meta_keywords . ' ' . $tag . ' ' . $id);

            $data['search'] = str_replace('-', ' ', $search);

            if (!empty($thumbnail)) {
                $crop_x = intval(trim($this->input->post('crop_x')));
                $crop_y = intval(trim($this->input->post('crop_y')));
                $crop_w = intval(trim($this->input->post('crop_w')));
                $crop_h = intval(trim($this->input->post('crop_h')));
                $jpeg_quality = 100;
                $path_default = UPLOAD . 'data/source/learn/';
                $path_big_size = $path_default . $big_size . '/';
                $this->lib_mod->make_dir($path_big_size);

                $path = pathinfo($thumbnail);
                $type = $path['extension'];
                $new_filename = $this->lib_mod->make_url($path['filename']) . '-' . time() . '.' . $type;

                $image_root = str_replace(WEBSITE, '', $thumbnail);
                $src_root = str_replace(WEBSITE, UPLOAD, $thumbnail);

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

                $data['thumbnail'] = str_replace(UPLOAD, '', $path_big_size . $new_filename);
            }

            if ($id) {
                $data['search'] .= ' ' . $id;
                $this->lib_mod->update('learn', array('id' => $id), $data);
                $action = 'Cập nhật album "' . $data['name'] . '"';
                $this->lib_mod->insert_log($action);
                $this->session->set_flashdata('success', $action . ' thành công.');
            } else {
                $this->lib_mod->insert('learn', $data);
                $action = 'Thêm mới album "' . $data['name'] . '"';
                $this->lib_mod->insert_log($action);
                $this->session->set_flashdata('success', $action . ' thành công.');
            }

            if (!empty($save_edit))
                redirect('learn/update');

            if (!empty($edit))
                redirect($this->session->userdata('curr_segment_learn'));
        }

        $data['row'] = $this->lib_mod->detail('learn', array('id' => $id));
        $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status' => 1), '', '', ''); //array('sort' => 'desc'));
        if (isset($data['row'][0]))
            $courses_id = $data['row'][0]['courses_id'];
        else
            $courses_id = $data['courses'][0]['id'];
        $data['chapter'] = $this->lib_mod->load_all('chapter', 'id, name', array('status' => 1, 'courses_id' => $courses_id), '', '', array('sort' => 'desc'));
        $data['id'] = $id;
        $data['content'] = 'learn/update';
        $data['header'] = 'edit_adv_header';
        $data['footer'] = 'edit_adv_footer';
        $data['uploadify'] = '1';
        $data['courses_change'] = '1';
        $this->load->view('template', $data);
    }

    function courses_change() {
        $courses_id = $this->input->post('courses_id');
        $token_input = $this->input->post('key');
        $token = $token_input . 'AceTienDung';
        $verifyToken = $this->input->post('okkey');
        if (!empty($courses_id) && $token == $verifyToken) {
            $data['chapter'] = $this->lib_mod->load_all('chapter', 'id, name', array('status' => 1, 'courses_id' => $courses_id), '', '', array('sort' => 'desc'));
            $this->load->view('learn/chapter', $data);
        } else {
            echo 'faild';
        }
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

    function import_learn_list() {

        $post = $this->input->post();
        if (isset($post['submit'])) {
            $file_path = '';
            $config['upload_path'] = './public/list_learn';
            $config['allowed_types'] = 'xls|xlsx';
            $config['max_size'] = '100000';
            $config['file_name'] = 'list-learn-' . date('d-m-Y-H-i');
            $this->load->library('upload', $config);
            if ($post['upload'] == 'learn_list') {
                if ($this->upload->do_upload('file')) {
                    $data = $this->upload->data();
                    $file_path = $data['full_path'];
                    $this->_import_learn_list($file_path);
                    echo '<script>alert("Thêm danh sách khóa học thành công !");</script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                } else {
                    echo '<script>alert("Có lỗi xảy ra !");</script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                }
            }
            if ($post['upload'] == 'link_list') {
                if ($this->upload->do_upload('file_link')) {
                    $data = $this->upload->data();
                    $file_path = $data['full_path'];
                    $this->_import_link_list($file_path);
                    echo '<script>alert("Cập nhật link video thành công !");</script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                } else {
                    echo '<script>alert("Có lỗi xảy ra !");</script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                }
            }if ($post['upload'] == 'attach_file_list') {
                if ($this->upload->do_upload('attach_file')) {
                    $data = $this->upload->data();
                    $file_path = $data['full_path'];
                    $this->_import_attach_file_list($file_path);
                    echo '<script>alert("Cập nhật tài liệu thành công !");</script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                } else {
                    echo '<script>alert("Có lỗi xảy ra !");</script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                }
            }
        } else {
            echo '<script>alert("Thêm danh sách khóa học thành công !");</script>';
            echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }
    }

    // thay đổi link video bằng danh sách trong file excel
    private function _import_link_list($file_path) {
        $this->load->model('learn_model');
        $this->load->library('PHPExcel');
        $objPHPExcel = PHPExcel_IOFactory::load($file_path);
        $sheet = $objPHPExcel->getActiveSheet();
        $data1 = $sheet->rangeToArray('A2:B500');
        foreach ($data1 as $row) {
            if ($row[0] != '') {
                $learn_id = $row[0];
                $where = array('id' => $learn_id);
                
                $link = $row[1];
                $video_link = trim($link);
                $data = array('video_file' => 'data/source/'.$video_link);
              
                $this->learn_model->update($where,$data);
            }
        }
    }
    
    //thêm bài học bằng danh sách trong file excel
    private function _import_learn_list($file_path) {
        $this->load->model('learn_model');
        $this->load->library('PHPExcel');
        $objPHPExcel = PHPExcel_IOFactory::load($file_path);
        $sheet = $objPHPExcel->getActiveSheet();
        $data1 = $sheet->rangeToArray('A2:D500');
        foreach ($data1 as $row) {
            if ($row[0] != '') {
                $name = $row[2];
                $name = strtolower($name);

                $name = trim($name);

                $part = array('/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/',
                    '/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/',
                    '/i|í|ì|ỉ|ĩ|ị/',
                    '/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/',
                    '/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/',
                    '/ý|ỳ|ỷ|ỹ|ỵ/',
                    '/đ/',
                    '/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/',
                    '/\s+/'
                );
                $arr = array('a', 'e', 'i', 'o', 'u', 'y', 'd', '', ' ');

                $slug = str_replace(' ', '-', preg_replace($part, $arr, $name));

                $search = $this->lib_mod->make_url($name . ' ' . $row[2]);

                $search = str_replace('-', ' ', $search);

                $data = array('name' => $row[2],
                    'courses_id' => $row[0],
                    'chapter_id' => $row[1],
                    'create_date' => time(),
                    'title' => $row[2],
                    'slug' => $slug,
                    'status' => 1,
                    'admin_id_add' => 35,
                    'hot' => 0,
                    'search' => $search,
                    'sort' => $row[3]
                );

                $this->learn_model->insert($data);
            }
        }
    }

    // thay đổi link video bằng danh sách trong file excel
    private function _import_attach_file_list($file_path) {
        $this->load->model('learn_model');
        $this->load->library('PHPExcel');
        $objPHPExcel = PHPExcel_IOFactory::load($file_path);
        $sheet = $objPHPExcel->getActiveSheet();
        $data1 = $sheet->rangeToArray('A2:B1000');
        foreach ($data1 as $row) {
            if ($row[0] != '') {
                $learn_id = $row[0];
                $where = array('id' => $learn_id);
                
                $attach_file = $row[1];
                $attach_file = trim($attach_file);
                $data = array('attach_file' => 'data/source/'.$attach_file);
              
                $this->learn_model->update($where,$data);
            }
        }
    }

}
