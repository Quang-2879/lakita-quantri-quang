<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
       
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                Tài khoản <small>thông tin tài khoản</small>
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
                        <a href="#">
                            Cập nhật thông tin cá nhấn
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
                    <form class="form-horizontal" role="form" action="<?php echo base_url();?>home/edit_profile" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Họ tên</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-user"></i>
                                    <input class="form-control" type="text" required="true" value="<?php echo $admin[0]['admin_fullname'];?>" name="admin_fullname" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Tài khoản</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-user"></i>
                                    <input class="form-control" type="text" required="true" value="<?php echo $admin[0]['admin_name'];?>" name="admin_name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Email</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email" class="form-control" required="true" value="<?php echo $admin[0]['admin_email'];?>" name="admin_email">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Di động</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-phone"></i>
                                    <input class="form-control" type="text" required="true" value="<?php echo $admin[0]['admin_phone'];?>" name="admin_phone" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Địa chỉ</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-map-marker"></i>
                                    <input class="form-control" type="text" required="true" value="<?php echo $admin[0]['admin_address'];?>" name="admin_address" />
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputPassword1" class="col-md-3 control-label">Mật khẩu</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-key"></i>
                                    <input type="password" class="form-control" name="new_password" placeholder="Mật khẩu">
                                </div>
                                <div class="help-block">
                                    Bỏ trống nếu không thay đổi
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-md-3 control-label">Nhập lại mật khẩu</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-key"></i>
                                    <input type="password" class="form-control" name="re_new_password" placeholder="Nhập lại mật khẩu">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-md-3 control-label">Ảnh đại diện</label>
                            <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="<?php if(!empty($admin[0]['admin_thumbnail'])) echo base_url().$admin[0]['admin_thumbnail']; else echo base_url(). 'styles/assets/img/no-image.png';?>" alt=""/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                    </div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new">
                                                Chọn ảnh
                                            </span>
                                            <span class="fileinput-exists">
                                                Sửa
                                            </span>
                                            <input type="file" name="admin_thumbnail">
                                        </span>
                                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                             Xóa
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" name="edit" value="edit" class="btn green"><i class="fa fa-checked"></i> Cập nhật</button>
                                <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'home/profile'; return false;" class="btn default">Hủy</button>
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