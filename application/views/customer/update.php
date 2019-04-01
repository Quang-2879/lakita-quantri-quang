<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
       
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                Khách hàng <small><?php if(isset($row[0])) echo 'Cập nhật '; else 'Thêm mới '; ?></small>
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
                        <a href="<?php echo base_url();?>customer">
                            Danh sách khách hàng
                        </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <?php if(isset($row[0])) echo 'Cập nhật '; else 'Thêm mới '; ?> khách hàng
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
                    <form class="form-horizontal" role="form" action="<?php echo base_url().'customer/update/'.$id;?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Họ tên</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-user"></i>
                                    <input class="form-control" type="text" required="true" value="<?php if(isset($row[0])) echo $row[0]['name'];?>" name="name" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Email</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input type="email" class="form-control" required="true" value="<?php if(isset($row[0])) echo $row[0]['email'];?>" name="email">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Di động</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-phone"></i>
                                    <input class="form-control" type="text" required="true" value="<?php if(isset($row[0])) echo $row[0]['phone'];?>" name="phone" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Địa chỉ</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-map-marker"></i>
                                    <input class="form-control" type="text" required="true" value="<?php if(isset($row[0])) echo $row[0]['address'];?>" name="address" />
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Dịch vụ</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-cloud"></i>
                                    <select name="service" class="form-control">
                                        <option <?php if(isset($row[0]) && $row[0]['service']==0) echo 'selected="selected"'; ?> value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Facebook Ads</option>
                                        <option <?php if(isset($row[0]) && $row[0]['service']==1) echo 'selected="selected"'; ?> value="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Google Adword</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail12" class="col-md-3 control-label">Ghi chú</label>
                            <div class="col-md-6">
                                <div class="input-icon">
                                    <i class="fa fa-bullhorn"></i>
                                    <textarea  rows="4" class="form-control" name="note"><?php if(isset($row[0])) echo $row[0]['note'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($row[0])) echo $row[0]['note'];?></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputPassword1" class="col-md-3 control-label">Ảnh đại diện</label>
                            <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img style="width: 200px; height: 150px;" src="<?php if(isset($row[0]) && !empty($row[0]['thumbnail'])) echo base_url().$row[0]['thumbnail']; else echo base_url(). 'styles/assets/img/no-image.png';?>" alt=""/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                    </div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <i class="fa fa-upload"></i>  
                                            <span class="fileinput-new">
                                                Chọn ảnh
                                            </span>
                                            <span class="fileinput-exists">
                                                Sửa
                                            </span>
                                            <input type="file" name="thumbnail">
                                        </span>
                                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                            <i class="fa fa-trash-o"></i> Xóa
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" name="edit" value="edit" class="btn green"><i class="fa fa-arrow-left"></i> Cập nhật</button>
                                <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'customer/index'; return false;" class="btn yellow"><i class="fa fa-ban"></i> Thoát</button>
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