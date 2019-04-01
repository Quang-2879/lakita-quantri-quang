<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Ten table
    protected $table = '';

    function insert($data) {
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[$key] = htmlentities($value);
        }
        if ($this->db->insert($this->table, $data2))
            return TRUE;
        else
            return FALSE;
    }

    function insert_return_id($data, $field) {
        $data2 = array();
        foreach ($data as $key => $value) {
            $data2[$key] = htmlentities(($value));
        }
        $this->db->insert($this->table, $data2);
        $sql = "SELECT MAX($field) AS id FROM tbl_" . $this->table;
        $admin = $this->db->query($sql)->result();
        return $admin[0]->id;
    }

    function insert_from_mol($data) {
        $this->db->insert($this->table, $data);
    }

    function update($where = array(), $data) {
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->update($this->table, $data);
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }

    function delete($where) {
        if (isset($where) && !empty($where)) {
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
            $this->db->delete($this->table);
        }
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Thực hiện câu lệnh query
     * trả về số dòng query đc
     */
    function query($sql) {
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    // trả về kết quả query vào mảng
    function query2($sql) {
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /**
     * Lay danh sach
     * $input : mang cac du lieu dau vao
     */
    function load_all($input = array()) {
        //xu ly cac du lieu dau vao
        $this->get_list_set_input($input);

        //thuc hien truy van du lieu
        $query = $this->db->get($this->table);
        //echo $this->db->last_query();
        return $query->result_array();
    }

    /**
     * Gan cac thuoc tinh trong input khi lay danh sach
     * $input : mang du lieu dau vao
     */
    protected function get_list_set_input($input = array()) {
        // Thêm điều kiện cho câu truy vấn truyền qua biến $input['select'] 
        //(vi du: $input['select'] = '';
        if (isset($input['select'])) {
            $this->db->select($input['select']);
        }

        // Thêm điều kiện cho câu truy vấn truyền qua biến $input['where'] 
        //(vi du: $input['where'] = array('email' => 'hocphp@gmail.com'))
        if (isset($input['where']) && !empty($input['where'])) {
            //print_r($input['where']);
            foreach ($input['where'] as $key => $value) {
                if($value == "NO-VALUE") {$this->db->where($key);}
                else $this->db->where($key, $value);
            }
        }
        
        if (isset($input['or_where']) && !empty($input['or_where'])) {
            foreach ($input['or_where'] as $key => $value) {
                $this->db->or_where($key, $value);
            }
        }

        //where in
        if (isset($input['where_in']) && !empty($input['where_in'])) {
            foreach ($input['where_in'] as $key => $value) {
                $this->db->where_in($key, $value);
            }
        }

        //where not in
        if (isset($input['where_not_in']) && !empty($input['where_not_in'])) {
            foreach ($input['where_not_in'] as $key => $value) {
                $this->db->where_not_in($key, $value);
            }
        }

        //like
        // $input['like'] = array('name' => 'abc');
        if ((isset($input['like'])) && !empty($input['like'])) {
            foreach ($input['like'] as $key => $value) {
                $this->db->like($key, $value);
            }
        }

        // $input['like_before'] = array('name' => 'abc');
        if ((isset($input['like_before'])) && !empty($input['like_before'])) {
            foreach ($input['like_before'] as $key => $value) {
                $this->db->like($key, $value, 'before');
            }
        }

        // $input['like_after'] = array('name' => 'abc');
        if ((isset($input['like_after'])) && !empty($input['like_after'])) {
            foreach ($input['like_after'] as $key => $value) {
                $this->db->like($key, $value, 'after');
            }
        }

        //not like
        // $input['not_like'] = array('name' => 'abc');
        if ((isset($input['not_like'])) && !empty($input['not_like'])) {
            foreach ($input['not_like'] as $key => $value) {
                $this->db->not_like($key, $value);
            }
        }

        // $input['not_like_before'] = array('name' => 'abc');
        if ((isset($input['not_like_before'])) && !empty($input['not_like_before'])) {
            foreach ($input['not_like_before'] as $key => $value) {
                $this->db->not_like($key, $value, 'before');
            }
        }

        // $input['not_like_after'] = array('name' => 'abc');
        if ((isset($input['not_like_after'])) && !empty($input['not_like_after'])) {
            foreach ($input['not_like_after'] as $key => $value) {
                $this->db->not_like($key, $value, 'after');
            }
        }

         // $input['or_like'] = array('name' => 'abc');
        if ((isset($input['or_like'])) && !empty($input['or_like'])) {
            foreach ($input['or_like'] as $key => $value) {
                $this->db->or_like($key, $value);
            }
        }
        
        // Thêm sắp xếp dữ liệu thông qua biến $input['order']
        if (isset($input['order']) && !empty($input['order'])) {
            foreach ($input['order'] as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }

       // Thêm điều kiện limit cho câu truy vấn thông qua biến $input['limit'] 
        //(ví dụ $input['limit'] = array('10' ,'0')) 
        if (isset($input['limit'][0]) && isset($input['limit'][1])) {
            $this->db->limit($input['limit'][0], $input['limit'][1]);
        }

        //nhóm
        if (isset($input['group_by']) && !empty($input['group_by'])) {
            foreach ($input['group_by'] as $value) {
                $this->db->group_by($value);
            }
        }
    }

    function check_exists($where = array()) {
        $this->db->where($where);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
