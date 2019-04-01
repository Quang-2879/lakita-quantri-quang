<style>.has-switch{width: 100%!important;}</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
       
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                Quản trị viên <small><?php if(isset($permission[0])) echo 'Cập nhật '; else 'Thêm mới '; ?></small>
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
                        <a href="<?php echo base_url();?>admin">
                            Danh sách quản trị viên
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">
                        <?php if(isset($permission[0])) echo 'Cập nhật '; else 'Thêm mới '; ?> quản trị viên
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

            <form role="form" action="<?php echo base_url().'admin/update/'.$id;?>" method="POST" enctype="multipart/form-data">
                <div class="col-md-9">
                    <!-- Thông tin chuyên mục -->
                    <div class="portlet box light_color my-border">
                        <h3 class="">&nbsp;Thông tin cơ bản</h3>
                        <div class="portlet-body form">            
                                <div class="form-body">  
                                    <div class="form-group">
                                        <label class="control-label"><i>Nhóm quyền</i></label>
                                        <div class="input-icon">
                                            <i class="fa fa-users"></i>
                                            <select class="form-control" name="permission_id">
                                                <?php if(isset($permission[0])) foreach ($permission as $key => $value) { ?>
                                                <option value="<?php echo $value['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>   

                                    <div class="form-group">
                                        <label class="control-label"><i>Họ tên</i></label>
                                        <div class="input-icon">
                                            <i class="fa fa-user"></i>
                                            <input class="form-control" type="text" required="true" value="<?php if(isset($row[0])) echo $row[0]['admin_fullname'];?>" name="admin_fullname" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"><i>Tài khoản</i></label>
                                        <div class="input-icon">
                                            <i class="fa fa-user"></i>
                                            <input class="form-control" type="text" required="true" value="<?php if(isset($row[0])) echo $row[0]['admin_name'];?>" name="admin_name" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"><i>Email</i></label>
                                        <div class="input-icon">
                                            <i class="fa fa-envelope"></i>
                                            <input type="email" class="form-control" required="true" value="<?php if(isset($row[0])) echo $row[0]['admin_email'];?>" name="admin_email">
                                        </div>
                                        <div class="help-block">
                                            Dùng để lấy lại mật khẩu
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"><i>Di động</i></label>
                                        <div class="input-icon">
                                            <i class="fa fa-phone"></i>
                                            <input class="form-control" type="text" required="true" value="<?php if(isset($row[0])) echo $row[0]['admin_phone'];?>" name="admin_phone" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"><i>Địa chỉ</i></label>
                                        <div class="input-icon">
                                            <i class="fa fa-map-marker"></i>
                                            <input class="form-control" type="text" required="true" value="<?php if(isset($row[0])) echo $row[0]['admin_address'];?>" name="admin_address" />
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
                                </div>                       
                                <div class="clearfix"></div> 
                             </div>
                    </div>                           
                </div>
                
                <div class="col-md-3">
                    <div class="portlet box light_color my-border">
                        <h3 class="">&nbsp;Thao tác</h3>
                        <div class="portlet-body form">            
                            <div class="form-body">

                             
                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Trạng thái</i></label>
                                    <input type="checkbox" value="1" name="admin_status" <?php if(isset($row[0]) && $row[0]['admin_status']==1) echo 'checked';?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Hoạt động&nbsp;" data-off-label="Lưu nháp">
                                </div>                              

                                <div class="form-group">
                                    <label for="inputPassword1" class="control-label"><i>Ảnh đại diện</i></label>
                                    <div class="fileinput fileinput-new w100" data-provides="fileinput">
                                        <div class="fileinput-new image">
                                            <img class="w100" src="<?php if(isset($row[0]) && !empty($row[0]['admin_thumbnail'])) echo base_url().$row[0]['admin_thumbnail']; else echo base_url(). 'styles/assets/img/no-image.png';?>"/>
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
                                                <input type="file" name="admin_thumbnail">
                                            </span>
                                            <a href="#" class="btn red fileinput-exists w100" data-dismiss="fileinput">
                                                <i class="fa fa-trash-o"></i> Xóa ảnh
                                            </a>
                                        </div>
                                    </div>
                                </div>


                        
                                <br><div class="form-group">
                                    <button type="submit" name="edit" value="edit" class="w100 btn blue"><i class="fa fa-arrow-left"></i> Cập nhật & Thoát</button>
                                    <button type="submit" name="save_edit" value="save_edit" class="w100 btn green"><i class="fa fa-plus"></i> Cập nhật & Thêm mới</button>
                                    <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'admin/index'; return false;" class="w100 btn yellow"><i class="fa fa-ban"></i> Thoát</button>
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