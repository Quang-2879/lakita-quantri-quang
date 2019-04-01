<script type="text/javascript">



</script>



<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">

    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->

        <div class="row">

            <div class="col-md-12">

                <!-- BEGIN PAGE TITLE & BREADCRUMB-->

                <h3 class="page-title">
                    Bài học <small>Danh sách</small>
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
                        <a href="<?php echo base_url(); ?>exercise">
                            Bài tập học viên
                        </a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>

        <!-- END PAGE HEADER-->



        <!-- BEGIN PAGE CONTENT-->

        <div class="row">
            <div class="col-md-12">
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

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box light-grey">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file-text"></i> Danh sách Bài tập học viên (<?php echo number_format($total); ?> bản ghi)
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                           
                            <div class="btn-group pull-right">
                                        <form action="<?php echo base_url(); ?>exercise/search" method="get">

									<?php if('comenu'=='comenu'){ ?> 

									<label for="">

					                    <select size="1" class="form-control input-medium" name="courses_id">
                                                <option <?php if (isset($khoa) && $khoa == 0) echo 'selected="selected"'; ?> value="0">Tất cả</option>
                                                        <?php foreach ($khoa as $khoa5 => $cour) { ?>
                                                    <option <?php if (isset($courses_id) && $courses_id == $cour['id']) echo 'selected="selected"'; ?> value="<?php echo $cour['id']; ?>"><?php echo $cour['name']; ?></option>
                                        <?php } ?>
                                            </select>
                                                                        </label>
                                            <label>
                                                <select size="1" class="form-control input-medium" name="status">
                                                    <option value="2" <?php if( isset($status) && $status == '2' ){?>selected="selected" <?php } ?>>Tất cả</option>
                                                    <option value="1" <?php if( isset($status) && $status == '1' ){?>selected="selected" <?php } ?>>Đã chữa </option>
                                                    <option value="0" <?php if( isset($status) && $status == '0' ){?>selected="selected" <?php } ?>>Chưa chữa</option>
                                                </select>
                                            </label>
                                        
									 <?php } ?>
                                            
                                            <label class="hidden"><input type="text" name="key_word" <?php if (isset($key_word) && $key_word != 'empty') { ?> value="<?php echo $key_word; ?>" <?php } else { ?> placeholder="Từ khóa tìm kiếm" <?php } ?> class="form-control input-medium input-inline"></label>

                                    <button class="btn purple">

                                        <i class="fa fa-search"></i> Tìm

                                    </button>

                                    <?php if (isset($is_search)) { ?>

                                             <a href="<?php echo base_url(); ?>exercise" class="btn red">Hủy</a>

<?php } ?>
                                        </form>

                            </div>
                        </div>



                        
                            <table class="table table-bordered" id="sample_1">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ngày nộp</th>
                                        <th>Học viên</th>
                                        <th>Tên file</th>
                                        <th>Khóa học</th>
                                        <th>Bài học</th>
                                        <th>Ghi chú</th>
                                        <th>Đã chữa</th>
                                        <th>Chữa bài</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                    foreach ($rows as $key => $value) { 
                                        
                                        $learn = $this->lib_mod->detail('learn', array('id'=>$value['learn_id']));
                                        $learn_slug = "http://lakita.vn/".$learn[0]['slug'].'-4'.$learn[0]['id'].'.html';
                    
                                        $course = $this->lib_mod->detail('courses', array('id'=>$value['course_id']));
                                        $course_slug = "http://lakita.vn/".$course[0]['slug'].'-2'.$course[0]['id'].'.html';
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $value['id']; ?></td>
                                            <td><?php echo date('H:i:s d/m/Y', $value['time']); ?></td>
                                            <td><?php
                                                foreach ($student as $khoa3 => $gtri3) {
                                                    if ($value['student_id'] == $gtri3['id']) {
                                                        echo $gtri3['name'];
                                                    }
                                                }
                                                ?></td>
                                            <td>  <a href="<?php echo base_url() . 'exercise/download/' . str_replace("=", "", base64_encode($value['full_path'])); ?>"> <?php echo $value['file_name']; ?> </a>  </td>
                                            <td><?php
                                                foreach ($khoa as $khoa1 => $gtri1) {
                                                    if ($gtri1['id'] == $value['course_id']) {
                                                        echo "<a href='". $course_slug ."'>". $gtri1['name']." </a>" ;
                                                    }
                                                }
                                                ?></td>
                                            <td><?php
                                                foreach ($bai as $khoa2 => $gtri2) {
                                                    if ($value['learn_id'] == $gtri2['id']) {
                                                        echo "<a href='". $learn_slug ."'>". $gtri2['name']." </a>" ;
                                                    }
                                                }
                                                ?></td>
                                            <td><p class="snote"><?php echo $value['note']; ?></p></td>
                                            
                                            <td><?php foreach ($bai_chua as $khoa6 => $gtri6){ if($value['id'] == $gtri6['exe_id']){ echo '<a class="txt-center btn btn-sm green filter-cancel"><i class="fa fa-check"></i></a>';}} ?></td>
                                            
                                            <td><button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#upload_file<?php echo $value['id']; ?>">
                                                    Chữa bài
                                                </button>
                                                <div class="modal fade" id="upload_file<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">Tải bài chữa</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>exercise/action_upload" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
                                                                    <div class="gr5-row-2 margintop22" role="tabpanel">
                                                                        <div class="gr5-form">
                                                                            <input type="text" class="hidden" name="note_repair" value="<?php 
                                                                                                       foreach ($bai_chua as $khoa4 => $gtri4){
                                                                                                           if($value['id'] == $gtri4['exe_id']){
                                                                                                               echo $gtri4['note'];
                                                                                                           }
                                                                                                       }
                                                                            ?>">
                                                                            <input type="text" class="hidden" name="student_id" value="<?php echo $value['student_id']; ?>">
                                                                            <input type="text" class="hidden" name="exe_id" value="<?php echo $value['id']; ?>">
                                                                            <div class="row gr5-row2-form2">
                                                                                <div class="col-md-3 gr5-name-form">
                                                                                    <p><strong>File chữa bài: </strong></p>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="file" name="bai_chua" size="25">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row gr5-row2-form2">
                                                                                <div class="col-md-3 gr5-name-form">
                                                                                    <p><strong>File đáp án: </strong></p>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="file" name="dap_an" size="25">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row gr5-row2-form2">
                                                                                <div class="col-md-3 gr5-name-form">
                                                                                    <p><strong>Video đáp án: </strong></p>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="file" name="video_dap_an" size="25">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row gr5-row2-form2">
                                                                                <div class="col-md-3 gr5-name-form">
                                                                                    <p><strong>Ghi chú: </strong></p>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <textarea class="form-control" rows="3" name="note"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group4 text-center marginbottom15">
                                                                                <button id="nap" class="margintop20 type_submit" type="submit" name="ok" value="Upload">  TẢI BÀI CHỮA  <i class="fa fa-sign-out" aria-hidden="true"></i>  </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
<?php } ?>
                                </tbody>
                            </table>
                        



                        <div class="table-toolbar">

                            <br>

                            <div class="btn-group">

                              



                                

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