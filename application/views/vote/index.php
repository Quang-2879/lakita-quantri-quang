<script type="text/javascript">
    function delete_items() {
        var result = confirm('Bạn chắc chắn muốn xoá các bản ghi đã chọn?');
        if (result == false) {
            return false;
        }
        $('form#form-del').submit();
    }
</script>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">                Đánh giá <small>Danh sách</small>                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <i class="fa fa-home"></i> <a href="<?php echo base_url();?>">                            Trang chủ                        </a> <i class="fa fa-angle-right"></i> </li>
                    <li> <a href="<?php echo base_url();?>rate">                            Danh sách Đánh giá                        </a> </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <?php if(!empty($this->session->flashdata('success'))){ ?>
                    <div class="note note-success">
                        <h4 class="block">Thành công! Nội dung thao tác</h4>
                        <p>
                            <?php echo $this->session->flashdata('success'); ?>
                        </p>
                    </div>
                    <?php } ?>
                        <?php if(!empty($this->session->flashdata('error'))){ ?>
                            <div class="note note-danger">
                                <h4 class="block">Lỗi! Nội dung thao tác</h4>
                                <p>
                                    <?php echo $this->session->flashdata('error'); ?>
                                </p>
                            </div>
                            <?php } ?>
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box light-grey">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-align-justify"></i> Danh sách Đánh giá (
                                            <?php echo number_format($total); ?> bản ghi) </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-toolbar">
                                            <div class="btn-group"> 
                                                <label for="">
                                                    <select size="1" class="per_page form-control input-small">
                                                        <?php $session_per_page = $this->session->userdata('session_per_page');				                        if(isset($session_per_page) && $session_per_page>0)				                            $per_page = $session_per_page;				                        else $per_page = 10; ?>
                                                            <option <?php if($per_page==10) echo 'selected="selected"'; ?> value="10">Hiện 10</option>
                                                            <option <?php if($per_page==20) echo 'selected="selected"'; ?> value="20">Hiện 20</option>
                                                            <option <?php if($per_page==30) echo 'selected="selected"'; ?> value="30">Hiện 30</option>
                                                            <option <?php if($per_page==50) echo 'selected="selected"'; ?> value="50">Hiện 50</option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <form action="<?php echo base_url();?>vote/search" method="post">
                                                    <label for="">
                                            <select size="1" class="form-control input-medium" name="courses_id">
                                                <option <?php if (isset($courses) && $courses == 0) echo 'selected="selected"'; ?> value="0">Tất cả</option>
                                                        <?php foreach ($courses as $key => $cour) { ?>
                                                    <option <?php if (isset($courses_id) && $courses_id == $cour['id']) echo 'selected="selected"'; ?> value="<?php echo $cour['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cour['name']; ?></option>
                                        <?php } ?>
                                            </select>					    	
                                        </label>
                                                
                                                    <button class="btn purple"> <i class="fa fa-search"></i> Tìm </button>
                                                    <?php if(isset($is_search)){ ?>
                                                        <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'rate/index'; return false;" class="btn red">Hủy</button>
                                                        <?php } ?>
                                                </form>
                                            </div>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                                            <thead>
                                                <tr>
                                                    <th class="table-checkbox center">
                                                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>
                                                    <th> Id </th>
                                                    <th> Tên học viên </th>
                                                    <th> Tên khóa học </th>
                                                    <th> Đánh giá </th>
                                                    <th> Hiện </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($rows as $key => $value) { ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center">
                                                            <input type="checkbox" name="items_id[]" class="checkboxes" value="<?php echo $value['id'];?>" /> </td>
                                                        <td class="center">
                                                            <?php echo $value['id'];?>
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($value['userID'])){ ?>
                                                            <a href="<?php echo base_url().'student/view/'.$value['userID']; ?>">
                                                                <?php echo word_limiter($value['vote_user_name'], 15); ?>
                                                            </a>
                                                            <?php }else{  
                                                                echo word_limiter($value['vote_user_name'], 15); 
                                                            } ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php
                                                            $input = array();
                                                            $input['select'] = 'name';
                                                            $input['where']['id'] = $value['courseID'];
                                                            
                                                            echo (empty($this->courses_model->load_all($input)))?'':$this->courses_model->load_all($input)[0]['name'];
                                                            ?>
									</td>
                                                        <td>
                                                            <?php echo $value['vote_description']; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($value['is_hide']){ ?> <a href="<?php echo base_url().'vote/status/'.$value['id'].'/'.$value['is_hide']; ?>" class="txt-center btn btn-sm yellow filter-cancel curr_segment"><i class="fa fa-times"></i></a>
                                                                <?php }else{ ?> <a href="<?php echo base_url().'vote/status/'.$value['id'].'/'.$value['is_hide']; ?>" class="txt-center btn btn-sm green filter-cancel curr_segment"><i class="fa fa-check"></i></a>
                                                                    <?php } ?>
                                                        </td>
                                                       
                                                    </tr>
                                                    <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="table-toolbar">
                                            <br>
                                            <div class="btn-group"> 
                                                <label for="">
                                                    <select size="1" class="per_page form-control input-small">
                                                        <?php $session_per_page = $this->session->userdata('session_per_page');				                        if(isset($session_per_page) && $session_per_page>0)				                            $per_page = $session_per_page;				                        else $per_page = 10; ?>
                                                            <option <?php if($per_page==10) echo 'selected="selected"'; ?> value="10">Hiện 10</option>
                                                            <option <?php if($per_page==20) echo 'selected="selected"'; ?> value="20">Hiện 20</option>
                                                            <option <?php if($per_page==30) echo 'selected="selected"'; ?> value="30">Hiện 30</option>
                                                            <option <?php if($per_page==50) echo 'selected="selected"'; ?> value="50">Hiện 50</option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <div class="dataTables_paginate paging_bootstrap pull-right">
                                                    <?php echo $paging ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
<input type="hidden" id="page" value="vote">