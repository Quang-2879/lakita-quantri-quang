<style>.has-switch, .ms-container{width: 100%!important;}</style>
<!-- BEGIN CONTENT -->
<!-- <link href="<?php echo base_url();?>styles/assets/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<div class="page-content-wrapper">
    <div class="page-content">
       
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                Học viên <small><?php if(isset($student[0])) echo 'Cập nhật '; else 'Thêm mới '; ?></small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url();?>">
                            Trang chủ
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>student">
                            Danh sách học viên
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <?php if(isset($student[0])) echo 'Cập nhật '; else 'Thêm mới '; ?> học viên
                        </a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        
        <div class="row ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <?php if(!empty($this->session->flashdata('error'))){ ?>
            <div class="note note-danger">
                <h4 class="block">Lỗi! Nội dung thao tác</h4>
                <p>
                    <?php echo $this->session->flashdata('error'); ?>
                </p>
            </div>
            <?php } ?>

            <form id="form" role="form" action="<?php echo base_url().'student/update/'.$id;?>" method="POST" enctype="multipart/form-data">
                <div class="col-md-9">
                    <!-- Thông tin chuyên mục -->
                    <div class="portlet box light_color my-border">
                        <h3 class="">&nbsp;Thông tin cơ bản</h3>
                        <div class="portlet-body form">            
                            <div class="form-body">                                  
                                <div class="form-group">
                                    <label class="control-label"><i>Họ tên học viên</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-user"></i>
                                        <input class="form-control" type="text" required="true" value="<?php if(isset($row[0])) echo $row[0]['name'];?>" name="name" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label">Email</label>
                                    <div class="input-icon">
                                        <i class="fa fa-envelope"></i>
                                        <input type="email" class="form-control" required="true" value="<?php if(isset($row[0])) echo $row[0]['email'];?>" name="email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Di động</label>
                                    <div class="input-icon">
                                        <i class="fa fa-phone"></i>
                                        <input class="form-control" type="text" required="true" value="<?php if(isset($row[0])) echo $row[0]['phone'];?>" name="phone" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Địa chỉ</label>
                                    <div class="input-icon">
                                        <i class="fa fa-map-marker"></i>
                                        <input class="form-control" type="text" value="<?php if(isset($row[0])) echo $row[0]['address'];?>" name="address" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label"><i>Mật khẩu</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-key"></i>
                                        <input type="password" class="form-control" name="new_password" placeholder="Mật khẩu">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label"><i>Nhập lại mật khẩu</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-key"></i>
                                        <input type="password" class="form-control" name="re_new_password" placeholder="Nhập lại mật khẩu">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label"><i>Mô tả</i></label>
                                    <div class="input-icon">
                                        <textarea  rows="4" class="form-control" name="note"><?php if(isset($row[0])) echo $row[0]['note'];?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-labe"><i>Chọn khóa học</i></label>
                                    
                                    <!-- <div class="form-group">
                                        <input type="text" style="width: 45%" class="form-control" placeholder="Tìm kiếm khóa học" id="text_search" name="text_search">
                                    <select id="data_list" class="s-example-tokenizer" multiple="multiple" name="" style="width: 45%">
                                           
                                    </select>
                                    </div>   -->
                                    <br>

                                    <select class="form-control js-example-basic-multiple" name="courses[]" multiple="multiple" style="width: 45%">
                                      <?php foreach ($courses as $value) { ?>
                                          <option class='list-group-item' value="<?php echo $value['id'] ?>"><?php echo $value['name'].' -- {'.$value['course_code'].'}' ?></option>
                                      <?php } ?>
                                    </select>
                                    <br>
                                    <br>
                                    <!-- <select multiple="multiple" class="" id="my_multi_select1" name="courses[]">
                                        <?php foreach ($courses as $key => $value) { ?>
                                        <option value="<?php echo $value['id'] ?>" <?php if(isset($row[0]) &&  in_array($value['id'], $list_courses)) echo 'selected'; ?>><?php echo $value['name'] ?></option>
                                        <?php } ?>
                                    </select> -->
                                    
                                </div>  
                            </div>                           
                        </div> 
                    </div>                           
                </div>
                
                <div class="col-md-3">
                    <div class="portlet box light_color my-border">
                        <h3 class="">&nbsp;Thao tác</h3>
                        <div class="portlet-body form">            
                            <div class="form-body">
                             
                                <div class="form-group">
                                    <label class="control-label pull-left"><i>Trạng thái</i></label>
                                    <input type="checkbox" value="1" name="status" <?php if(isset($row[0]) && $row[0]['status']==1) echo 'checked';?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Hoạt động&nbsp;" data-off-label="Lưu nháp">
                                </div>

                                <div class="form-group">
                                    <label class="control-label pull-left"><i>Là trợ giảng</i></label>
                                    <input type="checkbox" value="1" name="is_tutor" <?php if(isset($row[0]) && $row[0]['is_tutor']==1) echo 'checked'; ?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Yes&nbsp;" data-off-label="No">
                                </div>

                                <div class="form-group">
                                    <label class="control-label pull-left"><i>Load HTML5 video</i></label>
                                    <input type="checkbox" value="1" name="is_exception" <?php if(isset($row[0]) && $row[0]['is_exception']==1) echo 'checked'; ?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Yes&nbsp;" data-off-label="No">
                                </div>

                                <div class="form-group">
                                    <label class="control-label pull-left"><i>Giới tính</i></label>
                                    <input type="checkbox" value="1" name="gender" <?php if(isset($row[0]) && $row[0]['gender']==1) echo 'checked';?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Nam&nbsp;" data-off-label="Nữ">
                                </div>  
                             
                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Ngày sinh</i></label>
                                    <div class="input-group w100 date date-picker" data-date="<?php if(isset($row[0]) && !empty($row[0]['birthday'])) echo date('d-m-Y', $row[0]['birthday']); else echo date('d-m-Y');?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input name="birthday" type="text" class="form-control" readonly value="<?php if(isset($row[0]) && !empty($row[0]['birthday'])) echo date('d-m-Y', $row[0]['birthday']); else echo date('d-m-Y');?>">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label pull-left"><i>Số dư tài khoản</i></label>
                                    <input class="form-control mymoney" value="<?php if(isset($row[0])) echo $row[0]['balance'];?>" name="balance" type="text"/>
                                </div> 

                                <div class="form-group">                                    
                                    <label for="inputEmail12" class="control-label pull-left"><i>Ảnh đại diện</i></label>
                                    <div class="fileinput fileinput-new w100" data-provides="fileinput">
                                        <div class="fileinput-new image">
                                            <img class="w100" src="<?php if(isset($row[0]) && !empty($row[0]['thumbnail'])) echo WEBSITE.$row[0]['thumbnail']; else echo base_url(). 'styles/assets/img/no-image.png';?>"/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists image w100">
                                        </div>
                                        <div>
                                            <span class="btn default btn-file w100">
                                                <i class="fa fa-upload"></i> 
                                                <span class="fileinput-new">
                                                    Chọn ảnh
                                                </span>
                                                <span class="fileinput-exists yellow">
                                                    Sửa ảnh
                                                </span>
                                                <input type="file" name="thumbnail">
                                            </span>
                                            <a href="#" class="btn red fileinput-exists w100" data-dismiss="fileinput">
                                                <i class="fa fa-trash-o"></i> Xóa ảnh
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        
                                <br>
                                <div class="form-group">
                                    <button type="submit" name="edit" value="edit" class="w100 btn blue"><i class="fa fa-arrow-left"></i> Cập nhật & Thoát</button>
                                    <button type="submit" name="save_edit" value="save_edit" class="w100 btn green"><i class="fa fa-plus"></i> Cập nhật & Thêm mới</button>
                                    <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'student/index'; return false;" class="w100 btn yellow"><i class="fa fa-ban"></i> Thoát</button>
                                </div>

                             </div>
                         </div>
                    </div>
                </div>
            </form>

        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->


