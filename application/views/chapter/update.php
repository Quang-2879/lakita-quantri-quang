<style>.has-switch{width: 100%!important;}</style>

<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">

    <div class="page-content">

       

        <!-- BEGIN PAGE HEADER-->

        <div class="row">

            <div class="col-md-12">

                <!-- BEGIN PAGE TITLE & BREADCRUMB-->

                <h3 class="page-title">

                Chương <small><?php if(isset($chapter[0])) echo 'Cập nhật '; else 'Thêm mới '; ?></small>

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

                        <a href="<?php echo base_url();?>chapter">

                            Danh sách Chương

                        </a>

                        <i class="fa fa-angle-right"></i>

                    </li>

                    <li>

                        <a href="#">

                            <?php if(isset($chapter[0])) echo 'Cập nhật '; else 'Thêm mới '; ?> Chương

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



            <form role="form" action="<?php echo base_url().'chapter/update/'.$id;?>" method="POST" enctype="multipart/form-data">

                <div class="col-md-9">

                    <!-- Thông tin chuyên mục -->

                    <div class="portlet box light_color my-border">

                        <h3 class="">&nbsp;Thông tin cơ bản</h3>

                        <div class="portlet-body form">            

                            <div class="form-body">  

                                <div class="form-group">

                                    <label class="control-label"><i>Khóa học</i></label>

                                    <div class="input-icon">

                                        <i class="fa fa-folder-open"></i>

                                        <select class="form-control" name="courses_id">

                                            <?php if(isset($courses[0])){

												$course_cur=0;

													if(isset($courses_cur[0])) $course_cur=$courses_cur[0]['courses_id'];

												foreach ($courses as $key => $value) { ?>

                                            <option value="<?php echo $value['id']; ?>" <?php if($value['id']==$course_cur) echo 'selected'; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value['name']; ?></option>

                                            <?php }} ?>

                                        </select>

                                    </div>

                                </div>   



                                <div class="form-group">

                                    <label class="control-label"><i>Tên Chương</i></label>

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

                                    <label class="control-label"><i>Ảnh đại diện nếu có</i></label>

                                    <div class="fileinput fileinput-new w100" data-provides="fileinput">

                                        <div class="fileinput-new image">

                                            <img class="w100" src="<?php if(isset($row[0]) && !empty($row[0]['image'])) echo WEBSITE.$row[0]['image']; else echo base_url(). 'styles/assets/img/no-image.png';?>"/>

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

                                                <input type="file" name="image">

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

                                    <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'chapter/index'; return false;" class="w100 btn yellow"><i class="fa fa-ban"></i> Thoát</button>

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
</script>