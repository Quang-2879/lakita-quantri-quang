<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Report_mod extends CI_Model {

    function __construct() {
        parent::__construct();
    }
 
    function count($table, $where, $where_in){
        
        $this->db->from($table);
        if(isset($where) && !empty($where)){
            foreach ($where as $key => $value){
                $this->db->where($key,$value);
            }
        }
        if(isset($where_in) && !empty($where_in)){
             foreach ($where_in as $key => $value) {
                $this->db->where_in($key, $value);
            }
        }
        return $this->db->count_all_results();
    }
    
    function count_distinct($table, $select, $where, $where_in){
        $this->db->distinct();
        $this->db->from($table);
        if (isset($select) && !empty($select)) {
            $this->db->select("$select");
        }
        
        if(isset($where) && !empty($where)){
            foreach ($where as $key => $value){
                $this->db->where($key,$value);
            }
        }
        if(isset($where_in) && !empty($where_in)){
             foreach ($where_in as $key => $value) {
                $this->db->where_in($key, $value);
            }
        }
        return $this->db->count_all_results();
    }
    
    
function count_video(){
   $sql= 'CREATE or replace view tbl_sum_learn AS select Student_id,COUNT(learn_ID) as `sum_learn`'
            .'FROM tbl_student_learn,tbl_courses '
            .'WHERE tbl_student_learn.CourseiD = tbl_courses.ID and tbl_courses.ID=39'
            .'GROUP by student_id';
}
    
    
function get_course($select, $group_courses, $order){
    
    if (isset($select) && !empty($select)) {
            $this->db->select("$select");
        }
    
    $this->db->where('trial_learn','0');
    $this->db->where_in('courses_id', $group_courses);
    
    if (isset($order) && !empty($order)) {
            foreach ($order as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
    return $this->db->get('student_courses')->result_array();
}

function count_learn(){
    
}

public function tongkh($date_dau, $date_cuoi) {
        $khoahoc = array(82, 81, 80, 78, 77, 75, 74, 73, 72, 71, 66, 68, 37, 41, 16, 67);
        $data = array();
        foreach ($khoahoc as $value) {
            $query = $this->db->query("SELECT count(student_id) as 'sohv' from tbl_student_courses 
	where courses_id =" . $value . "
        and trial_learn =0 and create_date >=" . $date_dau . " and create_date <=" . $date_cuoi . "");

            $data[] = $query->result_array();
        }
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[] = $value[0];
        }
        return $data2;
    }

    public function motvideo($date_dau, $date_cuoi) {
        $khoahoc = array(82, 81, 80, 78, 77, 74, 73, 72, 71, 66, 68, 75, 37, 41, 16, 67);
        $data = array();
        foreach ($khoahoc as $value) {
            $this->db->query("CREATE or replace view tbl_sum_learn AS select Student_id,COUNT(learn_ID) as 'sum_learn' FROM tbl_student_learn,tbl_courses WHERE
 tbl_student_learn.CourseiD = tbl_courses.ID and tbl_courses.ID=" . $value . " and time <=" . $date_cuoi . " and time >=" . $date_dau . "
 GROUP by student_id");
            $query = $this->db->query("SELECT COUNT(student_id) as 'sohocvien' from tbl_sum_learn WHERE sum_learn >=1");
            $data[] = $query->result_array();
        }
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[] = $value[0];
        }

        return $data2;
    }

    public function muoivideo($date_dau, $date_cuoi) {
        $khoahoc = array(82, 81, 80, 78, 77, 74, 73, 72, 71, 66, 68, 75, 37, 41, 16, 67);
        $data = array();
        foreach ($khoahoc as $value) {
            $this->db->query("CREATE or replace view tbl_sum_learn AS select Student_id,COUNT(learn_ID) as 'sum_learn' FROM tbl_student_learn,tbl_courses WHERE
 tbl_student_learn.CourseiD = tbl_courses.ID and tbl_courses.ID=" . $value . " and time <=" . $date_cuoi . " and time >=" . $date_dau . "
 GROUP by student_id");
            $query = $this->db->query("SELECT COUNT(student_id) as 'sohocvien' from tbl_sum_learn WHERE sum_learn >=10");
            $data[] = $query->result_array();
        }
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[] = $value[0];
        }

        return $data2;
    }

    public function allvideo($date_dau, $date_cuoi) {
        $khoahoc = array(82, 81, 80, 78, 77, 74, 73, 72, 71, 66, 68, 75, 37, 41, 16, 67);
        $data = array();
        foreach ($khoahoc as $value) {
            $this->db->query("CREATE or replace view tbl_sum_learn AS select Student_id,COUNT(learn_ID) as 'sum_learn' FROM tbl_student_learn,tbl_courses WHERE
 tbl_student_learn.CourseiD = tbl_courses.ID and tbl_courses.ID=" . $value . " and time <=" . $date_cuoi . " and time >=" . $date_dau . "
 GROUP by student_id");
            $query = $this->db->query("select COUNT(student_id) as 'sohocvien' from tbl_sum_learn WHERE SUM_learn=(SELECT COUNT(tbl_learn.id) from tbl_learn 
WHERE tbl_learn.courses_id=" . $value . ")");
            $data[] = $query->result_array();
        }
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[] = $value[0];
        }

        return $data2;
    }

    public function cmt_support($date_dau, $date_cuoi) {
        $khoahoc = array(82, 81, 80, 78, 77, 74, 73, 72, 71, 66, 68, 75, 37, 41, 16, 67);
        $data = array();
        foreach ($khoahoc as $value) {
            $query = $this->db->query("SELECT COUNT(DISTINCT(parent)) as 'socmt' 
               FROM tbl_comment WHERE parent in (select ID from tbl_comment 
               where courses_id = " . $value . ") and createdate <= " . $date_cuoi . "
                and createdate >=" . $date_dau . " and parent != 0");

            $data[] = $query->result_array();
        }
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[] = $value[0];
        }
        return $data2;
    }

    public function cmt_nosupport($date_dau, $date_cuoi) {
        $khoahoc = array(82, 81, 80, 78, 77, 74, 73, 72, 71, 66, 68, 75, 37, 41, 16, 67);
        $data = array();
        foreach ($khoahoc as $value) {
            $query = $this->db->query("select count(id) as 'socmt' from tbl_comment where courses_id=" . $value . " 
             and id not in (select parent from tbl_comment)  and createdate <= " . $date_cuoi . "
and createdate >=" . $date_dau . "");

            $data[] = $query->result_array();
        }
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[] = $value[0];
        }
        return $data2;
    }

    public function camnhan($date_dau, $date_cuoi) {
        $khoahoc = array(82, 81, 80, 78, 77, 74, 73, 72, 71, 66, 68, 75, 37, 41, 16, 67);
        $data = array();
        foreach ($khoahoc as $value) {
            $query = $this->db->query("select count(vote_description) as 'socamnhan' from tbl_vote where courseid=" . $value . ""
                    . " and time >=" . $date_dau . " and time <=" . $date_cuoi . "");

            $data[] = $query->result_array();
        }
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[] = $value[0];
        }
        return $data2;
    }

    public function fivestar($date_dau, $date_cuoi) {
        $khoahoc = array(82, 81, 80, 78, 77, 74, 73, 72, 71, 66, 68, 75, 37, 41, 16, 67);
        $data = array();
        foreach ($khoahoc as $value) {
            $query = $this->db->query("Select count(ID) as 'sovote' from tbl_vote where vote_star_number = 5 and courseid=" . $value . ""
                    . " and time >=" . $date_dau . " and time <=" . $date_cuoi . "");

            $data[] = $query->result_array();
        }
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[] = $value[0];
        }
        return $data2;
    }

    public function forstar($date_dau, $date_cuoi) {
        $khoahoc = array(82, 81, 80, 78, 77, 74, 73, 72, 71, 66, 68, 75, 37, 41, 16, 67);
        $data = array();
        foreach ($khoahoc as $value) {
            $query = $this->db->query("Select count(ID) as 'sovote' from tbl_vote where vote_star_number = 4 and courseid=" . $value . ""
                    . " and time >=" . $date_dau . " and time <=" . $date_cuoi . "");

            $data[] = $query->result_array();
        }
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[] = $value[0];
        }
        return $data2;
    }

    public function threestar($date_dau, $date_cuoi) {
        $khoahoc = array(82, 81, 80, 78, 77, 74, 73, 72, 71, 66, 68, 75, 37, 41, 16, 67);
        $data = array();
        foreach ($khoahoc as $value) {
            $query = $this->db->query("Select count(ID) as 'sovote' from tbl_vote where vote_star_number = 3 and courseid=" . $value . ""
                    . " and time >=" . $date_dau . " and time <=" . $date_cuoi . "");
            $data[] = $query->result_array();
        }
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[] = $value[0];
        }
        return $data2;
    }

    public function twostar($date_dau, $date_cuoi) {
        $khoahoc = array(82, 81, 80, 78, 77, 74, 73, 72, 71, 66, 68, 75, 37, 41, 16, 67);
        $data = array();
        foreach ($khoahoc as $value) {
            $query = $this->db->query("Select count(ID) as 'sovote' from tbl_vote where vote_star_number = 2 and courseid=" . $value . ""
                    . " and time >=" . $date_dau . " and time <=" . $date_cuoi . "");

            $data[] = $query->result_array();
        }
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[] = $value[0];
        }
        return $data2;
    }

    public function onestar($date_dau, $date_cuoi) {
        $khoahoc = array(82, 81, 80, 78, 77, 74, 73, 72, 71, 66, 68, 75, 37, 41, 16, 67);
        $data = array();
        foreach ($khoahoc as $value) {
            $query = $this->db->query("Select count(ID) as 'sovote' from tbl_vote where vote_star_number = 1 and courseid=" . $value . ""
                    . " and time >=" . $date_dau . " and time <=" . $date_cuoi . "");

            $data[] = $query->result_array();
        }
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[] = $value[0];
        }
        return $data2;
    }



}
