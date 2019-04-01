<script type="text/javascript">
   /* $(document).ready(function() {
        $('.my_check').click(
            function()
            {         
              var id = $(this).val();
              $(".child_"+id).attr('checked', $(this).is(':checked'));
              return;
            }
        )
    });*/
</script>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
       
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                Nhóm quyền <small><?php if(isset($row[0])) echo 'Cập nhật '; else 'Thêm mới '; ?></small>
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
                        <a href="<?php echo base_url();?>permission">
                            <?php if(isset($row[0])) echo 'Cập nhật '; else 'Thêm mới '; ?> nhóm quyền
                        </a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        
        <div class="row ">
            <div class="col-md-12">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <?php if(!empty($this->session->flashdata('error'))){ ?>
                <div class="note note-danger">
                    <h4 class="block">Lỗi! Nội dung thao tác</h4>
                    <p>
                        <?php echo $this->session->flashdata('error'); ?>
                    </p>
                </div>
                <?php } ?>

                                    
                <div class="portlet-body">
                    <form class="form-horizontal" role="form" action="<?php echo base_url().'permission/update/'.$id;?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-2 control-label"><i>Tên nhóm quyền</i></label>
                            <div class="col-md-10">
                                <div>
                                    <input class="form-control" type="text" required="required" value="<?php if(isset($row[0])) echo $row[0]['name'];?>" name="name" />
                                </div>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-2 control-label"><i>Chọn quyền quản trị</i></label>
                            <div class="col-md-10">

                                <div class="form-group">
                                        <label class="control-label col-md-2">Nhóm quyền</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_permission', $per_arr)) echo 'checked';?> value="view_permission" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_permission', $per_arr)) echo 'checked';?> value="add_permission" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_permission', $per_arr)) echo 'checked';?> value="edit_permission" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_permission', $per_arr)) echo 'checked';?> value="del_permission" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>

                                <div class="form-group">
                                        <label class="control-label col-md-2">Quản trị viên</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_admin', $per_arr)) echo 'checked';?> value="view_admin" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_admin', $per_arr)) echo 'checked';?> value="add_admin" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_admin', $per_arr)) echo 'checked';?> value="edit_admin" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_admin', $per_arr)) echo 'checked';?> value="del_admin" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>

                                <div class="form-group">
                                        <label class="control-label col-md-2">Khách hàng</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_customer', $per_arr)) echo 'checked';?> value="view_customer" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_customer', $per_arr)) echo 'checked';?> value="add_customer" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_customer', $per_arr)) echo 'checked';?> value="edit_customer" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_customer', $per_arr)) echo 'checked';?> value="del_customer" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>

                                <div class="form-group">
                                        <label class="control-label col-md-2">Banner</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_banner', $per_arr)) echo 'checked';?> value="view_banner" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_banner', $per_arr)) echo 'checked';?> value="add_banner" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_banner', $per_arr)) echo 'checked';?> value="edit_banner" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_banner', $per_arr)) echo 'checked';?> value="del_banner" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>

                                <div class="form-group">
                                        <label class="control-label col-md-2">Danh mục</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_category_3s', $per_arr)) echo 'checked';?> value="view_category_3s" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_category_3s', $per_arr)) echo 'checked';?> value="add_category_3s" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_category_3s', $per_arr)) echo 'checked';?> value="edit_category_3s" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_category_3s', $per_arr)) echo 'checked';?> value="del_category_3s" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>

                                <div class="form-group">
                                        <label class="control-label col-md-2">Tin tức</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_news', $per_arr)) echo 'checked';?> value="view_news" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_news', $per_arr)) echo 'checked';?> value="add_news" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_news', $per_arr)) echo 'checked';?> value="edit_news" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_news', $per_arr)) echo 'checked';?> value="del_news" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>

                                <div class="form-group">
                                        <label class="control-label col-md-2">Nhóm khóa học</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_group_courses', $per_arr)) echo 'checked';?> value="view_group_courses" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_group_courses', $per_arr)) echo 'checked';?> value="add_group_courses" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_group_courses', $per_arr)) echo 'checked';?> value="edit_group_courses" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_group_courses', $per_arr)) echo 'checked';?> value="del_group_courses" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>

                                <div class="form-group">
                                        <label class="control-label col-md-2">Khóa học</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_courses', $per_arr)) echo 'checked';?> value="view_courses" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_courses', $per_arr)) echo 'checked';?> value="add_courses" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_courses', $per_arr)) echo 'checked';?> value="edit_courses" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_courses', $per_arr)) echo 'checked';?> value="del_courses" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>

                                <div class="form-group">
                                        <label class="control-label col-md-2">Giảng viên</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_speaker', $per_arr)) echo 'checked';?> value="view_speaker" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_speaker', $per_arr)) echo 'checked';?> value="add_speaker" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_speaker', $per_arr)) echo 'checked';?> value="edit_speaker" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_speaker', $per_arr)) echo 'checked';?> value="del_speaker" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>

                                <div class="form-group">
                                        <label class="control-label col-md-2">Chương học</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_chapter', $per_arr)) echo 'checked';?> value="view_chapter" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_chapter', $per_arr)) echo 'checked';?> value="add_chapter" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_chapter', $per_arr)) echo 'checked';?> value="edit_chapter" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_chapter', $per_arr)) echo 'checked';?> value="del_chapter" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>

                                <div class="form-group">
                                        <label class="control-label col-md-2">Tin tức</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_news', $per_arr)) echo 'checked';?> value="view_news" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_news', $per_arr)) echo 'checked';?> value="add_news" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_news', $per_arr)) echo 'checked';?> value="edit_news" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_news', $per_arr)) echo 'checked';?> value="del_news" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>

                                <div class="form-group">
                                        <label class="control-label col-md-2">Bài học</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_learn', $per_arr)) echo 'checked';?> value="view_learn" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_learn', $per_arr)) echo 'checked';?> value="add_learn" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_learn', $per_arr)) echo 'checked';?> value="edit_learn" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_learn', $per_arr)) echo 'checked';?> value="del_learn" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>

                                <div class="form-group">
                                        <label class="control-label col-md-2">Học viên</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('view_student', $per_arr)) echo 'checked';?> value="view_student" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="primary" data-text-label="Xem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('add_student', $per_arr)) echo 'checked';?> value="add_student" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="success" data-text-label="Thêm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('edit_student', $per_arr)) echo 'checked';?> value="edit_student" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="warning" data-text-label="Sửa">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="permission[]" <?php if(in_array('del_student', $per_arr)) echo 'checked';?> value="del_student" class="make-switch" data-on-label="Chọn" data-off-label="Bỏ" on="danger" data-text-label="Xóa">
                                </div><br>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-2 control-label"><i>Mô tả thêm</i></label>
                            <div class="col-md-10">
                                <div>
                                    <textarea  rows="4" class="form-control" name="description"><?php if(isset($row[0])) echo $row[0]['description'];?></textarea>
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" name="edit" value="edit" class="btn green"><i class="fa fa-checked"></i> Cập nhật</button>
                                <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'permission/index'; return false;" class="btn default">Hủy</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->