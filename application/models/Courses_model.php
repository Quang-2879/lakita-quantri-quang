<?php

class Courses_model extends MY_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->table = 'courses';
    }

     public function GetCourseCode($id) {
        $input2 = array();
        $input2['where'] = array('id' => $id);
        $input2['select'] = 'course_code';
        $courses = $this->load_all($input2);
        if (!empty($courses)) {
            return  $courses[0]['course_code'];
        }
        return '';
    }

}