<script src="<?php echo base_url();?>styles/assets/scripts/custom/bootstrap-select.min.js" type="text/javascript"></script>
<!-- Latest compiled and minified CSS & JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // $('#form').submit(function(event) {
        //     event.preventDefault();
        // });
        $('#text_search').keyup(function(e) {
            // e.preventDefault();
            var data_search = $('#text_search').val();
                if (data_search != "") {
                // alert(data_search);
                $.ajax({
                    url: $('#base_url').val() + 'student/search_course',
                    type: 'POST',
                    dataType: 'json',
                    data: {data_search: data_search},
                    success: function(result){
                        console.log(result);
                        var len = result.length;
                        console.log(len);
                        $("#data_list").empty();    
                        // var html = "";
                        // $.each(result, function(index, item_search) {
                        //      html = "<li class="list-group-item" style="width:45%" value='" + item_search.id + "'>" + item_search.name + "</li>";
                        // });
                        for(var i = 0; i<len; i++){
                            var id = result[i]['id'];
                            var name = result[i]['name'];
                            var code = result[i]['course_code'];
                            if (code == null) {
                               $("#data_list").append("<option class='list-group-item' value='" + id + "'>" + name + "</option>");
                            }
                            else{
                                $("#data_list").append("<option class='list-group-item' value='" + id + "'>" + name + " -- {" +code+ "}</option>");
                            }
                        }
                    }
                });              
            }     
        });
    });

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: 'Tìm kiếm khóa học'
        });

    });

    // $(document).ready(function() {
    //     $('option').hover(function() {
    //         console.log($(this).val());
    //     }
    // });

    // $(".js-example-tokenizer").select2({
    // tags: true,
    // tokenSeparators: [',', ' ']
    // });
</script>