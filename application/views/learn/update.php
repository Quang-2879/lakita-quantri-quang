<style>.has-switch{width: 100%!important;}</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                    Bài học <small><?php
                        if (isset($permission[0]))
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
                        <a href="<?php echo base_url(); ?>learn">
                            Danh sách bài học
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <?php
                            if (isset($row[0]))
                                echo 'Cập nhật ';
                            else
                                echo 'Thêm mới ';
                            ?> bài học
                        </a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->


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

            <form role="form" action="<?php echo base_url() . 'learn/update/' . $id; ?>" method="POST" enctype="multipart/form-data">
                <div class="col-md-9">
                    <!-- Thông tin chuyên mục -->
                    <div class="portlet box light_color my-border">
                        <h3 class="">&nbsp;Thông tin cơ bản</h3>
                        <div class="portlet-body form">            
                            <div class="form-body">  

                                <?php
                                if ('comenu' == 'comenu') {
                                    if (isset($courses[0])) {
                                        ?>
                                        <div class="form-group">
                                            <label for="" class="control-label"><i>Chọn khóa học</i></label>
                                            <div class="input-icon">
                                                <i class="fa fa-folder-open"></i>
                                                <?php
                                                foreach ($courses as $key => $value) {
                                                    $pos = strrpos($value['name'], ' ');
                                                    $sortArr[$key] = substr($value['name'], 0, $pos) . '-' . $value['id'];
                                                }
                                                sort($sortArr);

                                                foreach ($sortArr as $key => $value) {
                                                    $pos = strrpos($value, '-');
                                                    $sortKey[$key] = substr($value, $pos + 1);
                                                }
                                                //   echo '<pre>';
                                                // print_r($courses);
                                                foreach ($sortKey as $key => $value) {
                                                    //   echo $value.'<br>';
                                                    foreach ($courses as $key1 => $value1) {
                                                        if ($value1['id'] == $value) {
                                                            $newCourse[$key] = array('id' => $value1['id'], 'name' => $value1['name']);
                                                            break;
                                                        }
                                                    }
                                                }

                                                //     echo '<pre>';
                                                //    print_r($newCourse);
                                                ?>
                                                <select class="form-control" name="courses_id" id="courses_id">
                                                    <?php
                                                    foreach ($newCourse as $key => $cour) {
                                                        ?>
                                                        <option <?php if (isset($row[0]) && $row[0]['courses_id'] == $cour['id']) echo 'selected="selected"'; ?> value="<?php echo $cour['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cour['name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>   
                                        <?php
                                    }
                                }else {
                                    ?>                                    
                                    <input type="hidden" name="courses_id" value="">
                                <?php } ?>   

                                <div class="form-group" id="chapter">
                                    <?php if (isset($chapter[0])) { ?>
                                        <label for="" class="control-label"><i>Chọn Chương</i></label>
                                        <div class="input-icon">
                                            <i class="fa fa-folder-open"></i>
                                            <select class="form-control" name="chapter_id">
                                                <?php foreach ($chapter as $key => $chap) { ?>
                                                    <option <?php if (isset($row[0]) && $row[0]['chapter_id'] == $chap['id']) echo 'selected="selected"'; ?> value="<?php echo $chap['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $chap['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php } ?>                                    
                                </div>   

                                <div class="form-group">
                                    <label for="" class="control-label"><i>Tên hiển thị trên web</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-file-text"></i>
                                        <input class="form-control" type="text" id="name" required="true" value="<?php if (isset($row[0])) echo $row[0]['name']; ?>" name="name" onkeyup="ChangeToSlug();"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label"><i>Slug - Đường dẫn trên url</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-globe"></i>
                                        <input class="form-control" type="text" id="slug" required="true" value="<?php if (isset($row[0])) echo $row[0]['slug']; ?>" name="slug" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label"><i>Tên hiển thị trên thanh tiêu đề (SEO meta_title)</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-file-text"></i>
                                        <input class="form-control" type="text" id="title" required="true" value="<?php if (isset($row[0])) echo $row[0]['title']; ?>" name="title" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description"><i>Tag cho khóa học</i></label>
                                    <textarea  rows="4" class="form-control tags mytags" name="tag"><?php if (isset($row[0])) echo $row[0]['tag']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description"><i>Từ khóa cho khóa học (SEO meta_keyword)</i></label>
                                    <textarea  rows="4" class="form-control tags mytags" name="meta_keywords"><?php if (isset($row[0])) echo $row[0]['meta_keywords']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description"><i>Mô tả hiển thị trên web</i></label>
                                    <textarea class="editor form-control vert" id="description" name="description" rows="3" ><?php if (isset($row[0])) echo $row[0]['description']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description"><i>Mô tả cho công cụ tìm kiếm (SEO meta_description)</i></label>
                                    <textarea class="editor form-control vert" id="meta_description" name="meta_description" rows="3" ><?php if (isset($row[0])) echo $row[0]['meta_description']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description"><i>Nội dung</i></label>
                                    <textarea class="editor form-control vert ace-editer" id="content" name="content" rows="3" ><?php if (isset($row[0])) echo $row[0]['content']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <br>
                                    <label for="inputEmail12" class="control-label pull-left"><i>Đính kèm</i></label>
                                    <table role="presentation" class="table table-striped clearfix">
                                        <tbody class="files">
                                            <?php
                                            if (isset($row[0])) {
                                                $attach_file = array_filter(explode('@', $row[0]['attach_file']));
                                                $attach_desc = array_filter(explode('@', $row[0]['attach_desc']));
                                                foreach ($attach_file as $key => $value) {
                                                    $extension = explode('.', $value);
                                                    $extension = end($extension);
                                                    $filename = explode('/', $value);
                                                    $filename = end($filename);

                                                    if ($extension == 'png' || $extension == 'gif' || $extension == 'jpg' || $extension == 'jpeg')
                                                        $show = WEBSITE . $value;
                                                    elseif ($extension == 'pdf' || $extension == 'ppt' || $extension == 'pptx' || $extension == 'rar' || $extension == 'zip' || $extension == 'gzip' || $extension == 'mp4' || $extension == 'flv' || $extension == 'mp3' || $extension == 'doc' || $extension == 'docx' || $extension == 'xls' || $extension == 'xlsx')
                                                        $show = base_url() . 'data/img/' . $extension . '.jpg';
                                                    else
                                                        $show = base_url() . 'data/img/unknow.jpg';
                                                    ?>
                                                    <tr class="template-upload fade in">
                                                        <td>
                                                            <span class="preview">
                                                                <img width="50" height="40" src="<?php echo $show; ?>">
                                                            </span>
                                                        </td>
                                                        <td class="input-medium">
                                                            <input type="hidden" name="att_name[]" value="<?php echo $value; ?>">
                                                            <p class="name"><?php echo $filename; ?></p>
                                                        </td>
                                                        <td>
                                                            <input class="form-control input-medium" type="text" placehold="Nhập mô tả" value="<?php if (isset($attach_desc[$key])) echo $attach_desc[$key]; ?>" name="att_description[]" />
                                                        </td>
                                                        <td>
                                                            <div class="pull-right">
                                                                <a href="<?php echo $show; ?>" class="btn blue start btn-sm iframe-img">
                                                                    <i class="fa fa-eye"></i>
                                                                    <span>Xem</span>
                                                                </a>

                                                                <button class="btn red cancel btn-sm delete_attach">
                                                                    <i class="fa fa-trash-o"></i>
                                                                    <span>Xóa</span>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <br>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr class="template-upload fade in">
                                        </tr>
                                        </tbody>
                                    </table>

                                    <input type="hidden" id="attach_link" value="">
                                    <a class="btn blue start iframe-btn" id="attach_file" type="button" href="<?php echo base_url(); ?>styles/assets/filemanager/dialog.php?type=0&field_id=attach_link&lang=vi&akey=7d6bc44b9495644c9fb9f706c8715ee5">
                                        <i class="fa fa-upload"></i> Chọn file đính kèm
                                    </a>                  
                                </div>

                            </div>                       
                            <div class="clearfix"></div> 
                        </div>
                    </div>   
                    <div class="checkbox">
                        <label><input type="checkbox" name="trial_learn" <?php if (isset($row[0]['trial_learn']) && $row[0]['trial_learn'] == 1) echo 'checked="checked"'; ?>>Cho phép học thử???</label>
                    </div>

                </div>

                <div class="col-md-3">
                    <div class="portlet box light_color my-border">
                        <h3 class="">&nbsp;Thao tác</h3>
                        <div class="portlet-body form">            
                            <div class="form-body">

                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Trạng thái</i></label>
                                    <input type="checkbox" name="status" value="1" <?php if (isset($row[0]) && $row[0]['status'] == 1) echo 'checked'; ?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Xuất bản&nbsp;" data-off-label="Lưu nháp">
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Nổi bật</i></label>
                                    <input type="checkbox" name="hot" value="1" <?php if (isset($row[0]) && $row[0]['hot'] == 1) echo 'checked'; ?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Có chọn&nbsp;" data-off-label="Bỏ chọn">
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Hẹn giờ hiển thị</i></label>
                                    <div class="input-group w100 date date-picker" data-date="<?php
                                    if (isset($row[0]) && !empty($row[0]['time_release']))
                                        echo date('d-m-Y', $row[0]['time_release']);
                                    else
                                        echo date('d-m-Y');
                                    ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input name="time_release" type="text" class="form-control" readonly value="<?php
                                        if (isset($row[0]) && !empty($row[0]['time_release']))
                                            echo date('d-m-Y', $row[0]['time_release']);
                                        else
                                            echo date('d-m-Y');
                                        ?>">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Thứ tự hiển thị</i></label>
                                    <input class="form-control" name="sort" value="<?php if (isset($row[0])) echo $row[0]['sort']; ?>" type="text"/>
                                </div> 

                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Độ dài video</i></label>
                                    <input class="form-control" name="length" value="<?php if (isset($row[0])) echo $row[0]['length']; ?>" type="text"/>
                                </div> 

                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Nhúng youtube</i></label>
                                    <input class="form-control" name="youtube" value="<?php if (isset($row[0])) echo $row[0]['youtube']; ?>" type="text"/>
                                </div>                               

                                <div class="form-group">     
                                    <label for="inputPassword1" class="control-label"><i>Upload video</i></label>
                                    <input type="hidden" id="website" value="<?php echo WEBSITE; ?>">
                                    <input type="hidden" id="token" value="<?php echo md5('AceTienDung' . time()); ?>">
                                    <input type="hidden" value="<?php if (isset($row[0]) && !empty($row[0]['video_file'])) echo $row[0]['video_file']; ?>" id="video_file" name="video_file">
                                    <div class="form-group col-md-12" style="padding:0">
                                        <div id="playvideo">
                                            <?php if (isset($row[0]) && !empty($row[0]['video_file'])) { ?>
                                                <video id="pre_video" width="100%" controls>
                                                    <source src="<?php echo WEBSITE . $row[0]['video_file']; ?>" type="video/mp4">
                                                    Trình duyệt này không hỗ trợ chạy video
                                                </video>
                                            <?php } else { ?>
                                                <img id="pre_video" class="w100" src="<?php echo base_url() . 'styles/assets/img/no-image.png'; ?>" alt=""/>                                    
                                            <?php } ?>
                                        </div>                                        
                                        <!--                                        <div style="position:relative;" class="w100">
                                                                                    <div style="position:absolute;" class="w100">
                                                                                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                                                                                    </div>                                   
                                                                                </div>    -->
                                        <!--                                        <a class="btn default btn-file w100 iframe-btn" id="attack_link" type="button" href="<?php echo base_url(); ?>styles/assets/filemanager/dialog.php?type=0&field_id=attack_link&lang=vi&akey=7d6bc44b9495644c9fb9f706c8715ee5"><i class="fa fa-upload"></i> select files</a>-->

                                        <input name="video_link" type="hidden" id="video_link" value="<?php if (isset($row[0]) && !empty($row[0]['video_file'])) echo $row[0]['video_file']; ?>">
                                        <a class="btn default btn-file w100 iframe-btn" id="select_image" type="button" href="<?php echo base_url(); ?>styles/assets/filemanager/dialog.php?type=0&field_id=video_link&lang=vi&akey=7d6bc44b9495644c9fb9f706c8715ee5"><i class="fa fa-upload"></i> Chọn video</a>                                       
                                    </div>                                                                
                                </div>

                                <div class="clearfix"></div><br><br>

                                <div class="form-group">                                    
                                    <label for="inputPassword1" class="control-label"><i>Ảnh đại diện</i></label>
                                    <input type="hidden" value="<?php
                                    if (isset($row[0]) && !empty($row[0]['thumbnail']))
                                        echo WEBSITE . $row[0]['thumbnail'];
                                    else
                                        echo base_url() . 'styles/assets/img/no-image.png';
                                    ?>" id="image_default">
                                    <input type="hidden" value="" id="thumbnail" name="thumbnail">
                                    <div class="form-group col-md-12" style="padding:0">
                                        <div class="show_image_preview" style="display:none;">
                                            <img class="w100 image_preview" src="" id="ace_crop">                                        
                                        </div>
                                        <div class="show_image_default">
                                            <img class="w100" src="<?php
                                            if (isset($row[0]) && !empty($row[0]['thumbnail']))
                                                echo WEBSITE . $row[0]['thumbnail'];
                                            else
                                                echo base_url() . 'styles/assets/img/no-image.png';
                                            ?>" alt=""/>                                    
                                        </div>
                                    </div>
                                    <div>
                                        <a class="btn default btn-file w100 iframe-btn" id="select_image" type="button" href="<?php echo base_url(); ?>styles/assets/filemanager/dialog.php?type=0&field_id=image_link&lang=vi&akey=7d6bc44b9495644c9fb9f706c8715ee5"><i class="fa fa-upload"></i> Chọn ảnh</a>                                       
                                        <a href="jqvascript:void(0);" id="remove_image" style="display:none;" class="btn red fileinput-exists w100" data-dismiss="fileinput">
                                            <i class="fa fa-trash-o"></i> Xóa ảnh
                                        </a>
                                    </div>                                   
                                </div>

                                <div class="form-group hidden">
                                    <div id="preview-pane">
                                        <div class="preview-container">
                                            <!-- <div class="show_image_preview" style="display:none;">
                                                <img src="" class="jcrop-preview image_preview"/>
                                            </div> -->
                                            <input id="image_link" name="link" type="hidden" value="">                                            
                                            <input id="ratio" type="hidden" value="<?php
                                            if (isset($ratio))
                                                echo $ratio;
                                            else
                                                echo 1;
                                            ?>">
                                            <input type="hidden" id="crop_x" name="crop_x"/>
                                            <input type="hidden" id="crop_y" name="crop_y"/>
                                            <input type="hidden" id="crop_w" name="crop_w"/>
                                            <input type="hidden" id="crop_h" name="crop_h"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="edit" value="edit" class="w100 btn blue"><i class="fa fa-arrow-left"></i> Cập nhật & Thoát</button>
                                    <button type="submit" name="save_edit" value="save_edit" class="w100 btn green"><i class="fa fa-plus"></i> Cập nhật & Thêm mới</button>
                                    <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/learn/index'; return false;" class="w100 btn yellow"><i class="fa fa-ban"></i> Thoát</button>
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
<script src="<?php echo base_url(); ?>/styles/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>


<script>
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

                                        $(document).ready(function () {
                                            var curr = $("#video_link").val();
                                            setInterval(function () {
                                                if ($("#video_link").val() != curr) {
                                                    curr = $("#video_link").val();

                                                    $('#pre_video').remove();
                                                    $('#playvideo').prepend("<video id='pre_video' width='100%' controls><source src='" + curr + "' type='video/mp4'></video>");

                                                    var vid = document.getElementById("pre_video");
                                                }
                                            }, 1000);
                                        });


</script>