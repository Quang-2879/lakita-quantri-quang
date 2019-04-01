<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                Hệ thống <small>cấu hình website</small>
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
                            Thông tin cấu hình hệ thống
                        </a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row profile">
            <div class="col-md-12">
                <!--BEGIN TABS-->
                <div class="tabbable tabbable-custom tabbable-full-width">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_1">

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

                            <div class="row">                           
                                <div class="col-md-12">                                   
                                    <div class="tabbable tabbable-custom tabbable-custom-profile">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_11">
                                                <div class="portlet-body">
                                                    <table class="table table-striped table-bordered table-advance table-hover">
                                                        <tbody>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Tiều đề website
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['name'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Mô tả website
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo strip_tags(word_limiter($config_detail[0]['description'], 20));?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Meta Keyword website
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['keyword'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Địa chỉ
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['address'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Giới thiệu về chúng tôi
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo strip_tags(word_limiter($config_detail[0]['intro'], 20));?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Email 1
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['email1'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Email 2
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['email2'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Máy bàn
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['homephone'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Page Facebook
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['fax'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Di động 1
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['phone1'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Di động 2
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['phone2'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Skype
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['skype'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Ảnh tin lớn nhất
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['size_news_big'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Ảnh tin cỡ khác
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['size_news_other'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Ảnh sản phẩm lớn nhất
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['size_product_big'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Ảnh sản phẩm cỡ khác
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['size_product_other'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Mã code Analytic
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo htmlspecialchars(substr($config_detail[0]['analytic'], 0,  100)).'...';?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Mã code live chat
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo htmlspecialchars(substr($config_detail[0]['livechat'], 0,  100)).'...';?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Mã code bản đồ
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo htmlspecialchars(substr($config_detail[0]['map'], 0,  100)).'...';?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Logo web front-end
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <img src="<?php echo WEBSITE.$config_detail[0]['logo'];?>" width="20">
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Logo web quản trị
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <img src="<?php echo WEBSITE.$config_detail[0]['logo_admin'];?>" width="20">
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Favicon
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <img src="<?php echo WEBSITE.$config_detail[0]['favicon'];?>" width="20">
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Email gửi tin cho khách hàng
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['email_send'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Mật khẩu email
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['password'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Port gửi mail
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['email_port'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Host gửi mail
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['email_host'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Chu kỳ gửi lại email
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['time_repeat'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Tiêu đề email
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $config_detail[0]['mail_title'];?>
                                                                </td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td>
                                                                    Nội dung Email
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo strip_tags(word_limiter($config_detail[0]['mail_template'], 15));?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <a href="<?php echo base_url();?>" class="btn default">Trở lại</a>
                            <a href="<?php echo base_url();?>config_website/edit" class="pull-right btn green"><i class="fa fa-edit"></i> Cập nhật</a>
                        </div>

                    </div>
                </div>
                <!--END TABS-->                
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
