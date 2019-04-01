<?php $this->admin_id = $this->session->userdata('admin_id'); ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Học viên <small>thông tin học viên</small>
                </h3>
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url(); ?>">
                            Trang chủ
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>student">
                            Thông tin học viên
                        </a>
                    </li>
                    <li>
                        <a href="javascript;">
                            Chi tiết học viên
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

                            <?php if (!empty($this->session->flashdata('success'))) { ?>
                                <div class="note note-success">
                                    <h4 class="block">Thành công! Nội dung thao tác</h4>
                                    <p>
                                        <?php echo $this->session->flashdata('success'); ?>
                                    </p>
                                </div>
                            <?php } ?>

                            <?php if (!empty($this->session->flashdata('error'))) { ?>
                                <div class="note note-danger">
                                    <h4 class="block">Lỗi! Nội dung thao tác</h4>
                                    <p>
                                        <?php echo $this->session->flashdata('error'); ?>
                                    </p>
                                </div>
                            <?php } ?>

                            <div class="row">                           

                                <div class="col-md-3">
                                    <ul class="list-unstyled profile-nav">
                                        <li>
                                            <img width="250" src="<?php
                                            if (!empty($student[0]['thumbnail']))
                                                echo WEBSITE . $student[0]['thumbnail'];
                                            else
                                                echo base_url() . 'styles/assets/img/user-default.png';
                                            ?>" class="img-responsive" alt=""/>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-9">                                   
                                    <div class="tabbable tabbable-custom tabbable-custom-profile">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1_11">
                                                <div class="portlet-body">
                                                    <table class="table table-striped table-bordered table-advance table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    Họ tên
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $student[0]['name']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Giới tính
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $student[0]['gender'] == 1 ? 'Name' : 'Nữ'; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Ngày sinh
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo date('d/m/Y', $student[0]['birthday']); ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Email
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $student[0]['email']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Di động
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $student[0]['phone']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Địa chỉ
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo $student[0]['address']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Ngày đăng ký
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo date('d/m/Y', $student[0]['createdate']); ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Số dư 
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php echo number_format(str_replace('.', '', $student[0]['balance']), 0, ',', '.') . " VNĐ"; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Ghi chú
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php if ($student[0]) echo $student[0]['note']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    ID facebook
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <?php if ($student[0]) echo $student[0]['id_fb']; ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--tab-pane-->
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12">   
                                    <h4>Khóa học đã đăng ký (<?php echo count($list_courses); ?> bản ghi)</h4><br>
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Id
                                                </th>
                                                <th>
                                                    Ảnh
                                                </th>
                                                <th>
                                                    Tên khóa học
                                                </th>
                                                <th>
                                                    Giá
                                                </th>
                                                <th>
                                                    Tham gia
                                                </th>
                                                <th>
                                                    Đã học
                                                </th>
                                                <th>
                                                    Kích hoạt
                                                </th> 
                                                <?php if ($this->admin_id == 35 || $this->admin_id == 41) { ?>
                                                    <th>
                                                        Xóa
                                                    </th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>student/delete" method="POST" id="form-del">
                                            <?php
                                            foreach ($list_courses as $key => $list) {
                                                $courses = $this->lib_mod->detail('courses', array('id' => $list['courses_id']));
                                                $value = $courses[0];
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td class="center">
                                                        <?php echo $list['id']; ?>
                                                    </td>                                       
                                                    <td class="center">
                                                        <img style="width:50px!important;" src="<?php
                                                        if (!empty($value['image']))
                                                            echo WEBSITE . $value['image'];
                                                        else
                                                            echo base_url() . 'styles/assets/img/user-default.png';
                                                        ?>" class="img-responsive" alt=""/>
                                                    </td>   
                                                    <td>
                                                        <!--=============================HỌC THỬ===============================-->
                                                        <?php
                                                        $trial = 0;
                                                        $trial_learn = 0;
                                                        $student_courses = $this->lib_mod->detail('student_courses', array('courses_id' => $value['id'], 'student_id' => $student_id, 'status' => 1));
                                                        if ($student_courses[0]['cod'] != '') {
                                                            $cod = $this->lib_mod->detail('cod_course', array('cod' => $student_courses[0]['cod']));
                                                            if (isset($cod[0]['trial_learn']) && $cod[0]['trial_learn'] == 1) {
                                                                $trial = 1;
                                                            }
                                                        }
                                                        if($student_courses[0]['trial_learn'] == 1) { $trial = 1; $trial_learn = 1; }
                                                        $trial = ($trial == 0) ? 'Học thật' : ( ($trial_learn==1)? 'CONTACT_CC_TRIAL' :'Học thử');
                                                        ?>
                                                        <a href="<?php echo base_url() . 'courses/edit/' . $value['id']; ?>">
                                                            <?php echo '[ ' . $trial . '] ' . word_limiter($value['name'], 15); ?>
                                                        </a>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo $value['price_sale']; ?>
                                                    </td>                                               
                                                    <td class="center">
                                                        <?php echo date('d/m/Y', $list['create_date']); ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo $list['count_all_learn'].' Bài' ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($list['status']) { ?>
                                                            <a href="<?php echo base_url() . 'student/active_courses/' . $student_id . '/' . $list['id'] . '/' . $list['status']; ?>" class="txt-center btn btn-sm green filter-cancel"><i class="fa fa-check"></i></a>                                               
                                                        <?php } else { ?>
                                                            <a href="<?php echo base_url() . 'student/active_courses/' . $student_id . '/' . $list['id'] . '/' . $list['status']; ?>" class="txt-center btn btn-sm yellow filter-cancel"><i class="fa fa-times"></i></a>                                              
                                                        <?php } ?>

                                                    </td>
                                                    <?php if ($this->admin_id == 35 || $this->admin_id == 41) { ?>
                                                        <td class="center">
                                                            <a href="<?php echo base_url() . 'student/delete_courses/' . $student_id . '/' . $list['id']; ?>" onclick="return confirm('Bạn chắc chắn muốn xoá bản ghi này?');" class="btn default btn-xs red">
                                                                <i class="fa fa-trash-o"></i> Xóa
                                                            </a>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>                              
                                            </tbody>
                                    </table><br>
                                    <div class="">
                                        <a href="<?php echo base_url() . 'student/index'; ?>" class="btn default"><i class="fa fa-ban"></i> Trở lại</a>
                                        <?php if ($this->admin_id == 35 || $this->admin_id == 41) { ?>
                                            <a href="<?php echo base_url() . 'student/update/' . $student_id; ?>" class="pull-right btn green"><i class="fa fa-edit"></i> Cập nhật</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
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
