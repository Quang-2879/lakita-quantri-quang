<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BaoCaoVanHanhHocVien extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('report_mod');

        ini_set('memory_limit', '1024M');
        $this->load->database();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
    }

    public function long_time_no_onl() {
        $this->load->model('student_model');
        $this->load->library('pagination');
        $per_page = 10;
        $session_per_page = $this->session->userdata('session_per_page');
        if (isset($session_per_page) && $session_per_page > 0)
            $per_page = $session_per_page;

        $no_learn = 0;
        $session_no_learn = $this->session->userdata('session_no_learn');
        if (isset($session_no_learn) && $session_no_learn > 0)
            $no_learn = $session_no_learn;

        // var_dump($this->uri->segment(3));die;
        // query học viên đã kích hoạt khóa học nhưng chưa học và đã học nhưng chưa vào học lại từ 3 đến 6 tháng
        if ($no_learn = 0) {
            $a1 = ' SELECT DISTINCT(`tbl_student_courses`.`student_id`)
                FROM `tbl_student_courses`
                WHERE `tbl_student_courses`.`student_id` NOT IN (
                SELECT DISTINCT(`tbl_student_learn`.`student_id`)
                    FROM `tbl_student_learn`   
                )  
                ORDER BY `id` DESC';

            $a2 = ' SELECT DISTINCT(`tbl_student_courses`.`student_id`)
                FROM `tbl_student_courses`
                WHERE `tbl_student_courses`.`student_id` NOT IN (
                SELECT DISTINCT(`tbl_student_learn`.`student_id`)
                    FROM `tbl_student_learn`   
                )
                ORDER BY `id` DESC
                LIMIT ' . $per_page;
                if ($this->uri->segment(3) != NULL) {
                    $a2 .= ' OFFSET ' . $this->uri->segment(3);
                }
        }  elseif ($no_learn = 1) {
            $a1 = ' SELECT DISTINCT(`tbl_student_courses`.`student_id`)
                FROM `tbl_student_courses`
                WHERE `tbl_student_courses`.`student_id` in (
                    select DISTINCT(`tbl_student_learn`.`student_id`)
                    from `tbl_student_learn`
                    where `tbl_student_learn`.`time` =
                    (
                      select Max(time)
                      from `tbl_student_learn` as f where f.student_id=`tbl_student_learn`.`student_id`
                    )
                    and '.(time()-7889231).' <=`tbl_student_learn`.`time` AND  `tbl_student_learn`.`time` <= '.(time() - 15778463 ).'

                    group by f.student_id
                )
                ORDER BY `id` DESC';
            $a2 = ' SELECT DISTINCT(`tbl_student_courses`.`student_id`)
                FROM `tbl_student_courses`
                WHERE `tbl_student_courses`.`student_id` in (
                    select DISTINCT(`tbl_student_learn`.`student_id`)
                    from `tbl_student_learn`
                    where `tbl_student_learn`.`time` =
                    (
                      select Max(time)
                      from `tbl_student_learn` as f where f.student_id=`tbl_student_learn`.`student_id`
                    )
                    and '.(time()-7889231).' <=`tbl_student_learn`.`time` AND  `tbl_student_learn`.`time` <= '.(time() - 15778463 ).'

                    group by f.student_id
                )
                ORDER BY `id` DESC
                LIMIT ' . $per_page;
                if ($this->uri->segment(3) != NULL) {
                    $a2 .= ' OFFSET ' . $this->uri->segment(3);
                }
        }elseif ($no_learn = 2) {
            $a1 = ' SELECT DISTINCT(`tbl_student_courses`.`student_id`)
                FROM `tbl_student_courses`
                WHERE `tbl_student_courses`.`student_id` in (
                    select DISTINCT(`tbl_student_learn`.`student_id`)
                    from `tbl_student_learn`
                    where `tbl_student_learn`.`time` =
                    (
                      select Max(time)
                      from `tbl_student_learn` as f where f.student_id=`tbl_student_learn`.`student_id`
                    )
                    and '.(time()-15778463).' <=`tbl_student_learn`.`time` AND  `tbl_student_learn`.`time` <= '.(time() - 31556926 ).'

                    group by f.student_id
                )
                ORDER BY `id` DESC';
            $a2 = ' SELECT DISTINCT(`tbl_student_courses`.`student_id`)
                FROM `tbl_student_courses`
                WHERE `tbl_student_courses`.`student_id` in (
                    select DISTINCT(`tbl_student_learn`.`student_id`)
                    from `tbl_student_learn`
                    where `tbl_student_learn`.`time` =
                    (
                      select Max(time)
                      from `tbl_student_learn` as f where f.student_id=`tbl_student_learn`.`student_id`
                    )
                    and '.(time()-15778463).' <=`tbl_student_learn`.`time` AND  `tbl_student_learn`.`time` <= '.(time() - 31556926 ).'

                    group by f.student_id
                )
                ORDER BY `id` DESC
                LIMIT ' . $per_page;
                if ($this->uri->segment(3) != NULL) {
                    $a2 .= ' OFFSET ' . $this->uri->segment(3);
                }
        }elseif ($no_learn = 3) {
            $a1 = ' SELECT DISTINCT(`tbl_student_courses`.`student_id`)
                FROM `tbl_student_courses`
                WHERE `tbl_student_courses`.`student_id` in (
                    select DISTINCT(`tbl_student_learn`.`student_id`)
                    from `tbl_student_learn`
                    where `tbl_student_learn`.`time` =
                    (
                      select Max(time)
                      from `tbl_student_learn` as f where f.student_id=`tbl_student_learn`.`student_id`
                    )
                    and '.(time()-31556926).' <=`tbl_student_learn`.`time`

                    group by f.student_id
                )
                ORDER BY `id` DESC';
            $a2 = ' SELECT DISTINCT(`tbl_student_courses`.`student_id`)
                FROM `tbl_student_courses`
                WHERE `tbl_student_courses`.`student_id` in (
                    select DISTINCT(`tbl_student_learn`.`student_id`)
                    from `tbl_student_learn`
                    where `tbl_student_learn`.`time` =
                    (
                      select Max(time)
                      from `tbl_student_learn` as f where f.student_id=`tbl_student_learn`.`student_id`
                    )
                    and '.(time()-31556926).' <=`tbl_student_learn`.`time`

                    group by f.student_id
                )
                ORDER BY `id` DESC
                LIMIT ' . $per_page;
                if ($this->uri->segment(3) != NULL) {
                    $a2 .= ' OFFSET ' . $this->uri->segment(3);
                }
        }


        

        $a3 = $this->db->query($a1);
        $result = $a3->result_array();
        $total = count($result);

        $a4 = $this->db->query($a2);
        $result2 = $a4->result_array();
        $array = array();
        foreach ($result2 as $value) {
            $array[] = $value['student_id'];
        }

        $input = array();
        $input['where_in']['id'] = $array;

        $data['rows'] = $this->student_model->load_all($input);
        $base_url = site_url('BaoCaoVanHanhHocVien/long_time_no_onl/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();
        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'BaoCaoVanHanhHocVien/long_time_no_onl';
        $data['courses'] = $this->lib_mod->load_all('courses', 'id, name', array('status' => 1), '', '', array('sort' => 'desc'));
        $this->load->view('template', $data);
    }

    public function index() {
        $admin_id = $this->session->userdata('admin_id');
        if (!isset($admin_id) || empty($admin_id))
            redirect('home/login');

        $admin = $this->lib_mod->detail('admin', array('admin_id' => $admin_id));
        if (empty($admin))
            redirect('home/login');

        $data = array();
        $current_day = date('d/m/Y');
        $ngay = date_parse_from_format('d/m/Y', $current_day);
        $time1 = mktime(0, 0, 0, $ngay['month'], $ngay['day'], $ngay['year']);
        $time2 = mktime(24, 0, 0, $ngay['month'], $ngay['day'], $ngay['year']);
        $start = $time1;
        $end = $time2;

        $day1 = $this->input->post('date1');
        $day2 = $this->input->post('date2');
        if ($day1) {
            $date1 = date_parse_from_format('d/m/Y', $day1);
            $timeStampe1 = mktime(0, 0, 0, $date1['month'], $date1['day'], $date1['year']);
            $start = $timeStampe1;
        }
        if ($day2) {
            $date1 = date_parse_from_format('d/m/Y', $day2);
            $timeStampe2 = mktime(24, 0, 0, $date1['month'], $date1['day'], $date1['year']);
            $end = $timeStampe2;
        }
        $list = $this->report_mod->tongkh($start, $end);
        $list2 = $this->report_mod->motvideo($start, $end);
        $list3 = $this->report_mod->muoivideo($start, $end);
        $list4 = $this->report_mod->allvideo($start, $end);
        $list5 = $this->report_mod->cmt_support($start, $end);
        $list12 = $this->report_mod->cmt_nosupport($start, $end);
        $list6 = $this->report_mod->camnhan($start, $end);
        $list7 = $this->report_mod->fivestar($start, $end);
        $list8 = $this->report_mod->forstar($start, $end);
        $list9 = $this->report_mod->threestar($start, $end);
        $list10 = $this->report_mod->twostar($start, $end);
        $list11 = $this->report_mod->onestar($start, $end);
        $data['start'] = $day1;
        $data['end'] = $day2;
        $data['motvideo'] = $list2;
        $data['muoivideo'] = $list3;
        $data['allvideo'] = $list4;
        $data['cmt_support'] = $list5;
        $data['cmt_nosupport'] = $list12;
        $data['camnhan'] = $list6;
        $data['fivestar'] = $list7;
        $data['forstar'] = $list8;
        $data['threestar'] = $list9;
        $data['twostar'] = $list10;
        $data['onestar'] = $list11;
        $data['tongkh'] = ($list);

        $this->load->view('BaoCaoVanHanhHocVien/baocao', $data);
    }

    function in() {
        $a1 = 'SELECT * FROM `tbl_student`';
        $a2 = $this->db->query($a1);
        $data['student'] = $a2->result_array();

        $e1 = 'SELECT student_id,courseID, COUNT(*) AS dem FROM `tbl_student_learn` WHERE courseID IN (72,71,66) GROUP BY student_id,courseID';
        $e2 = $this->db->query($e1);
        $data['dem_bai'] = $e2->result_array();
        $b1 = 'SELECT * FROM `tbl_student_courses` where `courses_id` = 72';
        $b2 = $this->db->query($b1);
        $data['khoa72'] = $b2->result_array();
        $c1 = 'SELECT * FROM `tbl_student_courses` where `courses_id` = 71';
        $c2 = $this->db->query($c1);
        $data['khoa72'] = $c2->result_array();
        $d1 = 'SELECT * FROM `tbl_student_courses` where `courses_id` = 66';
        $d2 = $this->db->query($d1);
        $data['khoa72'] = $d2->result_array();



        $data['content'] = 'BaoCaoVanHanhHocVien/index';
        $data['header'] = 'dash_header';
        $data['footer'] = 'list_base_footer';
        $this->load->view('template', $data);
    }

    function report_active_cod() {
        $admin_id = $this->session->userdata('admin_id');
        if (!isset($admin_id) || empty($admin_id))
            redirect('home/login');

        $admin = $this->lib_mod->detail('admin', array('admin_id' => $admin_id));
        if (empty($admin))
            redirect('home/login');

        $data = array();

        $get = $this->input->get();

        if (!empty($get)) {
            $data['start_date'] = $start_date = $get['start_date'];
            $data['end_date'] = $end_date = $get['end_date'];
        } else {
            $start_date = '';
            $end_date = '';
        }


        if (!empty($start_date) && !empty($end_date)) {
            $start_date = explode('-', $start_date);
            $start_date = mktime(0, 0, 1, $start_date[1], $start_date[0], $start_date[2]);
            $end_date = explode('-', $end_date);
            $end_date = mktime(0, 0, 1, $end_date[1], $end_date[0], $end_date[2]);
        } elseif (isset($start_date) && !isset($end_date)) {
            $start_date = explode('-', $start_date);
            $start_date = mktime(0, 0, 1, $start_date[1], $start_date[0], $start_date[2]);
            $end_date = strtotime();
        } elseif (!isset($start_date) && isset($end_date)) {
            $start_date = strtotime(date('Y-m-1 0:0:1'));
            $end_date = explode('-', $end_date);
            $end_date = mktime(0, 0, 1, $end_date[1], $end_date[0], $end_date[2]);
        } else {
            $start_date = strtotime(date('Y-m-1 0:0:1'));
            $end_date = time();
        }



        echo 'http://thanhloc.com/lakita-crm/api/get_contact?start_date=' . $start_date . '&end_date=' . $end_date;
        die;
        $contact = file_get_contents('http://thanhloc.com/lakita-crm/api/get_contact?start_date=' . $start_date . '&end_date=' . $end_date);
        $contact = json_decode($contact, true);


        foreach ($contact as $key => $value) {


            if ($this->_checkactive($value['email'], $value['phone'], $value['course_code']) != FALSE) {
                $contact[$key]['active'] = 'x';
                $contact[$key]['student_id'] = $this->_checkactive($value['email'], $value['phone'], $value['course_code']);

                $da_kich_hoat = $this->_checkactive($value['email'], $value['phone'], $value['course_code']);
                $student_id = array_shift($da_kich_hoat);
                foreach ($da_kich_hoat as $key1 => $value1) {
                    $student1 = array();
                    $student1['name'] = $value['name'];
                    $student1['email'] = $value['email'];
                    $student1['phone'] = $value['phone'];
                    $student1['active'] = 'x';
                    $student1['student_id'] = $student_id;
                    $student1['course_code'] = $this->_getcoursecode($value1);
                    $student1['count_learn'] = $this->_count_learn($student_id, $value1);
                    if ($student1['course_code'] == $value['course_code']) {
                        $student1['price_purchase'] = $value['price_purchase'];
                        $student1['date_rgt'] = $value['date_rgt'];
                        if ($value['date_receive_lakita'] != 0) {
                            $student1['date'] = $value['date_receive_lakita'];
                        } elseif ($value['date_receive_cod'] != 0) {
                            $student1['date'] = $value['date_receive_cod'];
                        } else {
                            $student1['date'] = 0;
                        }
                    }

                    $student[] = $student1;
                }
            } else {
                $student1 = array();
                $student1['name'] = $value['name'];
                $student1['email'] = $value['email'];
                $student1['phone'] = $value['phone'];
                $student1['active'] = '';
                $student1['student_id'] = '';
                $student1['course_code'] = $value['course_code'];
                $student1['count_learn'] = 0;
                $student1['price_purchase'] = $value['price_purchase'];
                $student1['date_rgt'] = $value['date_rgt'];
                if ($value['date_receive_lakita'] != 0) {
                    $student1['date'] = $value['date_receive_lakita'];
                } elseif ($value['date_receive_cod'] != 0) {
                    $student1['date'] = $value['date_receive_cod'];
                } else {
                    $student1['date'] = 0;
                }
                $student[] = $student1;
            }
        }


        $data['content'] = 'baocaovanhanhhocvien/report_active_cod';
        $data['header'] = 'edit_base_header';
        $data['footer'] = 'edit_base_footer';
        $data['student'] = $student;
        $this->load->view('template', $data);
    }

    function _getcoursecode($course_id) {
        $this->load->model('courses_model');
        $input['where'] = array('id' => $course_id);
        $input['select'] = 'course_code';
        $code = $this->courses_model->load_all($input);
        return $code[0]['course_code'];
    }

    function _checkactive($email = '', $phone = '', $course_code = '') {
        $this->load->model('student_model');
        $this->load->model('courses_model');

        $course = $this->courses_model->load_all(array('where' => array('course_code' => $course_code)));

        if (empty($course)) {
            return FALSE;
        }


        $input['select'] = 'id';
        if ($email != '' && $email != 'lakita.vn@gmail.com' && $email != 'lakitavn@gmail.com' && $email != 'lakita@lakita.vn' && $email != 'LAKITAVN@GMAIL.COM' && $email != 'VN' && $phone != '') {
            $input['where'] = array('email' => $email);
            $input['or_where'] = array('phone' => $phone);
        } elseif ($email != '' && $email != 'lakita.vn@gmail.com' && $email != 'lakitavn@gmail.com' && $email != 'lakita@lakita.vn' && $email != 'LAKITAVN@GMAIL.COM' && $email != 'VN') {
            $input['where'] = array('email' => $email);
        } elseif ($phone != '') {
            $input['where'] = array('phone' => $phone);
        }
        $student_id = $this->student_model->load_all($input);
        if (!empty($student_id)) {
            $this->load->model('student_courses_model');
            $input_student_course['where'] = array('student_id' => $student_id[0]['id'], 'courses_id' => $course[0]['id']);
            $student_courses = $this->student_courses_model->load_all($input_student_course);
            if (!empty($student_courses)) {
                $test = array();
                $test[] = $student_id[0]['id'];
                foreach ($student_courses as $key => $value) {
                    $test[] = $value['courses_id'];
                }
                return $test;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function _checkcomment($student_id) {
        $this->load->model('comment_model');
        $input['select'] = 'id';
        $input['where'] = array('student_id' => $student_id);
        $input['limit'] = array(1, 0);
        $comment = $this->comment_model->load_all($input);
        if (!empty($comment)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _checkexercise($student_id) {
        $this->load->model('exercise_model');
        $input['select'] = 'id';
        $input['where'] = array('student_id' => $student_id);
        $input['limit'] = array(1, 0);
        $exercise = $this->exercise_model->load_all($input);
        if (!empty($exercise)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _count_learn($student_id) {
        $this->load->model('student_courses_model');
        $this->load->model('student_learn_model');
        $this->load->model('learn_model');

        $input = array();
        $input['where']['student_id'] = $student_id;
        $courses_list = $this->student_courses_model->load_all($input);
        $result = FALSE;
        foreach ($courses_list as $c_value) {
            $input = array();
            $input['where']['courses_id'] = $c_value['courses_id'];
            $input['where']['status'] = 1;
            $learn_num = count($this->learn_model->load_all($input));

            $input = array();
            $input['where']['student_id'] = $student_id;
            $input['where']['courseID'] = $c_value['courses_id'];
            $learned = count($this->student_learn_model->load_all($input));

            $percent = $learned / $learn_num * 100;
            if ($percent >= 20) {
                $result = TRUE;
                break;
            }
        }
        return $result;
    }

    public function report_student_learn() {




        $get = $this->input->get();



        $S0 = 0; //đã mua khóa học
        $S1a = array(); // đã kích hoạt
        $S1b = array(); // đã xem 20% thời gian 1 bài giảng
        $S1 = 0; //đã sử dụng hệ thống
        $S2a = array(); //xem 2 bài/tuần
        $S2b = array(); //đã tải tài liệu
        $S2c = array(); //đã nộp bài
        $S2d = array(); //đã hỏi, comment
        $S2 = 0; // đã tương tác với hệ thống
        $S3a = array(); //xem trên 20% bài giảng
        $S3b = array(); //khen ngợi, cảm ơn
        $S3 = 0; //đã thích hệ thống
        $S4a = array(); //mua từ 2 khóa học trở lên
        $S4b = array(); //làm đc việc trước đây gặp khó khăn
        $S4 = 0; //đã sướng
        $S5a = array(); //giới thiệu
        $S5b = array(); // mua từ 2 lần trở lên
        $S5 = 0; //đã hành động
        //    1526680480
        $list = file_get_contents('https://crm2.lakita.vn/api/get_contact_and_contact_active?start_date=0&end_date=' . time());
        $list = json_decode($list, true);
        $custumer_bought = $list['da_mua'];
        $custumer_active = $list['da_kich_hoat'];
        $custumer_2courses = $list['mua_tren_2'];
        $custumer_rebuy = $list['mua_lai'];




        foreach ($custumer_active as $a_key => $a_value) {
            if ($this->_checkexercise($a_value['id_lakita'])) {
                $S2c[] = $a_value;
            }
            if ($this->_checkcomment($a_value['id_lakita'])) {
                $S2d[] = $a_value;
            }
            if ($this->_count_learn($a_value['id_lakita'])) {
                $S3a[] = $a_value;
            }
        }

        $S0 = count($custumer_bought);
        $S1a = count($custumer_active);
        $S1b = count($S1b);
        $S1 = $S1a + $S1b;
        $S2a = count($S2a);
        $S2b = count($S2b);
        $S2c = count($S2c);
        $S2d = count($S2d);
        $S2 = $S2a + $S2b + $S2c + $S2d;
        $S3a = count($S3a);
        $S3b = count($S3b);
        $S3 = $S3a + $S3b;
        $S4a = count($custumer_2courses);
        $S4b = count($S4b);
        $S4 = $S4a + $S4b;
        $S5a = count($S5a);
        $S5b = count($custumer_rebuy);
        $S5 = $S5a + $S5b;

        $report = array(
            'S0' => array('Đã mua khóa học', $S0, 'parent'),
            'S1a' => array('Đã kích hoạt', $S1a, 'child'),
            'S1b' => array('Đã xem 20% thời gian 1 bài giảng', $S1b, 'child'),
            'S1' => array('Đã sử dụng hệ thống', $S1, 'parent'),
            'S2a' => array('Xem 2 bài/tuần', $S2a, 'child'),
            'S2b' => array('Đã tải tài liệu', $S2b, 'child'),
            'S2c' => array('Đã nộp bài', $S2c, 'child'),
            'S2d' => array('Đã hỏi, comment', $S2d, 'child'),
            'S2' => array('Đã tương tác với hệ thống', $S2, 'parent'),
            'S3a' => array('Xem trên 20% bài giảng', $S3a, 'child'),
            'S3b' => array('Khen ngợi, cảm ơn', $S3b, 'child'),
            'S3' => array('Đã thích hệ thống', $S3, 'parent'),
            'S4a' => array('Mua từ 2 khóa học trở lên', $S4a, 'child'),
            'S4b' => array('Làm đc việc trước đây gặp khó khăn', $S4b, 'child'),
            'S4' => array('Đã sướng', $S4, 'parent'),
            'S5a' => array('Giới thiệu', $S5a, 'child'),
            'S5b' => array('Mua từ 2 lần trở lên', $S5b, 'child'),
            'S5' => array('Đã hành động', $S5, 'parent')
        );

        $data['report'] = $report;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'BaoCaoVanHanhHocVien/report_student_learn';
        $this->load->view('template', $data);



//        echo '<pre>';
//        print_r($S4a);
    }

    function test1() {
        $a = array('nguyenhoak54@gmail.com',
            'mrhoang84@gmail.com',
            'rubby_82@yahoo.com.vn',
            'dinhhued3ktb@gmail.com',
            'phamhien90htv@gmail.com',
            'phamanhhoa_dalat@yahoo.com.vn',
            'trangyunho2809@gmail.com',
            'tannghia1977@gmail.com',
            'quyetdam20@gmail.com',
            'ngango270878@gmail.com',
            'trantanvinhmytv2006@gmail.com',
            'hnm.sales1@gmail.com',
            'hoangngattl@gmail.com',
            'badong150393@gmail.com',
            'nguyencuu83@gmail.com',
            'nguyennhumai1990@gmail.com',
            'phunghe86@yahoo.com.vn',
            'thuha1602@gmail.com',
            'thien.gar@gmail.com',
            'hanhxd80@gmail.com',
            'chuviet.le.ketoan@gmail.com',
            'ntsang1501@gmai.com',
            'mr.chu0ng2411@gmail.com',
            'tranlam6667@gmail.com',
            'stockflower83@gmail.com',
            'thevuiphan@yahoo.com.vn',
            'nguyennhungk38@gmail.com',
            'soannguyen2204@gmail.com',
            'vanln@vietinbank.vn',
            'nguyennhatanh4466@gmail.com',
            'ngocquynh0908bn@gmail.com',
            'theptienphathp@gmail.com',
            'giangnguyenh2@gmail.com',
            'seagift.le@gmail.com',
            'vietvien91@gmail.com',
            'duclam1606@gmail.com',
            'mangiabao1993@gmail.com',
            'Nhatlinhh83qk4@gmail.com',
            'vtrang293@gmail.com',
            'dothom310@gmail.com',
            'bk.hmtien1994@gmail.com',
            'dinhhongngocdhtm@gmail.com',
            'ongchusip@gmail.com',
            'hoangsongiang.1992@gmail.com',
            'vancuong.08hcmus@gmail.com',
            'camchanhchua@gmail.com',
            'hoatrangdai90@gmail.com',
            'levan01051984@gmail.com',
            'tranngan1810@gmail.com',
            'hongvan198189@gmail.com',
            'huenguyentcna@gmail.com',
            'huule3761@gmail.com',
            'linhnguyenphar54@gmail.com',
            'matnhatmau@yahoo.com',
            'hoangtoan8387@yahoo.com.vn',
            'duongtrinh.txth@gmail.com',
            'kalumusuku@gmail.com',
            'honguyen26@gmail.com',
            'huonggiang.sbv@gmail.com',
            'phamthihue0611@gmail.com',
            'namnguyenfcbc@gmail.com',
            'tanthuongmai228@gmail.com',
            'huongptexv@gmail.com',
            'lanhjenbuh2807@gmail.com',
            'hoangevn83@gmail.com',
            'lieu0579@yahoo.com',
            'vuthithuhuong.c3chuyenlongan@longan.edu.vn',
            'lyhuanminh@yahoo.com.vn',
            'trang.thaonguyen2015@gmail.com',
            'ctyphuminhminh@gmail.com',
            'batmanletruc@gmail.com',
            'duongthanhnhan.epu@gmail.com',
            'songnguyen1205@gmail.com',
            'thaonguyen.130793@gmail.com',
            'minhduonghcth@yahoo.com.vn',
            'thuygta@gmail.com',
            'bichvan85hn@gmail.com',
            'luongpham3011@gmail.com.vn',
            'quyengt2@gmail.com',
            'trang.thaonguyen2015@gmail.com',
            'hoangchau9399@gmail.com',
            'nhungmanhdung@gmail.com',
            'duong.hphn@gmail.com',
            'thaophuong.12694@gmail.com',
            'phi.ctk37@gmail.com',
            'nhthuc83@gamil.com',
            'lesa67890@gmail.com',
            'nguyenngoclan23.03@gmail.com',
            'hanh.hiraiwa@gmail.com',
            'thuydungkhkt@gmail.com',
            'anhnk@nhietdienankhanhbacgiang.com.vn',
            'Phamtoanthang3006@gmail.com',
            'anhdung1294@gmail.com',
            'dieuhuong1305@gmail.com',
            'anhntuhy@gmail.com',
            'trieulanhuongkttn@gmaim.com',
            'hoangocdung88@gmail.com',
            'hongle3011@gmail.com',
            'anhtuanjsc.vn@gmail.com',
            'Kimthanh.kt10@gmail.com',
            'minhhanh.lc@gmail.com',
            'hieuthuy128@gmail.com',
            'Dinhthuongvu.tb@gmail.com',
            'khuyenvuvu90@gmail.com',
            'hoangvantin1993@gmail.com',
            'phungthelam1996@gmail.com',
            'youci.thang@gmail.com',
            'contacttongdai@gmail.com',
            'toan.nguyen.dona@gmail.com',
            'hanh69pidi@gmail.com',
            'vanhoaxddd@gmail.com',
            'nxuan3209@gmail.com',
            'duyennguyen.vtg@gmail.com',
            'thuy3mc@gmail.com',
            'QUANGCTM7@GMAIL.COM',
            'thuy3mc@gmail.com',
            'Vananhdhcd@gmail.com',
            'lethiminh1424@gmail.com',
            'yennx1207@gmail.com',
            'buidong20051993@gmail.com',
            'daothutrang88@gmail.com',
            'vuanhtuan1979@gmail.com',
            'hieulv318@gmail.com',
            'ngocxuan2727@yahoo.com.vn',
            'hanhuynh2013@gmail.com',
            'lluonghang@gmail.com',
            'minhquan18791@gmail.com',
            'phamthu1917@gmail.com',
            'nghoa.th@gmail.com',
            'pvthanhnano@gmail.com',
            'thanhlong0793@gmail.com',
            'tranthituoi201185@gmail.com',
            'huantran1213@gmail.com',
            'Tientv910@gmail.com',
            'phucand@gmail.com',
            'tuyethanh212@gmail.com',
            'dtkt010@gmail.com',
            'nguyenquynhnga.5894@gmail.com',
            'mai.fam2601@gmail.com',
            'trongdung_2105@yahoo.com',
            'trangnguyen.215@gmail.com',
            'thanhphuong111985@gmail.com',
            'lekimthanh@gmail.com',
            'Vananhdhcd@gmail.com',
            'lehan.vp@gmail.com',
            'quyengt2@gmail.com',
            'huyenthanhhg76@gmail.com',
            'thuyliennguyen65@gmail.com',
            'nguyenthuyhang8336@gmail.com',
            'phuonganh.huynh78@gmail.com',
            'Hong.nb288@gmail.com',
            'lephuonglan.hh1368@gmail.com',
            'nguyenluyen2205@gmail.com',
            'lephuong010284@gmail.com',
            'haidangphm@gmail.com',
            'hongkienqn@gmail.com',
            'tothuylinh85@gmail.com',
            'phuongntl.87@gmail.com',
            'nguyenlanhuong.mp@gmail.com',
            'vothuytrang3589@gmail.com',
            'thuha46hvtc@gmail.com',
            'tttung999@gmail.com',
            'quynhhuongktcd@gmail.com',
            'quyenvukt85@gmail.com',
            'techoffice.vn@gmail.com',
            'duynq1979@gmail.com',
            'nguyenluyen2205@gmail.com',
            'nguyenluyen2205@gmail.com');
        $c = array(
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'E100',
            'CB100',
            'E200',
            'E100',
            'E100',
            'E400',
            'CB100',
            'E100',
            'E100',
            'E300',
            'E100',
            'E100',
            'CB100',
            'E100',
            'CB100',
            'CB100',
            'E100',
            'CB100',
            'CB100',
            'CB100',
            'E100',
            'E100',
            'CB100',
            'E400',
            'E100',
            'E100',
            'E100',
            'E100',
            'E200',
            'CB100',
            'E100',
            'E100',
            'E100',
            'E400',
            'E100',
            'TC100',
            'CB100',
            'E100',
            'KT100',
            'E400',
            'E100',
            'KT200',
            'KT100',
            'E200',
            'KT100',
            'E400',
            'KT100',
            'E100',
            'KT300',
            'KT100',
            'E100',
            'KT300',
            'KT300',
            'KT300',
            'KT300',
            'E100',
            'CB100',
            'E400',
            'E100',
            'KT300',
            'KT300',
            'KT300',
            'E100',
            'E300',
            'KT300',
            'E400',
            'KT300',
            'KT300',
            'KT300',
            'KT300',
            'KT300',
            'KT300',
            'KT300',
            'KT100',
            'KT400',
            'E400',
            'KT300',
            'E300',
            'EM100',
            'EM100',
            'E100',
            'KT400',
            'E100',
            'E100',
            'E100',
            'E200',
            'KT600',
            'E100',
            'KT200',
            'KT400',
            'E100',
            'E400',
            'E100',
            'E100',
            'E100',
            'KT600',
            'KT210',
            'KT800',
            'E100',
            'KT300',
            'E300',
            'KT210',
            'E100',
            'EM100',
            'KT110',
            'E100',
            'E100',
            'E100',
            'KT130',
            'E100',
            'E300',
            'KT110',
            'KT800',
            'KT130',
            'KT110',
            'E100',
            'KT110',
            'E400',
            'KT800',
            'KT400',
            'KT210',
            'KT800',
            'E100',
            'KT210',
            'KT800',
            'KT800',
            'KT400',
            'KT800',
            'KT210',
            'KT210',
            'KT400',
            'KT400',
            'KT800',
            'KT210',
            'E400',
            'KT210',
            'KT400',
            'KT800',
            'KT400',
            'KT800',
            'KT800'
        );

        $d = array_combine($a, $c);

        $b = array();
        foreach ($d as $key => $value) {
            $x = '';
            if ($this->_checkactive($value, '', $value)) {
                $x = 'rồi';
            } else {
                $x = 'chưa';
            }
            $b[] = array($key, $x);
        }

        echo '<pre>';
        print_r($b);
    }

}
