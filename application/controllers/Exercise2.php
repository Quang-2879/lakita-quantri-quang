<?php

//------------------------
// project : omegamart
// coder: acetiendung
// time : 14/12/2011
//------------------------
class Exercise extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_id = $this->session->userdata('admin_id');
        if (!isset($this->admin_id) || empty($this->admin_id)) {
            redirect('home/login');
        }
    }

    function index() {
    

        $this->load->library('pagination');
        $per_page = 15;
        
        
        
        $total = $this->lib_mod->count('exercise', array());
        $data['rows'] = $this->lib_mod->load_all('exercise', '', array(), $per_page, $this->uri->segment(3), array('id' => 'desc'));
        $base_url = site_url('exercise/index/');
        $config['base_url'] = $base_url;
        $config['per_page'] = $per_page;
        $config['total_rows'] = $total;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();

        $data['total'] = $total;
        $data['header'] = 'list_base_header';
        $data['footer'] = 'list_base_footer';
        $data['content'] = 'exercise/index';
        $data['student'] = $this->lib_mod->load_all('student', 'id, name', '', '', '', '');
        $data['bai']= $this->lib_mod->load_all('learn', 'id, name', '', '', '', '', '');
        $data['khoa']=  $this->lib_mod->load_all('courses','id,name', array('status' => 1), '', '', '', '');
        $data['bai_chua']= $this->lib_mod->load_all('exercise_repair', 'exe_id, note', '', '', '', '', '');
        $this->load->view('template', $data);
    }
    
    function action_upload() {
        
        $a=$this->input->post('exe_id');
        $kiemtra = $this->lib_mod->detail('exercise_repair', array('exe_id' => $a));
       $user_id = $this->input->post('student_id');
        if(!empty($kiemtra)){
            $note_repair = $this->input->post('note_repair');
            
        if ($this->input->post("ok") == 'Upload') {
            
            $dir = '/home/lakita.com.vn/public_html/data/source/student/repair_exercise/'. $user_id;
            
            
            //kiem tra folder co to tai khong
            if (!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir);
            }
            $data['exe_id'] = $this->input->post('exe_id');
            
             

            
            $config['upload_path'] =$dir;
            $config['allowed_types'] = 'xls|xlsx|mp4';
            $config['max_size'] = '9000000000';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('bai_chua')) {
                $check = $this->upload->data();
                $data['url_bai_chua'] = $user_id . '/'. $check['file_name'];
                
                if ($this->upload->do_upload('dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_chua_chuan'] = $user_id . '/'. $check1['file_name'];

                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("Sửa bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    
                    }  else {
                     $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("Sửa bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                     
                    }
                
                } else {
                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("Sửa bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    
                    }  else {
                     $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("Sửa bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                      
                    }
                }
            } elseif ($this->upload->do_upload('dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_chua_chuan'] = $user_id . '/'. $check1['file_name'];

                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("sửa bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    
                    }  else {
                     $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("Sửa bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                     
                    }
                
                } else {
                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    
                    }  else{
                        if (empty($note_repair)) {
                            $data['note'] = $this->input->post('note');
                            $this->lib_mod->update('exercise_repair', array('exe_id' => $a),$data);
                        echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        die;  
                        } 
                    }
                }             
            } 
            
        }else{
            
 
        if ($this->input->post("ok") == 'Upload') {
           
            $dir = '/home/lakita.com.vn/public_html/data/source/student/repair_exercise/'. $user_id;
            
            
            //kiem tra folder co to tai khong
            if (!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir);
            }
            $data['exe_id'] = $this->input->post('exe_id');
            $data['note'] = $this->input->post('note');
             

            
            $config['upload_path'] =$dir;
            $config['allowed_types'] = 'xls|xlsx|mp4';
            $config['max_size'] = '9000000000';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('bai_chua')) {
                $check = $this->upload->data();
                $data['url_bai_chua'] = $user_id . '/'. $check['file_name'];
                
                if ($this->upload->do_upload('dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_chua_chuan'] = $user_id . '/'. $check1['file_name'];

                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->insert('exercise_repair', $data);
                    echo "<script>alert('Tải bài chữa thành công !'); </script>";
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    
                    }  else {
                     $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                      
                    }
                
                } else {
                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    
                    }  else {
                     $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                      
                    }
                }
            } elseif ($this->upload->do_upload('dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_chua_chuan'] = $user_id . '/'. $check1['file_name'];

                    if ($this->upload->do_upload('video_dap_an')) {
                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    
                    }  else {
                     $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                      
                    }
                
                } elseif($this->upload->do_upload('video_dap_an')) {

                    $check1 = $this->upload->data();
                    $data['url_video'] = $user_id . '/'. $check1['file_name'];

                    $this->lib_mod->insert('exercise_repair', $data);
                    echo '<script>alert("Tải bài chữa thành công !"); </script>';
                    echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                    
                    }  else{

                        if (empty ($data['note'])) {
                        echo '<script>alert("Bạn chưa chọn file để upload hoặc tạo nhận xét cho bài chữa !"); </script>';
                        echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        die;  
                        }  else {
                            $this->lib_mod->insert('exercise_repair', $data);
                            echo '<script>alert("Tải bài chữa thành công !"); </script>';
                            echo "<script>location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        }    
                    }
                }             
            } 
      
        
        //gui email
        $user = $this->lib_mod->detail('student', array('id' => $user_id));  
        
                $this->load->library("email");
                $this->email->from('cskh@lakita.vn', "lakita.vn");
                //  $this->email->reply_to('mrtrinh89@gmail.com', "lakita.vn");
                $emailTo = $user[0]['email'];

                $this->email->to($emailTo);
                $this->email->subject('Bài tập của bạn đã được chấm và chữa ở trang lakita');
                $this->email->message('<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="font-family:Tahoma,Arial;background-color:#f5f5f5;padding:50px 0">
    <tbody>
        <tr>
            <td width="100%" valign="top" style="padding-top:20px">
                <table width="682" border="0" cellpadding="0" cellspacing="0" align="center" style="border:1px solid #dedede">
                    <tbody>
                        <tr>
                            <td align="center" bgcolor="#fff" style="padding-top:24px;color:#41a85f">
                                <div>
                                    <h1>Lakita.vn</h1>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" bgcolor="#fff" style="padding:20px 0;color:#fff">
                                <div style="background:url(https://ci5.googleusercontent.com/proxy/4m60zPgaWAWgWKNJAa1ktQJn85UQojWCUDCGZ83QUL3JPTIOOd8ZiF0eawcIHb0m5m0E3dboQL-yF_XHAz_H8HDFXWvLOrds-rUeZcWHNgLW3Q=s0-d-e1-ft#http://kyna.vn/media/images/layout_v2/cod_shipping_intro.png);min-height:30px;width:549px">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" bgcolor="#41a85f" style="padding:6px 0">
                                <table style="color:#fff;font-size:11.91px">
                                    <tbody><tr>
                                            <td align="center" style="padding:3px 20px;border-right:1px solid #fff">
                                                <a href="http://lakita.vn/nhom-khoa-hoc/nang-cao-nang-luc-van-phong.html" style="text-decoration:none;color:#fff" target="_blank">Nâng cao năng lực văn phòng</a>
                                            </td>
                                            <td align="center" style="padding:3px 20px;border-right:1px solid #fff">
                                                <a href="http://lakita.vn/nhom-khoa-hoc/cong-nghe-thong-tin.html" style="text-decoration:none;color:#fff" target="_blank">Công nghệ thông tin</a>
                                            </td>
                                            <td align="center" style="padding:3px 20px;border-right:1px solid #fff">
                                                <a href="http://lakita.vn/nhom-khoa-hoc/khoi-nghiep.html" style="text-decoration:none;color:#fff" target="_blank">Khởi nghiệp</a>
                                            </td>
                                            <td align="center" style="padding:3px 20px;border-right:1px solid #fff">
                                                <a href="http://lakita.vn/nhom-khoa-hoc/suc-khoe.html" style="text-decoration:none;color:#fff" target="_blank">Sức khỏe</a>
                                            </td>
                                            <td align="center" style="padding:3px 20px;border-right:1px solid #fff">
                                                <a href="http://lakita.vn/nhom-khoa-hoc/kinh-doanh.html" style="text-decoration:none;color:#fff" target="_blank">Kinh doanh</a>
                                            </td>
                                            <td align="center" style="padding:3px 20px">
                                                <a href="http://lakita.vn/nhom-khoa-hoc/phat-trien-ca-nhan.html" style="text-decoration:none;color:#fff" target="_blank">Phát triển cá nhân </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:42px 26px 50px 26px;line-height:1.3em;background-color:#fff;color:#666;font-size:13px;text-align:justify">
                                <div>
                                  Bài tập được chữa nằm ở khóa học <strong>' . $courses[0]['name'] . '</strong> tại bài <strong>' . $learn[0]['sort'] . '</strong>

    Click vào đây để xem bài chữa <a href="http://lakita.vn/bai-tap-luyen-tap.html"> VÀO NGAY </a> <br>
                                    Thân mến,<br><br>
                                    Lakita.vn            </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" style="padding:20px 22px;border:1px solid #ddd;border-width:1px 0" bgcolor="#EAEAEA">
                                <table style="width:100%;font-size:13px;line-height:1.38;font-family:Tahoma" border="0">
                                    <tbody><tr>
                                            <td style="width:460px">
                                                <div style="color:#727272">
                                                    © 2016 - Bản quyền của Công Ty Cổ Phần Giáo Dục Lakita<br>
                                                    LIÊN HỆ:<br>
                                                    Hà Nội: Phòng 701 CT1 - Chung cư Skylight - Ngõ Hòa Bình 6 - 125D Minh Khai - Q. Hai Bà Trưng<br>
                                                    TP. HCM: Số 185-187 Hoàng Văn Thụ, P8, Q.Phú Nhuận, TP.HCM (Trường trung cấp Bách Khoa, Đối diện trung tâm White Place)
                                                </div>
                                            </td>
                                            <td>
                                                <div style="font-size:14px;text-align:right;margin-bottom:13px"><strong>Follow us</strong></div>
                                                <div style="text-align:right">
                                                    <a href="https://www.facebook.com/Lakitavn-872893369492994" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://email.kyna.vn/wf/click?upn%3DsTOece2eeLZO9tXRFrRSKCyyqgN0q-2BQjVAbvTHmhUUTx2v5FUvolR-2BNxB35NnCAS_Q8YsDWij4AtnHEQzQettwQFUQJNiNdMbKozie8JvA7WQ5mZSVxiIVuv5eDkcYMLar1xCGexIPcjhjTtQ24c4RmqCUTUlky-2Bncb6XmjSXY6kWfpjurX1MbXHmoyvC3fr-2BczYnTgrbANPW3IQHr0yto9L-2BlCMGeoWip6WxgPZLhoMQ6qlTYwDJ5lybanqGsHu9wTpubbEnN7Uh0r232ngQzw-3D-3D&amp;source=gmail&amp;ust=1469173733044000&amp;usg=AFQjCNFxzJmR10VQLsWpCjgDZ5P7jqT6dQ"><img src="https://ci6.googleusercontent.com/proxy/7bzJtLThBaeN4-_hQj0XaaBezT4P1klVQJciaTq8GwOfssN8K251vJWYvSEmXRS42EKxllXVwvjyTFagQ_TA-R0PMjpXIJD36vZ2mruDuJB7Kg=s0-d-e1-ft#http://kyna.vn/media/images/layout_v2/ico_facebook_26x26.png" class="CToWUd"></a>
                                                    <a href="#"><img src="https://ci5.googleusercontent.com/proxy/VErKdonx8SmXFsitviX1WUq7YzstTPYIBf5_ARRiaodUC7knozd3LvMZm7yaFYbUv1B4Ovf2u3_UTLWRGllQKGfGpdU6P7MjjNQM3KVUFxdv=s0-d-e1-ft#http://kyna.vn/media/images/layout_v2/ico_twitter_26x26.png" class="CToWUd"></a>
                                                    <a href="#"><img src="https://ci6.googleusercontent.com/proxy/TnGXUOlzTi6hs6Z3Ro-72KMG2r5ALqv-IiBr1ORzmjk6YrzBSlC-MOlhrcCxGAhfbA0A-65GmPVjpTS1HGyGVUj6anQL9b8Yk4h0VkHhshasJww=s0-d-e1-ft#http://kyna.vn/media/images/layout_v2/ico_pinterest_26x26.png" class="CToWUd"></a>
                                                    <a href="#" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://email.kyna.vn/wf/click?upn%3Dc8DO3Li0ri7wGG898iEFgz24cb-2FAWkeFlXW2geFTc38U9OQ8rb5Gc7V0cXwmpGXYMGNJiUYZxImDtu7ZN-2Buw4A-3D-3D_Q8YsDWij4AtnHEQzQettwQFUQJNiNdMbKozie8JvA7WQ5mZSVxiIVuv5eDkcYMLaxSZAHGFZ5b5bmmG-2F8s3sri5bYdXyxprJCPpva6AdNqMzCPdSmUexoZ40dp3tE0nWvUP9VJl5zh7sAuxC6z9-2B-2BKp57fJvqqg8uoLg5ba5QEO1tXO-2FRilB-2FJyTyaoaGUAXsss5hD-2FxR6alz1HLx2D1GA-3D-3D&amp;source=gmail&amp;ust=1469173733044000&amp;usg=AFQjCNHlAVMv6ydRRnl6QiXkY-0rB5XR_A"><img src="https://ci5.googleusercontent.com/proxy/iVP4D-YZCtHzU1D3_Zc8i01vi4h4Mg1Fm42gb8IvTUNMI0tORP9m1uWyGkUzojmeXf58-0BSJoBtnzqAlCSm9Jzhwf161sDrHktZNksmvaTrEC-A7w=s0-d-e1-ft#http://kyna.vn/media/images/layout_v2/ico_google-plus_26x26.png" class="CToWUd"></a>
                                                    <a href="#" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://email.kyna.vn/wf/click?upn%3DsTOece2eeLZO9tXRFrRSKPwtRiKgMMe6AqajJb5VuSkdoK4v-2Ft2Yil6qN3bKXwhf83dVFjfSVCGYv47aiWe-2BxA-3D-3D_Q8YsDWij4AtnHEQzQettwQFUQJNiNdMbKozie8JvA7WQ5mZSVxiIVuv5eDkcYMLaNV8ux9sutbDioYScRw31m1baCnScRqy9cvNcBa2PcDCUgxthg10G3wauhjuwq8MrwNprEf-2Fp10bF56YxWIP5G9csw16pvL3ZqMm1nTWSCDmHhpzDDEsW0Q1KFKvjPrfn4Xszfp3dVDcfI9x46649fA-3D-3D&amp;source=gmail&amp;ust=1469173733045000&amp;usg=AFQjCNHwdEh78kMIBBTIlV9e8SDdhmL9nQ"><img src="https://ci3.googleusercontent.com/proxy/qj6QoaTnI_fO_fXvppN_nFktwbwoYujCsTnxxKBEdJudbWORMQt823hP5S-HdgSf0c1QDbOxMr5OCO-Am1o2M9nngShNRomB5cCHJlT3E6Gt=s0-d-e1-ft#http://kyna.vn/media/images/layout_v2/ico_youtube_26x26.png" class="CToWUd"></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>');
                $this->email->send();
                $this->email->clear(TRUE);
        
        
        
    }


