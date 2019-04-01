<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Common extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function find_course(){
        $this->load->model('courses_model');
        $post = $this->input->post();
        
        $input = array();
        $input['select'] = 'id,name,course_code';
        $input['where_in']['id'] = $post['course_code'];
        $course = $this->courses_model->load_all($input);    
        $data = array('list_courses' => $course);
        $this->renderJSON($data);
    }
    
}
