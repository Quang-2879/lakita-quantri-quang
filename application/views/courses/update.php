<style>.has-switch, .ms-container{width: 100%!important;}</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
       
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                Khóa học <small><?php if(isset($courses[0])) echo 'Cập nhật '; else 'Thêm mới '; ?></small>
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
                        <a href="<?php echo base_url();?>courses">
                            Danh sách Khóa học
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <?php if(isset($courses[0])) echo 'Cập nhật '; else 'Thêm mới '; ?> Khóa học
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

            <form role="form" action="<?php echo base_url().'courses/update/'.$id;?>" method="POST" enctype="multipart/form-data">
                <div class="col-md-9">
                    <!-- Thông tin chuyên mục -->
                    <div class="portlet box light_color my-border">
                        <h3 class="">&nbsp;Thông tin cơ bản</h3>
                        <div class="portlet-body form">            
                            <div class="form-body">  
                                <div class="form-group">
                                    <label class="control-label"><i>Nhóm khóa học</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-folder-open"></i>
                                        <select class="form-control" name="group_courses_id">                                            
                                            <?php if(isset($group_courses[0])) foreach ($group_courses as $key => $value) { 
                                                
                                                ?>
                                            <option <?php if( $value['id'] == $group_courses_id) echo 'selected="selected"';?> value="<?php echo $value['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-labe"><i>Chọn giảng viên</i></label>
                                    <select multiple="multiple" class="multi-select" id="my_multi_select1" name="speaker[]">
                                        <?php foreach ($speaker as $key => $value) { ?>
                                        <option value="-<?php echo $value['id'] ?>-" <?php if(isset($row[0]) && in_array('-'.$value['id'].'-', array_filter(explode(',', $row[0]['speaker_id'])))) echo 'selected'; ?>><?php echo $value['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>  

                                <div class="form-group">
                                    <label class="control-label"><i>Tiêu đề Khóa học</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-align-justify"></i>
                                        <input class="form-control" type="text" required="true" value="<?php if(isset($row[0])) echo $row[0]['title'];?>" name="title" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label"><i>Tên Khóa học</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-align-justify"></i>
                                        <input class="form-control" type="text" id="name" required="true" value="<?php if(isset($row[0])) echo $row[0]['name'];?>" name="name" onkeyup="ChangeToSlug();"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label"><i>Slug - Đường dẫn web</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-globe"></i>
                                        <input class="form-control" type="text" id="slug" required="true" value="<?php if(isset($row[0])) echo $row[0]['slug'];?>" name="slug" />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label"><i>Mã khóa học</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-globe"></i>
                                        <input class="form-control" type="text" id="course_code" value="<?php if(isset($row[0])) echo $row[0]['course_code'];?>" name="course_code" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label"><i>Thứ tự hiển thị</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-sort-numeric-desc"></i>
                                        <input class="form-control" type="text" required="true" value="<?php if(isset($row[0])) echo $row[0]['sort'];?>" name="sort" />
                                    </div>
                                </div>

                                
                                <div class="form-group">
                                    <label class="control-label"><i>Từ khóa</i></label>
                                    <div class="input-icon">
                                        <i class="fa fa-key"></i>
                                        <textarea  rows="4" class="form-control tags" id="tags_1" name="keyword"><?php if(isset($row[0])) echo $row[0]['keyword'];?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label"><i>Mô tả</i></label>
                                    <div class="input-icon">
                                        <textarea  rows="4" class="form-control" name="description"><?php if(isset($row[0])) echo $row[0]['description'];?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description"><i>Nội dung</i></label>
                                    <textarea class="editor form-control vert ace-editer" id="content" name="content" rows="3" ><?php if(isset($row[0])) echo $row[0]['content'];?></textarea>
                                </div>

                                <div class="form-group">
                                        <br>
                                        <label for="inputEmail12" class="control-label pull-left"><i>Đính kèm tài liệu</i></label>
                                        <table role="presentation" class="table table-striped clearfix">
                                           <tbody class="files">
                                                <?php if(isset($row[0])){
                                                $attach_file = array_filter(explode('@', $row[0]['attach_file']));
                                                $attach_desc = array_filter(explode('@', $row[0]['attach_desc']));
                                                foreach ($attach_file as $key => $value) {
                                                $extension = explode('.', $value);
                                                $extension = end($extension);
                                                $filename = explode('/', $value);
                                                $filename = end($filename);

                                                if($extension == 'png' || $extension == 'gif' || $extension == 'jpg' || $extension == 'jpeg')
                                                    $show = WEBSITE.$value;
                                                elseif($extension == 'pdf' || $extension == 'ppt' || $extension == 'pptx' || $extension == 'rar' || $extension == 'zip' || $extension == 'gzip' || $extension == 'mp4' || $extension == 'flv' || $extension == 'mp3' || $extension == 'doc' || $extension == 'docx' || $extension == 'xls' || $extension == 'xlsx')
                                                    $show = base_url().'data/img/' . $extension . '.jpg';
                                                else
                                                    $show = base_url().'data/img/unknow.jpg';
                                                ?>
                                                <tr class="template-upload fade in">
                                                    <td>
                                                        <span class="preview">
                                                            <img width="50" height="40" src="<?php echo $show;?>">
                                                        </span>
                                                    </td>
                                                    <td class="input-medium">
                                                        <input type="hidden" class="att_name" name="att_name[]" value="<?php echo $value;?>">
                                                        <p class="name"><?php echo $filename; ?></p>
                                                    </td>
                                                    <td>
                                                        <input class="form-control input-medium" type="text" placehold="Nhập mô tả" value="<?php if(isset($attach_desc[$key])) echo $attach_desc[$key];?>" name="att_description[]" />
                                                    </td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <a href="<?php echo $show;?>" class="btn blue start btn-sm iframe-img">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                           <!--  <button class="btn green btn-sm download">
                                                               <i class="fa fa-download"></i>
                                                           </button> -->
                                                            <button class="btn red btn-sm delete_attach">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <br>
                                                <?php }} ?>
                                                <tr class="template-upload fade in">
                                                </tr>
                                           </tbody>
                                        </table>

                                        <input type="hidden" id="attach_link" value="">
                                        <a class="btn blue start iframe-btn" id="attach_file" type="button" href="<?php echo base_url();?>styles/assets/filemanager/dialog.php?type=0&field_id=attach_link&lang=vi&akey=7d6bc44b9495644c9fb9f706c8715ee5">
                                            <i class="fa fa-upload"></i> Chọn file đính kèm
                                        </a>                  
                                    </div>

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
                                    <input type="checkbox" value="1" name="status" <?php if(isset($row[0]) && $row[0]['status']==1) echo 'checked';?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Hoạt động&nbsp;" data-off-label="Lưu nháp">
                                </div>  
                             
                                <div class="form-group">
                                    <label class="control-label pull-left"><i>Nổi bật</i></label>
                                    <input type="checkbox" value="1" name="hot" <?php if(isset($row[0]) && $row[0]['hot']==1) echo 'checked';?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Có chọn&nbsp;" data-off-label="Bỏ chọn">
                                </div>  

                                <div class="form-group">
                                    <label class="control-label pull-left"><i>Mất phí</i></label>
                                    <input type="checkbox" value="1" name="free" <?php if(isset($row[0]) && $row[0]['free']==1) echo 'checked';?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Có chọn&nbsp;" data-off-label="Bỏ chọn">
                                </div>  

                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Giá gốc</i></label>
                                    <input class="form-control mymoney" value="<?php if(isset($row[0])) echo $row[0]['price_root2'];?>" name="price_root" type="text"/>
                                </div>   

                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Giá khuyến mại</i></label>
                                    <input class="form-control mymoney" value="<?php if(isset($row[0])) echo $row[0]['price_sale'];?>" name="price_sale" type="text"/>
                                </div>  

                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Độ dài khóa học</i></label>
                                    <input class="form-control" name="length" value="<?php if(isset($row[0])) echo $row[0]['length'];?>" type="text"/>
                                </div>  

                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Ngôn ngữ</i></label>
                                    <input class="form-control" name="language" value="<?php if(isset($row[0])) echo $row[0]['language'];?>" type="text"/>
                                </div>  

                                <div class="form-group">
                                    <label for="inputEmail12" class="control-label pull-left"><i>Ngày bắt đầu</i></label>
                                    <div class="input-group w100 date date-picker" data-date="<?php if(isset($row[0]) && !empty($row[0]['time_release'])) echo date('d-m-Y', $row[0]['time_release']); else echo date('d-m-Y');?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                        <input name="time_release" type="text" class="form-control" readonly value="<?php if(isset($row[0]) && !empty($row[0]['time_release'])) echo date('d-m-Y', $row[0]['time_release']); else echo date('d-m-Y');?>">
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>


                                <div class="form-group col-md-12" style="padding:0">
                                    <div id="playvideo">
                                        <?php if (isset($row[0]) && !empty($row[0]['video'])) { ?>
                                            <video id="pre_video" width="100%" controls>
                                                <source src="<?php echo WEBSITE . $row[0]['video']; ?>" type="video/mp4">
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

                                    <input name="video" type="hidden" id="video_link" value="<?php if (isset($row[0]) && !empty($row[0]['video'])) echo $row[0]['video']; ?>">
                                    <a class="btn default btn-file w100 iframe-btn" id="select_image" type="button" href="<?php echo base_url(); ?>styles/assets/filemanager/dialog.php?type=0&field_id=video_link&lang=vi&akey=7d6bc44b9495644c9fb9f706c8715ee5"><i class="fa fa-upload"></i> Chọn video</a>                                       
                                </div>   
                                <div class="form-group">                                    
                                    <label for="inputEmail12" class="control-label pull-left"><i>Ảnh đại diện</i></label>
                                    <input type="hidden" value="<?php if(isset($row[0]) && !empty($row[0]['image'])) echo WEBSITE.$row[0]['image']; else echo base_url(). 'styles/assets/img/no-image.png';?>" id="image_default">
                                    <input type="hidden" value="" id="thumbnail" name="image">
                                    <div class="form-group col-md-12" style="padding:0">
                                        <div class="show_image_preview" style="display:none;">
                                            <img class="w100 image_preview" src="" id="ace_crop">                                        
                                        </div>
                                        <div class="show_image_default">
                                            <img class="w100" src="<?php if(isset($row[0]) && !empty($row[0]['image'])) echo WEBSITE.$row[0]['image']; else echo base_url(). 'styles/assets/img/no-image.png';?>" alt=""/>                                    
                                        </div>
                                    </div>
                                    <div>
                                        <a class="btn default btn-file w100 iframe-btn" id="select_image" type="button" href="<?php echo base_url();?>styles/assets/filemanager/dialog.php?type=0&field_id=image_link&lang=vi&akey=7d6bc44b9495644c9fb9f706c8715ee5"><i class="fa fa-upload"></i> Chọn ảnh</a>
                                        <a href="jqvascript:void(0);" id="remove_image" style="display:none;" class="btn red fileinput-exists w100" data-dismiss="fileinput">
                                            <i class="fa fa-trash-o"></i> Xóa ảnh
                                        </a>
                                    </div>                                   
                                </div>

                                <div class="form-group hidden">
                                    <div id="preview-pane">
                                        <div class="preview-container">
                                            <input id="image_link" name="link" type="hidden" value="">                                            
                                            <input id="ratio" type="hidden" value="<?php if(isset($ratio)) echo $ratio; else echo 1; ?>">
                                            <input type="hidden" id="crop_x" name="crop_x"/>
                                            <input type="hidden" id="crop_y" name="crop_y"/>
                                            <input type="hidden" id="crop_w" name="crop_w"/>
                                            <input type="hidden" id="crop_h" name="crop_h"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label"><i>Ảnh chia sẻ mạng xã hội</i></label>
                                    <div class="fileinput fileinput-new w100" data-provides="fileinput">
                                        <div class="fileinput-new image">
                                            <img class="w100" src="<?php if(isset($row[0]) && !empty($row[0]['image_share'])) echo WEBSITE.$row[0]['image_share']; else echo base_url(). 'styles/assets/img/no-image.png';?>"/>
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
                                                <input type="file" name="image_share">
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
                                    <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'courses/index'; return false;" class="w100 btn yellow"><i class="fa fa-ban"></i> Thoát</button>
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