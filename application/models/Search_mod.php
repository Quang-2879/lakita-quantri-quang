<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ACETIENDUNG
 * Date: 7/18/13
 * Time: 9:09 AM
 * To change this template use File | Settings | File Templates.
 */
class Search_mod extends CI_Model
{
	function __construct()
	{  
      parent::__construct();  
    } 

    function count_admin($key_word, $status)
    {
        $this->db->from('admin');
        
        if($key_word != 'empty')
        {
        	$key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('admin_status', $status);
        }
        
        $this->db->where('admin_id !=', 35);

        return $this->db->count_all_results();
    }

    function load_admin($key_word, $status, $limit, $offset)
    {
        if($key_word != 'empty')
        {
        	$key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('admin_status', $status);
        }

        $this->db->where('admin_id !=', 35);
      
        $this->db->order_by('admin_id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('admin')->result_array();
    }



    function count_permission($key_word, $status)
    {
        $this->db->from('permission');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }
        
        $this->db->where('id !=', 35);

        return $this->db->count_all_results();
    }

    function load_permission($key_word, $status, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        $this->db->where('id !=', 35);
      
        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('permission')->result_array();
    }


    function count_category($key_word, $status)
    {
        $this->db->from('category');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
    }

    function load_category($key_word, $status, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('category')->result_array();
    }

    function count_group_courses($key_word, $status)
    {
        $this->db->from('group_courses');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
    }

    function load_group_courses($key_word, $status, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('group_courses')->result_array();
    }

    function count_speaker($key_word, $status)
    {
        $this->db->from('speaker');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
    }

    function load_speaker($key_word, $status, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('speaker')->result_array();
    }

    function count_category_3s($key_word, $status)
    {
        $this->db->from('category_3s');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
    }

    function load_category_3s($key_word, $status, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('category_3s')->result_array();
    }

    function count_banner($key_word, $status)
    {
        $this->db->from('banner');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
    }

    function load_banner($key_word, $status, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('banner')->result_array();
    }

    function count_client($key_word, $status)
    {
        $this->db->from('client');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
    }

    function load_client($key_word, $status, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('client')->result_array();
    }

    function count_courses($key_word, $status, $group_courses_id)
    {
        $this->db->from('courses');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($group_courses_id != 0)
        {
            $this->db->where('group_courses_id', $group_courses_id);
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
    }

    function load_courses($key_word, $status, $group_courses_id, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        if($group_courses_id != 0)
        {
            $this->db->where('group_courses_id', $group_courses_id);
        }
        
        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('courses')->result_array();
    }

    function count_chapter($key_word, $status, $courses_id)
    {
        $this->db->from('chapter');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($courses_id != 0)
        {
            $this->db->where('courses_id', $courses_id);
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
    }

    function load_chapter($key_word, $status, $courses_id, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        if($courses_id != 0)
        {
            $this->db->where('courses_id', $courses_id);
        }
        
        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('chapter')->result_array();
    }

    function count_learn($key_word, $status, $courses_id)
    {
        $this->db->from('learn');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($courses_id != 0)
        {
            $this->db->where('courses_id', $courses_id);
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
    }

    function load_learn($key_word, $status, $courses_id, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        if($courses_id != 0)
        {
            $this->db->where('courses_id', $courses_id);
        }
        
        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('learn')->result_array();
    }
    
    function count_vote($key_word, $status, $courses_id)
    {
        $this->db->from('vote');
        
      

        if($courses_id != 0)
        {
            $this->db->where('courseID', $courses_id);
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('is_hide', $status);
        }

        return $this->db->count_all_results();
    }
    
    function load_vote($key_word, $status, $courses_id, $limit, $offset)
    {
        

        if($status != '' && $status != 2)
        {
            $this->db->where('is_hide', $status);
        }

        if($courses_id != 0)
        {
            $this->db->where('courseID', $courses_id);
        }
        
        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('vote')->result_array();
    }

    function count_student($key_word, $status)
    {
        $this->db->from('student');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
    }

    function load_student($key_word, $status, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }
        
        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('student')->result_array();
    }

    function count_news($key_word, $status, $menu_id, $menu_parent)
    {
        $this->db->from('news');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($menu_id != 0)
        {
            $this->db->where('menu_id', $menu_id);
        }
        
        if($menu_parent != 0)
        {
            $this->db->where('menu_parent', $menu_parent);
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
    }

    function load_news($key_word, $status, $menu_id, $menu_parent, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        if($menu_id != 0)
        {
            $this->db->where('menu_id', $menu_id);
        }
        
        if($menu_parent != 0)
        {
            $this->db->where('menu_parent', $menu_parent);
        }

        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('news')->result_array();
    }


    function count_log($key_word, $admin_id)
    {
        $this->db->from('log');
        
        if($key_word != 'empty')
        {
        	$key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`log_action` LIKE '%$key_word%'");
        }

        if($admin_id != '' && $admin_id != 0)
        {
            $this->db->where('admin_id', $admin_id);
        }

        return $this->db->count_all_results();
    }

    function load_log($key_word, $admin_id, $limit, $offset)
    {
        if($key_word != 'empty')
        {
        	$key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`log_action` LIKE '%$key_word%'");
        }

        if($admin_id != '' && $admin_id != 0)
        {
            $this->db->where('admin_id', $admin_id);
        }

        $this->db->order_by('log_id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('log')->result_array();
    }
    function search_transaction($key_word){
         $like = array('email'=> $key_word);
         $this->db->like($like);
         $this->db->or_like(array('phone'=>$key_word));
        //$this->db->where("`email` LIKE '%$key_word%'");  
       // $this->db->where("`phone` LIKE '%$key_word%'"); 
       $result =  $this->db->get('student')->result_array();
        foreach($result as $value){
//             $this->db->select("*");
//             $this->db->where('user_id', $value['id']);
//            $row[] = $this->db->get("lichsunapthe")->result_array();
            $row['user_id']=$value['id'];
        }
        return $row;
    }
	
    
    function count_exercise($key_word, $status, $group_courses_id)
    {
        $this->db->from('exercise');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($group_courses_id != 0)
        {
            $this->db->where('group_courses_id', $group_courses_id);
        }

        if($status != '' && $status != 2)
        {
            $this->db->where('status', $status);
        }

        return $this->db->count_all_results();
    }
    
    
    function exercise_count_courses($key_word, $courses_id)
    {
        $this->db->from('exercise');
        
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($courses_id != 0)
        {
            $this->db->where('course_id', $courses_id);
        }

        return $this->db->count_all_results();
    }
    
    
    function exercise_load_courses($key_word,  $courses_id, $limit, $offset)
    {
        if($key_word != 'empty')
        {
            $key_word = str_replace('-', ' ', $key_word);
           
            $this->db->where("`search` LIKE '%$key_word%'");
        }

        if($courses_id != 0)
        {
            $this->db->where('course_id', $courses_id);
        }
        
        $this->db->order_by('id','DESC');

        $this->db->limit($limit, $offset);

        return $this->db->get('exercise')->result_array();
    }
    
    
    
    
    
    
}
