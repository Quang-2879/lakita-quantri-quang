<style>.has-switch{width: 100%!important;}</style>

<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">

    <div class="page-content">

       

        <!-- BEGIN PAGE HEADER-->

        <div class="row">

            <div class="col-md-12">

                <!-- BEGIN PAGE TITLE & BREADCRUMB-->

                <h3 class="page-title">

                Tin tức <small><?php if(isset($permission[0])) echo 'Cập nhật '; else 'Thêm mới '; ?></small>

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

                        <a href="<?php echo base_url();?>news">

                            Danh sách tin tức

                        </a>

                        <i class="fa fa-angle-right"></i>

                    </li>

                    <li>

                        <a href="#">

                        <?php if(isset($row[0])) echo 'Cập nhật '; else  echo 'Thêm mới '; ?> tin tức

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



            <form role="form" action="<?php echo base_url().'news/update/'.$id;?>" method="POST" enctype="multipart/form-data">

                <div class="col-md-9">

                    <!-- Thông tin chuyên mục -->

                    <div class="portlet box light_color my-border">

                        <h3 class="">&nbsp;Thông tin cơ bản</h3>

                        <div class="portlet-body form">            

                                <div class="form-body">  



                                    <?php if('comenu'=='comenu'){  

                                    if(isset($parent_cate[0])){ ?>

                                    <div class="form-group">

                                        <label for="" class="control-label"><i>Danh mục của bài viết</i></label>

                                          

                                        <div class="input-icon">

                                            <i class="fa fa-folder-open"></i>

                                            <select class="form-control" name="category">

                                                <?php foreach ($parent_cate as $key => $cate1) { ?>

                                                <option <?php if(isset($row[0]) && $row[0]['menu_id']==0 && $row[0]['menu_parent']==$cate1['id']) echo 'selected="selected"'; ?> value="p<?php echo $cate1['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cate1['name']; ?></option>

                                                    <?php if(isset($child_cate[$key][0])) foreach ($child_cate[$key] as $key => $cate2) { ?>

                                                    <option <?php if(isset($row[0]) && $row[0]['menu_id']==$cate2['id']) echo 'selected="selected"'; ?> value="c<?php echo $cate2['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+++&nbsp;<?php echo $cate2['name']; ?></option>

                                                <?php }} ?>

                                            </select>

                                        </div>

                                    </div>   

                                    <?php }}else{ ?>                                    

                                    <input type="hidden" name="category" value="">

                                    <?php } ?>                                    



                                    <div class="form-group">

                                        <label for="" class="control-label"><i>Tên hiển thị trên web</i></label>

                                        <div class="input-icon">

                                            <i class="fa fa-file-text"></i>

                                            <input class="form-control" type="text" id="name" required="true" value="<?php if(isset($row[0])) echo $row[0]['name'];?>" name="name" onkeyup="ChangeToSlug();"/>

                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label for="" class="control-label"><i>Slug - Đường dẫn trên url</i></label>

                                        <div class="input-icon">

                                            <i class="fa fa-globe"></i>

                                            <input class="form-control" type="text" id="slug" required="true" value="<?php if(isset($row[0])) echo $row[0]['slug'];?>" name="slug" />

                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label for="" class="control-label"><i>Tên hiển thị trên thanh tiêu đề (SEO meta_title)</i></label>

                                        <div class="input-icon">

                                            <i class="fa fa-file-text"></i>

                                            <input class="form-control" type="text" id="title" required="true" value="<?php if(isset($row[0])) echo $row[0]['title'];?>" name="title" />

                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label for="description"><i>Tag cho bài viết</i></label>

                                        <textarea  rows="4" class="form-control tags mytags" name="tag"><?php if(isset($row[0])) echo $row[0]['tag'];?></textarea>

                                    </div>



                                    <div class="form-group">

                                        <label for="description"><i>Từ khóa cho bài viết (SEO meta_keyword)</i></label>

                                        <textarea  rows="4" class="form-control tags mytags" name="meta_keywords"><?php if(isset($row[0])) echo $row[0]['meta_keywords'];?></textarea>

                                    </div>



                                    <div class="form-group">

                                        <label for="description"><i>Mô tả hiển thị trên web</i></label>

                                        <textarea class="editor form-control vert" id="description" name="description" rows="3" ><?php if(isset($row[0])) echo $row[0]['description'];?></textarea>

                                    </div>



                                    <div class="form-group">

                                        <label for="meta_description"><i>Mô tả cho công cụ tìm kiếm (SEO meta_description)</i></label>

                                        <textarea class="editor form-control vert" id="meta_description" name="meta_description" rows="3" ><?php if(isset($row[0])) echo $row[0]['meta_description'];?></textarea>

                                    </div>



                                    <div class="form-group">

                                         <label for="description"><i>Nội dung</i></label>

                                         <textarea class="editor form-control vert ace-editer" id="content" name="content" rows="3" ><?php if(isset($row[0])) echo $row[0]['content'];?></textarea>

                                    </div>

                                

                                </div>                       

                                <div class="clearfix"></div> 

                             </div>

                    </div>                           

                </div>

                

                <div class="col-md-3">

                    <div class="portlet box light_color my-border">

                        <h3 class="">&nbsp;Thao tác</h3>

                        <div class="portlet-body form">            

                            <div class="form-body">



                                <div class="form-group">

                                    <label for="inputEmail12" class="control-label pull-left"><i>Trạng thái</i></label>

                                    <input type="checkbox" name="status" value="1" <?php if(isset($row[0]) && $row[0]['status']==1) echo 'checked';?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Xuất bản&nbsp;" data-off-label="Lưu nháp">

                                </div>



                                <div class="form-group">

                                    <label for="inputEmail12" class="control-label pull-left"><i>Nổi bật</i></label>

                                    <input type="checkbox" name="hot" value="1" <?php if(isset($row[0]) && $row[0]['hot']==1) echo 'checked';?> class="make-switch" style="width:100%!important;" data-on-label="&nbsp;Có chọn&nbsp;" data-off-label="Bỏ chọn">

                                </div>



                                <div class="form-group">

                                    <label for="inputEmail12" class="control-label pull-left"><i>Hẹn giờ</i></label>

                                    <div class="input-group w100 date date-picker" data-date="<?php if(isset($row[0]) && !empty($row[0]['time_release'])) echo date('d-m-Y', $row[0]['time_release']); else echo date('d-m-Y');?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">

                                        <input name="time_release" type="text" class="form-control" readonly value="<?php if(isset($row[0]) && !empty($row[0]['time_release'])) echo date('d-m-Y', $row[0]['time_release']); else echo date('d-m-Y');?>">

                                        <span class="input-group-btn">

                                            <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>

                                        </span>

                                    </div>

                                </div>



                               <!--  <div class="form-group">

                                   <label for="inputPassword1" class="control-label"><i>Ảnh đại diện</i></label>

                                   <div class="fileinput fileinput-new w100" data-provides="fileinput">

                                       <div class="fileinput-new image">

                                           <img class="w100" src="<?php if(isset($row[0]) && !empty($row[0]['image'])) echo WEBSITE.$row[0]['image']; else echo base_url(). 'styles/assets/img/no-image.png';?>" alt=""/>

                                       </div>

                                       <div class="fileinput-preview fileinput-exists image w100">

                                       </div>

                                       <div>

                                           <span class="btn default btn-file w100">

                                               <span class="fileinput-new">

                                                   Chọn ảnh

                                               </span>

                                               <span class="fileinput-exists yellow">

                                                   Sửa ảnh

                                               </span>

                                               <input type="file" name="image">

                                           </span>

                                           <a href="#" class="btn red fileinput-exists w100" data-dismiss="fileinput">

                                               Xóa ảnh

                                           </a>

                                       </div>

                                   </div>

                               </div> -->





                                <div class="form-group">                                    

                                    <input type="hidden" value="<?php if(isset($row[0]) && !empty($row[0]['image_share'])) echo WEBSITE.$row[0]['image_share']; else echo base_url(). 'styles/assets/img/no-image.png';?>" id="image_default">

                                    <input type="hidden" value="" id="thumbnail" name="thumbnail">

                                    <div class="form-group col-md-12" style="padding:0">

                                        <div class="show_image_preview" style="display:none;">

                                            <img class="w100 image_preview" src="" id="ace_crop">                                        

                                        </div>

                                        <div class="show_image_default">

                                            <img class="w100" src="<?php if(isset($row[0]) && !empty($row[0]['image_share'])) echo WEBSITE.$row[0]['image_share']; else echo base_url(). 'styles/assets/img/no-image.png';?>" alt=""/>                                    

                                        </div>

                                    </div>

                                    <div>

                                        <a class="btn default btn-file w100 iframe-btn" id="select_image" type="button" href="<?php echo base_url();?>styles/assets/filemanager/dialog.php?type=0&field_id=image_link&lang=vi&akey=7d6bc44b9495644c9fb9f706c8715ee5">

                                        <i class="fa fa-upload"></i> Chọn ảnh</a>

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

                                            <input id="ratio" type="hidden" value="<?php if(isset($ratio)) echo $ratio; else echo 1; ?>">

                                            <input type="hidden" id="crop_x" name="crop_x"/>

                                            <input type="hidden" id="crop_y" name="crop_y"/>

                                            <input type="hidden" id="crop_w" name="crop_w"/>

                                            <input type="hidden" id="crop_h" name="crop_h"/>

                                        </div>

                                    </div>

                                </div>





                        

                                <br><div class="form-group">

                                    <button type="submit" name="edit" value="edit" class="w100 btn blue"><i class="fa fa-arrow-left"></i> Cập nhật & Thoát</button>

                                    <button type="submit" name="save_edit" value="save_edit" class="w100 btn green"><i class="fa fa-plus"></i> Cập nhật & Thêm mới</button>

                                    <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/news/index'; return false;" class="w100 btn yellow"><i class="fa fa-ban"></i> Thoát</button>

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
<!-- END CONTENT -->