function search() {
        $courses_id = $this->input->get('courses_id');
        if (empty($courses_id))
            $courses_id = 0;
        else
            $courses_id = $courses_id;

       if( $this->admin_id  != 35 &&  $this->admin_id !=37)
        {
            header('Content-Type: text/html; charset=utf-8');            
            echo '<script>alert("Bạn không có quyền truy cập module này."); window.location = "'.base_url().'"</script>';
            exit;
        }

        $key_word = $this->lib_mod->make_url(trim($this->input->get('key_word')));
        if (empty($key_word))
            $key_word = 'empty';
        $status = $this->input->get('status');
        $search = array('key_word' => $key_word, 'status' => $status, 'courses_id' => $courses_id);
        $param = $this->uri->assoc_to_uri($search);
        $param = str_replace('//', '/0/', $param);
        redirect('exercise/result_search/' . $param);
    }

    function result_search() {
        $this->load->model('search_mod', 'search_mod');

        $result = $this->uri->segment_array();

       
        
        if (!isset($result[4]) || !isset($result[6]) || !isset($result[8])) {
            redirect('exercise/index');
        } else {
            $data['key_word'] = $key_word = $result[4];
            $data['status'] = $status = $result[6];
            $data['courses_id'] = $courses_id = $result[8];

            $this->load->library('pagination');
            $per_page = 15;
            

            if ($this->uri->segment(9) == null || $this->uri->segment(9) == 1) {
                $offset = 0;
                $offset1 = '';
            } else {
                $offset = $this->uri->segment(9);
                $offset1 = ' OFFSET '.$this->uri->segment(9);
            }
            
            
            
            if($status == '2'){
            $total = $this->search_mod->exercise_count_courses($key_word, $courses_id);
            $data['rows'] = $this->search_mod->exercise_load_courses($key_word, $courses_id, $per_page, $offset);
            }elseif ($status == '1') {
                if($courses_id == '0'){
                    $courses_id_search = '';
                }  else {
                    $courses_id_search = ' AND tbl_exercise.course_id ='.$courses_id;
                }
                $query = 'SELECT * FROM tbl_exercise WHERE tbl_exercise.id IN (SELECT tbl_exercise_repair.exe_id FROM tbl_exercise_repair)'.$courses_id_search.' order by tbl_exercise.time DESC LIMIT '.$per_page.$offset1;
                $query = $this->db->query($query);
                $data['rows'] = $query->result_array();
                
                $query1 = 'SELECT * FROM tbl_exercise WHERE tbl_exercise.id IN (SELECT tbl_exercise_repair.exe_id FROM tbl_exercise_repair)'.$courses_id_search;
                $query1 = $this->db->query($query1);
                $total = $query1->num_rows();  
            }  elseif ( $status == '0' ) {
                if($courses_id == '0'){
                    $courses_id_search = '';
                }  else {
                    $courses_id_search = ' AND tbl_exercise.course_id ='.$courses_id;
                }
                $query = 'SELECT * FROM tbl_exercise WHERE tbl_exercise.id NOT IN (SELECT tbl_exercise_repair.exe_id FROM tbl_exercise_repair)'.$courses_id_search.' order by tbl_exercise.time DESC LIMIT '.$per_page.$offset1;
                $query = $this->db->query($query);
                $data['rows'] = $query->result_array();
                
                
                
                $query1 = 'SELECT * FROM tbl_exercise WHERE tbl_exercise.id NOT IN (SELECT tbl_exercise_repair.exe_id FROM tbl_exercise_repair)'.$courses_id_search;
                $query1 = $this->db->query($query1);
                $total = $query1->num_rows();  
            }

            $base_url = site_url('exercise/result_search/key_word/' . $key_word . '/status/' . $status . '/courses_id/' . $courses_id . '/');
            $config['base_url'] = $base_url;
            $config['per_page'] = $per_page;
            $config['total_rows'] = $total;
            $config['uri_segment'] = 9;
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();     
            $data['total'] = $total;
            $data['is_search'] = 1;
            $data['status']=$status;
            $data['header'] = 'list_base_header';
            $data['footer'] = 'list_base_footer';
            $data['content'] = 'exercise/index';
            $data['student'] = $this->lib_mod->load_all('student', 'id, name', '', '', '', '');
            $data['bai']= $this->lib_mod->load_all('learn', 'id, name', '', '', '', '', '');
            $data['khoa']=  $this->lib_mod->load_all('courses','id,name', array('status' => 1), '', '', '', '');
            $data['bai_chua']= $this->lib_mod->load_all('exercise_repair', 'exe_id, note', '', '', '', '', '');
            $this->load->view('template', $data);
        }
    }

    function download($filename) {
        if (!isset($filename) && empty($filename)) {
            redirect(site_url());
        }
        $admin_id = $this->session->userdata('admin_id');
        if (!isset($admin_id)) {
            die('Xin lỗi, bạn không có quyền truy cập vào khu vực này!');
        }
        $file = base64_decode($filename);
        $file_path = '/home/lakita.com.vn/public_html/data/source/student/upload_exercise/' . $file;
        if (!is_file($file_path)) {
            die('Không tìm thấy file');
        }
        $this->load->helper('download');
        force_download($file_path, NULL);
    }
    
    
    }
    
    
    
    
    

