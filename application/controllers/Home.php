<?php

/*
  // 35 - toàn quyền
  // 36 - taichinh pass: taichinhlakita
  // 37 - hoclieu pass: hoclieulakita
  // 38 - support pass: supportlakita


 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function index() {
        $admin_id = $this->session->userdata('admin_id');
        if (!isset($admin_id) || empty($admin_id))
            redirect('home/login');

        $admin = $this->lib_mod->detail('admin', array('admin_id' => $admin_id));
        if (empty($admin))
            redirect('home/login');

        $data['content'] = 'home/index';
        $data['header'] = 'dash_header';
        $data['footer'] = 'dash_footer';
        $this->load->view('template', $data);
    }

    function login() {
        $this->session->sess_destroy();
        $this->load->view('home/login');
    }

    function action_login() {
        $username = trim($this->input->post('username'));
        $password = md5(md5($this->input->post('password')));

        $admin = $this->lib_mod->detail('admin', array('admin_name' => $username, 'admin_password' => $password, 'admin_status' => 1));

        if (count($admin)) {
           // $config = $this->lib_mod->detail('setting', array('id' => 1));

            $this->session->set_userdata('admin_id', $admin[0]['admin_id']);
            $this->session->set_userdata('admin_fullname', $admin[0]['admin_fullname']);
            $this->session->set_userdata('admin_thumbnail', $admin[0]['admin_thumbnail']);
            $this->session->set_userdata('admin_name', $admin[0]['admin_name']);
            $this->session->set_userdata('admin_email', $admin[0]['admin_email']);

            $this->session->set_userdata('title', $config[0]['name']);
            $this->session->set_userdata('logo', $config[0]['logo_admin']);
            $this->session->set_userdata('favicon', $config[0]['favicon']);

            redirect(site_url());
        } else {
            $this->session->set_flashdata('error', 'Tài khoản hoặc mật khẩu không đúng.');
            redirect('home/login');
        }
    }

    function reset_password() {
        $email = trim($this->input->post('email'));
    }

    function profile() {
        $admin_id = $this->session->userdata('admin_id');

        if (!isset($admin_id) || empty($admin_id)) {
            redirect('home/login');
        }

        $data['admin'] = $this->lib_mod->detail('admin', array("admin_id" => $admin_id));
        $data['content'] = 'profile/index';
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $this->load->view('template', $data);
    }

    function edit_profile() {
        $admin_id = $this->session->userdata('admin_id');

        if (!isset($admin_id) || empty($admin_id)) {
            redirect('home/login');
        }

        $edit = trim($this->input->post('edit'));
        $admin = $this->lib_mod->detail('admin', array("admin_id" => $admin_id));

        if (!empty($edit)) {


            $admin_name = trim($this->input->post('admin_name'));
            $admin_fullname = trim($this->input->post('admin_fullname'));

            $admin_email = trim($this->input->post('admin_email'));

            $name_exist = $this->lib_mod->count('admin', array("admin_id !=" => $admin_id, 'admin_name' => $admin_name));

            $email_exist = $this->lib_mod->count('admin', array("admin_id !=" => $admin_id, 'admin_email' => $admin_email));
            $error = '';

            if ($name_exist)
                $error = 'Tên tài khoản đã tồn tại';

            if ($email_exist)
                $error = 'Email đã tồn tại';

            $data = array(
                'admin_name' => $admin_name,
                'admin_email' => $admin_email,
                'admin_fullname' => $admin_fullname,
                'admin_phone' => trim($this->input->post('admin_phone')),
                'admin_address' => trim($this->input->post('admin_address')),
            );

            $new_password = trim($this->input->post('new_password'));

            $re_new_password = trim($this->input->post('re_new_password'));

            if (!empty($new_password) || !empty($re_new_password)) {
                if (empty($new_password) || empty($re_new_password)) {
                    $error = 'Bạn phải nhập mật khẩu mới';
                }
                if ($new_password != $re_new_password) {
                    $error = 'Mật khẩu xác nhận chưa chính xác';
                }
                if (strlen($new_password) < 6 || strlen($re_new_password) < 6) {
                    $error = 'Mật khẩu phải trên 6 kí tự';
                }
                $data['admin_password'] = md5(md5($new_password));
            }

            if (empty($error)) {
                if (!empty($_FILES['admin_thumbnail']['name'])) {
                    $image_news_path = realpath(APPPATH . "../data/avatar");
                    $image_thumb = $this->lib_mod->action_upload($image_news_path, 'admin_thumbnail');
                    $data['admin_thumbnail'] = 'data/avatar/' . $image_thumb['file_name'];
                    $this->session->unset_userdata('admin_thumbnail');
                    $this->session->set_userdata('admin_thumbnail', $data['admin_thumbnail']);
                    $this->session->set_userdata('admin_name', $data['admin_name']);
                    $this->session->set_userdata('admin_email', $data['admin_email']);
                }

                $action = 'Cập nhật tài khoản admin ' . $admin[0]['admin_name'] . ' thành ' . $data['admin_name'];
                $this->lib_mod->update('admin', array("admin_id" => $admin_id), $data);
                $this->lib_mod->insert_log($action, $admin_id);
                $this->session->unset_userdata('admin_fullname');
                $this->session->set_userdata('admin_fullname', $admin_fullname);

                $this->session->set_flashdata('success', 'Cập nhật tài khoản thành công');
                redirect('home/profile');
            } else {
                $this->session->set_flashdata('error', $error);
                redirect('home/edit_profile');
            }
        }
        $data['admin'] = $admin;
        $data['content'] = 'profile/edit';
        $data['header'] = 'edit_base_header';
        $data['footer'] = 'edit_base_footer';
        $this->load->view('template', $data);
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('home/login');
    }

    function set_numper_product($per_page) {
        $this->session->set_userdata('session_per_page', $per_page);
    }

    function get_slug() {
        $url = trim($this->input->post('url'));
        echo $this->lib_mod->make_url($url);
    }

    function download_via_url() {
        $admin_id = $this->session->userdata('admin_id');
        if (!isset($admin_id) || empty($admin_id))
            redirect('home/login');

        $file_attach = $this->input->post('file_attach');
        $key = $this->input->post('key');
        $okkey = $this->input->post('okkey');
        if ($key . 'AceTienDung' == $okkey) {
            $filename = explode('/', $file_attach);
            $filename = end($filename);
            $file_url = WEBSITE . $file_attach;
            $this->load->helper('download');
            $data = file_get_contents($file_url);
            $name = $filename;
            force_download($name, $data);
        } else {
            echo 0;
        }
    }

    function download_via_id($id = '') {
        $file = $this->mod_lib->detail('anhduthi', array('id' => $id));

        if (!count($file))
            redirect(site_url());

        $filename = end(explode('/', $file[0]['root']));
        $file_url = 'http://nhandantv.vn/ve-dep-viet-nam/' . $file[0]['root'];
        $this->load->helper('download');
        $data = file_get_contents($file_url);
        $name = $filename;
        force_download($name, $data);
    }

    function myupload() {
        $targetPath = UPLOAD . 'data/source/video_source/' . date('Y/m/d');
        $this->lib_mod->make_dir($targetPath);
        $token_input = $this->input->post('token');
        $token = $token_input . 'AceTienDung';
        $verifyToken = $this->input->post('verifyToken');
        if (!empty($_FILES) && $token == $verifyToken) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $extend = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
            $nice_name = $this->lib_mod->make_url($_FILES['Filedata']['name']) . '-' . rand() . 'ChuyenPN' . '.' . $extend;
            $targetFile = rtrim($targetPath, '/') . '/' . $nice_name;

            // Validate the file type
            $fileTypes = array('flv', 'mp4', 'avi'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                echo str_replace(UPLOAD, '', $targetFile);
            } else {
                echo '0';
            }
        }
    }

    function curr_segment() {
        $this->load->library('session');
        $segment = $this->input->post('curr');
        $page = $this->input->post('page');
        
        
        
        if ($page == 'learn') {
            $this->session->set_userdata(array('curr_segment_learn' => $segment));
        } elseif ($page == 'course') {
            $this->session->set_userdata(array('curr_segment_course' => $segment));
        } elseif ($page == 'student') {
            $this->session->set_userdata(array('curr_segment_student' => $segment));
        } elseif ($page == 'news') {
            $this->session->set_userdata(array('curr_segment_news' => $segment));
        } elseif ($page == 'chapter') {
            $this->session->set_userdata(array('curr_segment_chapter' => $segment));
        } elseif ($page == 'examination') {
            $this->session->set_userdata(array('curr_segment_examination' => $segment));
        } elseif ($page == 'vote') {
            $this->session->set_userdata(array('curr_segment_vote' => $segment));
        }
        echo $segment;
    }

}
