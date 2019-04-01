<?php $this->admin_id = $this->session->userdata('admin_id'); ?>
<style>
    .myclock {
        color: #969696;
        float: left;
        margin: 5px 0 0 15px;
    }
</style>
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- add "navbar-no-scroll" class to disable the scrolling of the sidebar menu -->
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <span class="myclock">
                    <i class="fa fa-calendar"></i>
                    <?php echo $this->lib_mod->get_current_weekday(); ?>
                </span>

                <div class="sidebar-toggler hidden-phone">
                </div>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <?php if ($this->admin_id == 35) { ?>
                <li class="sidebar-search-wrapper">
                    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                    <form class="sidebar-search" action="#" method="POST">
                        <div class="form-container">
                            <div class="input-box">
                                <a href="javascript:;" class="remove">
                                </a>
                                <input type="text" placeholder="Tìm kiếm..."/>
                                <input type="button" class="submit" value=" "/>
                            </div>
                        </div>
                    </form>
                    <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </li>

                <li >
                    <a href="<?php echo base_url(); ?>">
                        <i class="fa fa-home"></i>
                        <span class="title">
                            Tổng quát
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>

                <li class="config_website" >
                    <a href="<?php echo base_url(); ?>config_website">
                        <i class="fa fa-cogs"></i>
                        <span class="title">
                            Cấu hình hệ thống
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>			

                <li >
                    <a href="javascript:;">
                        <i class="fa fa-users"></i>
                        <span class="title">
                            Quản trị viên
                        </span>
                        <span class="arrow ">
                        </span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo base_url(); ?>permission">
                                <i class="fa fa-users"></i>
                                Nhóm quyền
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>admin">
                                <i class="fa fa-user"></i>
                                Quản trị viên
                            </a>
                        </li>
                    </ul>
                </li>

                <li id="test" class="client">
                    <a href="<?php echo base_url(); ?>client">
                        <i class="fa fa-user"></i>
                        <span class="title">
                            Quản trị đối tác
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>

                <li class="banner">
                    <a href="<?php echo base_url(); ?>banner">
                        <i class="fa fa-picture-o"></i>
                        <span class="title">
                            Quản trị banner
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>

                <li class="log">
                    <a href="<?php echo base_url(); ?>log">
                        <i class="fa fa-calendar"></i>
                        <span class="title">
                            Nhật ký website
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                <li class="banner">
                    <a href="<?php echo base_url(); ?>BaoCaoVanHanhHocVien">
                        <i class="fa fa-users"></i>
                        <span class="title">
                            Báo cáo vận hành học viên
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                <li class="rate">
                    <a href="<?php echo base_url(); ?>purchase/userVoucher">
                        <i class="fa fa-comments"></i>
                        <span class="title">
                            Danh sách mua khóa học sử dụng voucher của người giới thiệu
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                 <li class="rate">
                    <a href="<?php echo base_url(); ?>generateCod/generateVoucher">
                        <i class="fa fa-comments"></i>
                        <span class="title">
                            Tạo mã Voucher
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                <li class="news">
                    <a href="<?php echo base_url(); ?>news">
                        <i class="fa fa fa-file-text"></i>
                        <span class="title">
                            Quản trị tin tức
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>

                <li class="album_image"> 
                    <a href="<?php echo base_url(); ?>album_image">
                        <i class="fa fa fa-file-text"></i>
                        <span class="title">
                            Quản trị album
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
            <?php
            }
            if ($this->admin_id == 35 || $this->admin_id == 37) {
                ?>
                <li class="speaker">
                    <a href="<?php echo base_url(); ?>speaker">
                        <i class="fa fa fa-file-text"></i>
                        <span class="title">
                            Quản trị giảng viên
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>

<!--                <li class="group_courses">
                    <a href="<?php echo base_url(); ?>group_courses">
                        <i class="fa fa fa-file-text"></i>
                        <span class="title">
                            Quản trị nhóm khóa học
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>-->

                <li class="courses">
                    <a href="<?php echo base_url(); ?>courses">
                        <i class="fa fa fa-file-text"></i>
                        <span class="title">
                            Quản trị khóa học
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>

                <li class="chapter">
                    <a href="<?php echo base_url(); ?>chapter">
                        <i class="fa fa fa-file-text"></i>
                        <span class="title">
                            Quản trị chương
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>

                <li class="learn">
                    <a href="<?php echo base_url(); ?>learn">
                        <i class="fa fa fa-file-text"></i>
                        <span class="title">
                            Quản trị bài học
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                
                <li class="learn">
                    <a href="<?php echo base_url(); ?>exercise">
                        <i class="fa fa fa-file-text"></i>
                        <span class="title">
                            Bài tập học viên
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                
            <?php } ?>
<?php if ($this->admin_id == 35 || $this->admin_id == 38) { ?>
                <li class="student">
                    <a href="<?php echo base_url(); ?>student">
                        <i class="fa fa-users"></i>
                        <span class="title">
                            Quản trị học viên
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                <li class="student">
                    <a href="<?php echo base_url(); ?>student/online">
                        <i class="fa fa-user"></i>
                        <span class="title">
                            Học viên đang online
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
            <?php
            }
            if ($this->admin_id == 35 || $this->admin_id == 37) {
                ?>
                <li class="rate">
                    <a href="<?php echo base_url(); ?>rate">
                        <i class="fa fa-comments"></i>
                        <span class="title">
                            Cảm nhận của học viên
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                <li class="rate">
                    <a href="<?php echo base_url(); ?>vote">
                        <i class="fa fa-comments"></i>
                        <span class="title">
                            Đánh giá
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                
<?php } ?>
<?php if ($this->admin_id == 35 || $this->admin_id == 36 || $this->admin_id == 38) { ?>
                <li class="rate">
                    <a href="<?php echo base_url(); ?>purchase">
                        <i class="fa fa-comments"></i>
                        <span class="title">
                            Danh sách mua khóa học
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                <li class="rate">
                    <a href="<?php echo base_url(); ?>lichsugiaodich/Lichsunapthe">
                        <i class="fa fa-comments"></i>
                        <span class="title">
                            Danh sách nạp thẻ
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
    <?php if ($this->admin_id == 36) { ?>
                    <li class="rate">
                        <a href="<?php echo base_url(); ?>listpayment">
                            <i class="fa fa-comments"></i>
                            <span class="title">
                                Nhập danh sách nộp tiền qua ngân hàng hoặc nộp tiền trực tiếp
                            </span>
                            <span class="selected">
                            </span>
                        </a>
                    </li>
    <?php } ?>
                <li class="rate">
                    <a href="<?php echo base_url(); ?>generateCod">
                        <i class="fa fa-comments"></i>
                        <span class="title">
                            Quản lý mã kích hoạt
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
<?php } ?>

                
                <?php if ($this->admin_id == 41) { ?>
                <li class="student">
                    <a href="<?php echo base_url(); ?>student">
                        <i class="fa fa-users"></i>
                        <span class="title">
                            Quản trị học viên
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                <li class="student">
                    <a href="<?php echo base_url(); ?>student/online">
                        <i class="fa fa-user"></i>
                        <span class="title">
                            Học viên đang online
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                 <li class="learn">
                    <a href="<?php echo base_url(); ?>exercise">
                        <i class="fa fa fa-file-text"></i>
                        <span class="title">
                            Bài tập học viên
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                <li class="rate">
                    <a href="<?php echo base_url(); ?>generateCod">
                        <i class="fa fa-comments"></i>
                        <span class="title">
                            Quản lý mã kích hoạt
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
                <?php } ?>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->`