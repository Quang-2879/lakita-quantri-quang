<style>.has-switch, .ms-container{width: 100%!important;}</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Học viên <small><?php
                        if (isset($student[0]))
                            echo 'Cập nhật ';
                        else
                            'Thêm mới ';
                        ?></small>
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
                            Danh sách bài kiểm tra
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <?php
                            if (isset($student[0]))
                                echo 'Cập nhật ';
                            else
                                'Thêm mới ';
                            ?> bài kiểm tra
                        </a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <?php
//        echo '<pre>';
//        print_r($row);
        ?>


        <div class="row ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <?php if (!empty($this->session->flashdata('error'))) { ?>
                <div class="note note-danger">
                    <h4 class="block">Lỗi! Nội dung thao tác</h4>
                    <p>
                        <?php echo $this->session->flashdata('error'); ?>
                    </p>
                </div>
            <?php } ?>

            <form role="form" action="<?php echo base_url() . 'examination/update/' . $id; ?>" method="POST" enctype="multipart/form-data">
                <div class="col-md-9">
                    <!-- Thông tin chuyên mục -->
                    <div class="portlet box light_color my-border">
                        <h3 class="">&nbsp;Thông tin cơ bản</h3>
                        <div class="portlet-body form">            
                            <div class="form-body">                                  
                                <div class="form-group">
                                    <label class="control-label"><i>Tên bài kiểm tra</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-user"></i>
                                        <input class="form-control" type="text" required="true" value="<?php if (isset($row[0])) echo $row[0]['name']; ?>" name="name" id="name" onkeyup="ChangeToSlug();"/>
                                        <input class="form-control" type="hidden" required="true" value="<?php if (isset($row[0])) echo $row[0]['slug']; ?>" name="slug" id="slug" />
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-labe"><i>Chọn khóa học</i></label>
                                    <select multiple="multiple" class="multi-select" id="my_multi_select1" name="courses[]">
                                        <?php foreach ($courses as $key => $value) { ?>
                                            <option value="<?php echo $value['id'] ?>" <?php if (isset($row[0]) && in_array($value['id'], $row[0]['course_id'])) echo 'selected'; ?>><?php echo $value['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>  
                                <div id="examination">
                                    <div class="form-group">
                                        <?php
                                        if (isset($row['exam']) && !empty($row['exam'])) {
                                            $i = 1;
                                            foreach ($row['exam'] as $e_key => $e_value) {
                                                ?>
                                                <label class="control-label"><i>Câu hỏi <?php echo $i; ?></i></label>
                                                <input type="hidden" value="<?php echo $e_value['id']; ?>" name="exam[question<?php echo $i; ?>][question_id]" />
                                                <div class="input-icon">
                                                    <input class="form-control" type="text" required="true" value="<?php echo $e_value['question']; ?>" name="exam[question<?php echo $i; ?>][question]" />
                                                </div>
                                                <div class="row">
                                                    <?php
                                                    $x = 1;
                                                    foreach ($e_value['answer'] as $a_key => $a_value) {
                                                        ?>
                                                        <div>
                                                            <div class="input-icon col-md-10">
                                                                <?php
                                                                $answer = '';
                                                                switch ($x) {
                                                                    case 1:
                                                                        $answer = 'A';
                                                                        break;
                                                                    case 2:
                                                                        $answer = 'B';
                                                                        break;
                                                                    case 3:
                                                                        $answer = 'C';
                                                                        break;
                                                                    case 4:
                                                                        $answer = 'D';
                                                                        break;
                                                                }
                                                                ?> 

                                                                <i class="fa"><?php echo $answer; ?> : </i>
                                                                <input type="hidden" value="<?php echo $a_value['id'] ?>" name="exam[question<?php echo $i; ?>][answer<?php echo $x ?>_id]" />
                                                                <input class="form-control" type="text" required="true" value="<?php echo $a_value['answer'] ?>" name="exam[question<?php echo $i; ?>][answer<?php echo $x ?>]" />
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input style="height: 34px" type="checkbox" value="1" name="exam[question<?php echo $i; ?>][answer<?php echo $i; ?>_right]" <?php if ($a_value['right_answer'] == 1) {
                                                                    echo 'checked';
                                                                } ?> class="make-switch" data-on-label="Đúng" data-off-label="Sai">
                                                            </div>
                                                        </div>
                                                    <?php $x++;
                                                } ?>

                                                </div>
        <?php $i++;
    }
    ?>


<?php } else { ?>
                                            <label class="control-label"><i>Câu hỏi 1</i></label>
                                            <input type="hidden" value="0" name="exam[question1][question_id]" />
                                            <div class="input-icon">
                                                <input class="form-control" type="text" required="true" value="" name="exam[question1][question]" />
                                            </div>
                                            <div class="row">
                                                <div>
                                                    <div class="input-icon col-md-10">
                                                        <i class="fa">A : </i>
                                                        <input type="hidden" value="0" name="exam[question1][answer1_id]" />
                                                        <input class="form-control" type="text" required="true" value="" name="exam[question1][answer1]" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input style="height: 34px" type="checkbox" value="1" name="exam[question1][answer1_right]"  class="make-switch" data-on-label="Đúng" data-off-label="Sai">
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="input-icon col-md-10">
                                                        <i class="fa">B : </i>
                                                        <input type="hidden" value="0" name="exam[question1][answer2_id]" />
                                                        <input class="form-control" type="text" required="true" value="" name="exam[question1][answer2]" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="checkbox" value="1" name="exam[question1][answer2_right]"  class="make-switch" data-on-label="Đúng" data-off-label="Sai">
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="input-icon col-md-10">
                                                        <i class="fa">C :</i>
                                                        <input type="hidden" value="0" name="exam[question1][answer3_id]" />
                                                        <input class="form-control" type="text" required="true" value="" name="exam[question1][answer3]" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input style=" width: 100% !important" type="checkbox" value="1" name="exam[question1][answer3_right]" class="make-switch" data-on-label="Đúng" data-off-label="Sai">
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="input-icon col-md-10">
                                                        <i class="fa">D : </i>
                                                        <input type="hidden" value="0" name="exam[question1][answer4_id]" />
                                                        <input class="form-control" type="text" required="true" value="" name="exam[question1][answer4]" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="checkbox" value="1" name="exam[question1][answer4_right]" class="make-switch" data-on-label="Đúng" data-off-label="Sai">
                                                    </div>
                                                </div>

                                            </div>
<?php } ?>
                                    </div>


                                </div>
                                <button type="button" id="add_question">them</button>


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
                                    <input type="checkbox" value="1" name="status" <?php if (isset($row[0]) && $row[0]['status'] == 1) echo 'checked'; ?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Hiển thị&nbsp;" data-off-label="Lưu nháp">
                                </div>
                                <br><div class="form-group">
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
<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script>
                                        $(document).ready(function () {
                                            var i = <?php if (isset($row['exam']) && !empty($row['exam'])) {
    echo count($row['exam']) + 1;
} else {
    echo 2;
} ?>;
                                            $('#add_question').click(function () {

                                                $('#examination').append(
                                                        '<div class="form-group">' +
                                                        '<label class="control-label"><i>Câu hỏi ' + i + '</i></label>' +
                                                        '<input type="hidden" value="0" name="exam[question' + i + '][question_id]" />' +
                                                        '<div class="input-icon">' +
                                                        '<input class="form-control" type="text" required="true" value="" name="exam[question' + i + '][question]" />' +
                                                        '</div>' +
                                                        '<div class="row">' +
                                                        '<div>' +
                                                        '<div class="input-icon col-md-10">' +
                                                        '<i class="fa">A : </i>' +
                                                        '<input type="hidden" value="0" name="exam[question' + i + '][answer1_id]" />' +
                                                        '<input class="form-control" type="text" required="true" value="" name="exam[question' + i + '][answer1]" />' +
                                                        '</div>' +
                                                        '<div class="col-md-2">' +
                                                        '<input style="height: 34px" type="checkbox" value="1" name="exam[question' + i + '][answer1_right]"  class="make-switch" data-on-label="Đúng" data-off-label="Sai">' +
                                                        '</div>' +
                                                        '</div>' +
                                                        '<div>' +
                                                        '<div class="input-icon col-md-10">' +
                                                        '<i class="fa">B : </i>' +
                                                        '<input type="hidden" value="0" name="exam[question' + i + '][answer2_id]" />' +
                                                        '<input class="form-control" type="text" required="true" value="" name="exam[question' + i + '][answer2]" />' +
                                                        '</div>' +
                                                        '<div class="col-md-2">' +
                                                        '<input type="checkbox" value="1" name="exam[question' + i + '][answer2_right]" class="make-switch" data-on-label="Đúng" data-off-label="Sai">' +
                                                        '</div>' +
                                                        '</div>' +
                                                        '<div>' +
                                                        '<div class="input-icon col-md-10">' +
                                                        '<i class="fa">C :</i>' +
                                                        '<input type="hidden" value="0" name="exam[question' + i + '][answer3_id]" />' +
                                                        '<input class="form-control" type="text" required="true" value="" name="exam[question' + i + '][answer3]" />' +
                                                        '</div>' +
                                                        '<div class="col-md-2">' +
                                                        '<input style=" width: 100% !important" type="checkbox" value="1" name="exam[question' + i + '][answer3_right]" class="make-switch" data-on-label="Đúng" data-off-label="Sai">' +
                                                        '</div>' +
                                                        '</div>' +
                                                        '<div>' +
                                                        '<div class="input-icon col-md-10">' +
                                                        '<i class="fa">D : </i>' +
                                                        '<input type="hidden" value="0" name="exam[question' + i + '][answer4_id]" />' +
                                                        '<input class="form-control" type="text" required="true" value="" name="exam[question' + i + '][answer4]" />' +
                                                        '</div>' +
                                                        '<div class="col-md-2">' +
                                                        '<input type="checkbox" value="1" name="exam[question' + i + '][answer4_right]" class="make-switch" data-on-label="Đúng" data-off-label="Sai">' +
                                                        '</div>' +
                                                        '</div>' +
                                                        '</div>' +
                                                        '</div> '
                                                        );
                                                i++;
                                            });
                                        });



                                        function ChangeToSlug()
                                        {
                                            var title, slug;

                                            //Lấy text từ thẻ input title 
                                            title = document.getElementById("name").value;

                                            //Đổi chữ hoa thành chữ thường
                                            slug = title.toLowerCase();

                                            //Đổi ký tự có dấu thành không dấu
                                            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                                            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                                            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                                            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                                            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                                            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                                            slug = slug.replace(/đ/gi, 'd');
                                            //Xóa các ký tự đặt biệt
                                            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                                            //Đổi khoảng trắng thành ký tự gạch ngang
                                            slug = slug.replace(/ /gi, "-");
                                            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                                            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                                            slug = slug.replace(/\-\-\-\-\-/gi, '-');
                                            slug = slug.replace(/\-\-\-\-/gi, '-');
                                            slug = slug.replace(/\-\-\-/gi, '-');
                                            slug = slug.replace(/\-\-/gi, '-');
                                            //Xóa các ký tự gạch ngang ở đầu và cuối
                                            slug = '@' + slug + '@';
                                            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                                            //In slug ra textbox có id “slug”
                                            document.getElementById('slug').value = slug;
                                        }
                                        ;




</script>