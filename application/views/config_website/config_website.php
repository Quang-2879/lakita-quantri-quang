<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
       
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                Cấu hình hệ thống <small>thông tin cấu hình hệ thống</small>
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
                        <a href="<?php echo base_url();?>config_website">
                            Cập nhật cấu hình hệ thống
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
                    <form class="form-horizontal" role="form" action="<?php echo base_url();?>config_website/edit" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Tiều đề website</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['name'];?>" name="name" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Mô tả website</label>
                            <div class="col-md-9">
                                <div>
                                    <textarea  rows="4" class="form-control" name="description"><?php echo $config[0]['description'];?></textarea>
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Meta Keyword website</label>
                            <div class="col-md-9">
                                <div>
                                    <textarea  rows="4" class="form-control mytags" name="keyword"><?php echo $config[0]['keyword'];?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Địa chỉ</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['address'];?>" name="address" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Giới thiệu về chúng tôi</label>
                            <div class="col-md-9">
                                <div>
                                    <textarea  rows="4" class="form-control" name="intro"><?php echo $config[0]['intro'];?></textarea>
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Email 1</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['email1'];?>" name="email1" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Email 2</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['email2'];?>" name="email2" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Máy bàn</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['homephone'];?>" name="homephone" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Fax</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['fax'];?>" name="fax" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Page Facebook</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['fb'];?>" name="fb" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Di động 1</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['phone1'];?>" name="phone1" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Di động 2</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['phone2'];?>" name="phone2" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Skype</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['skype'];?>" name="skype" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Ảnh tin lớn nhất (100x50)</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control mytags" type="text" value="<?php echo $config[0]['size_news_big'];?>" name="size_news_big" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Ảnh tin cỡ khác (100x50)</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control mytags" type="text" value="<?php echo $config[0]['size_news_other'];?>" name="size_news_other" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Ảnh sản phẩm lớn nhất (100x50)</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control mytags" type="text" value="<?php echo $config[0]['size_product_big'];?>" name="size_product_big" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Ảnh sản phẩm cỡ khác (100x50)</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control mytags" type="text" value="<?php echo $config[0]['size_product_other'];?>" name="size_product_other" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Mã code Analytic</label>
                            <div class="col-md-9">
                                <div>
                                    <textarea  rows="6" class="form-control" name="analytic"><?php echo $config[0]['analytic'];?></textarea>
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Mã code live chat</label>
                            <div class="col-md-9">
                                <div>
                                    <textarea  rows="6" class="form-control" name="livechat"><?php echo $config[0]['livechat'];?></textarea>
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Mã code bản đồ</label>
                            <div class="col-md-9">
                                <div>
                                    <textarea  rows="6" class="form-control" name="map"><?php echo $config[0]['map'];?></textarea>
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Email gửi tin cho khách hàng</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['email_send'];?>" name="email_send" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Mật khẩu email</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['password'];?>" name="password" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Port gửi mail</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['email_port'];?>" name="email_port" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Host gửi mail</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['email_host'];?>" name="email_host" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Chu kỳ gửi lại email</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['time_repeat'];?>" name="time_repeat" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Tiêu đề email</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['mail_title'];?>" name="mail_title" />
                                </div>
                            </div>
                        </div>

                       <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Nội dung Email</label>
                            <div class="col-md-9">
                                <div>
                                    <input class="form-control" type="text" value="<?php echo $config[0]['mail_template'];?>" name="mail_template" />
                                </div>
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <label for="inputPassword1" class="col-md-3 control-label">Logo web front-end</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="<?php if(!empty($config[0]['logo'])) echo WEBSITE.$config[0]['logo']; else echo base_url(). 'styles/assets/img/no-image.png';?>" alt=""/>
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
                                            <input type="file" name="logo">
                                        </span>
                                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                             Xóa
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <label for="inputPassword1" class="col-md-3 control-label">Logo web quản trị</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="<?php if(!empty($config[0]['logo_admin'])) echo WEBSITE.$config[0]['logo_admin']; else echo base_url(). 'styles/assets/img/no-image.png';?>" alt=""/>
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
                                            <input type="file" name="logo_admin">
                                        </span>
                                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                             Xóa
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword1" class="col-md-3 control-label">Favicon</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="<?php if(!empty($config[0]['favicon'])) echo WEBSITE.$config[0]['favicon']; else echo base_url(). 'styles/assets/img/no-image.png';?>" alt=""/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                    </div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new">
                                                Favico
                                            </span>
                                            <span class="fileinput-exists">
                                                Sửa
                                            </span>
                                            <input type="file" name="favicon">
                                        </span>
                                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                             Xóa
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
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