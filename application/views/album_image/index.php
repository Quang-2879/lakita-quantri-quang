<script type="text/javascript">
    function delete_items()
    {
        var result = confirm('Bạn chắc chắn muốn xoá các bản ghi đã chọn?');
        if (result == false ) {
            return false;
        }
        $('form#form-del').submit();
    }
</script>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                 <h3 class="page-title">
                Album ảnh <small>Danh sách</small>
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
                        <a href="<?php echo base_url();?>album_image">
                            Danh sách Album ảnh
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

				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet box light-grey">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-file-text"></i> Danh sách Album ảnh (<?php echo number_format($total); ?> bản ghi)
						</div>
					</div>

					<div class="portlet-body">
						<div class="table-toolbar">
							<div class="btn-group">
								<a class="btn green" href="<?php echo base_url();?>album_image/update"><i class="fa fa-plus"></i> Thêm mới</a>

								<button class="btn red" onClick="delete_items();">
									<i class="fa fa-minus"></i> Xóa chọn
								</button>

								<label for="">
									<select size="1" class="per_page form-control input-small">
				                        <?php $session_per_page = $this->session->userdata('session_per_page');
				                        if(isset($session_per_page) && $session_per_page>0)
				                            $per_page = $session_per_page;
				                        else $per_page = 10; ?>
				                        <option <?php if($per_page==10) echo 'selected="selected"'; ?> value="10">Hiện 10</option>
				                        <option <?php if($per_page==20) echo 'selected="selected"'; ?> value="20">Hiện 20</option>
				                        <option <?php if($per_page==30) echo 'selected="selected"'; ?> value="30">Hiện 30</option>
				                        <option <?php if($per_page==50) echo 'selected="selected"'; ?> value="50">Hiện 50</option>
				                    </select>
								</label>

							</div>

							<div class="btn-group pull-right">
								<form action="<?php echo base_url();?>album_image/search" method="post">
                                    <?php if('comenu'=='comenu'){ ?> 
									<label for="">
					                    <select size="1" class="form-control input-medium" name="category">
					                        <option <?php if(isset($category) && $category==0) echo 'selected="selected"'; ?> value="0">Tất cả</option>
                                            <?php foreach ($parent_cate as $key => $cate1) { ?>
                                            <option <?php if(isset($pid) && $pid==$cate1['id']) echo 'selected="selected"'; ?> value="p<?php echo $cate1['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cate1['name']; ?></option>
                                                <?php if(isset($child_cate[$key][0])) foreach ($child_cate[$key] as $key => $cate2) { ?>
                                                <option <?php if(isset($cid) && $cid==$cate2['id']) echo 'selected="selected"'; ?> value="c<?php echo $cate2['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+++&nbsp;<?php echo $cate2['name']; ?></option>
                                            <?php }} ?>
                                        </select>					    	
									</label>	
									 <?php }else{ ?>                                    
                                    <input type="hidden" name="category" value="">
                                    <?php } ?>   

									<label for="">
										<select size="1" name="status" class="form-control input-small">
					                        <option <?php if(isset($status) && $status==2) echo 'selected="selected"'; ?> value="2">Toàn cả</option>
					                        <option <?php if(isset($status) && $status==1) echo 'selected="selected"'; ?> value="1">Hoạt động</option>
					                        <option <?php if(isset($status) && $status==0) echo 'selected="selected"'; ?> value="0">Tạm ngừng</option>
					                    </select>						    	
									</label>

									<label><input type="text" name="key_word" <?php if(isset($key_word) && $key_word !='empty') { ?> value="<?php echo $key_word; ?>" <?php }else{ ?> placeholder="Từ khóa tìm kiếm" <?php } ?> class="form-control input-medium input-inline"></label>
									<button class="btn purple">
										<i class="fa fa-search"></i> Tìm
									</button>
									<?php if(isset($is_search)){ ?>
		                            <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'album_image/index'; return false;" class="btn red">Hủy</button>
		                            <?php } ?>
								</form>
							</div>
						</div>

						<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
								<tr>
									<th class="table-checkbox center">
										<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
									</th>
									<th>
										Ảnh
									</th>
									<th>
										Id
									</th>
									<th>
										Tên bài viết
									</th>
									<th>
										Chuyên mục
									</th>
									<th>
										Ngày hiện
									</th>
									<th>
										Người đăng
									</th>
									<th>
										Trạng thái
									</th>
									<th>
										Thao tác
									</th>
								</tr>
							</thead>
							<tbody>
                				<form class="form-horizontal" role="form" action="<?php echo base_url();?>album_image/delete" method="POST" id="form-del">
									<?php foreach ($rows as $key => $value) { ?>
									<tr class="odd gradeX">
										<td class="center">
											<input type="checkbox" name="items_id[]" class="checkboxes" value="<?php echo $value['id'];?>"/>
										</td>	
										<td class="center">
                                            <img style="width:50px!important;" src="<?php if(!empty($value['image_share'])) echo WEBSITE.$value['image_share']; else echo base_url(). 'styles/assets/img/no-image2.png';?>" class="img-responsive" alt=""/>
										</td>	
										<td class="center">
											<?php echo $value['id'];?>
										</td>										
										<td>
											<a href="<?php echo base_url().'album_image/update/'.$value['id']; ?>">
												<?php echo word_limiter($value['name'], 10); ?>
											</a>
										</td>
										<td class="center">
											<?php if($value['menu_parent']>0) $cate1 = $this->lib_mod->detail('category_3s', array('id'=>$value['menu_parent']));
											if($value['menu_id']>0) $cate2 = $this->lib_mod->detail('category_3s', array('id'=>$value['menu_id']));
											if(isset($cate1[0])) echo $cate1[0]['name'];
											if(isset($cate2[0])) echo ' => ' . $cate2[0]['name'];
											unset($cate1); unset($cate2);?>
										</td>
										<td class="center">
											<?php echo date('d/m/Y', $value['time_release']);?>
										</td>
										<td class="center">
											<?php $admin = $this->lib_mod->detail('admin', array('admin_id'=>$value['admin_id_add']));
											if(isset($admin[0])) echo $admin[0]['admin_name']; else echo '...';?>
										</td>
										<td>
											<?php if($value['status']){ ?>
												<a href="<?php echo base_url().'album_image/status/'.$value['id'].'/'.$value['status']; ?>" class="txt-center btn btn-sm green filter-cancel"><i class="fa fa-check"></i></a>												
											<?php }else{ ?>
												<a href="<?php echo base_url().'album_image/status/'.$value['id'].'/'.$value['status']; ?>" class="txt-center btn btn-sm yellow filter-cancel"><i class="fa fa-times"></i></a>												
											<?php } ?>

										</td>
										<td class="center">
											<a href="<?php echo base_url().'album_image/update/'.$value['id']; ?>" class="btn default btn-xs purple">
												<i class="fa fa-edit"></i> Sửa
											</a>

											<a href="<?php echo base_url().'album_image/delete/'.$value['id']; ?>" onclick="return confirm('Bạn chắc chắn muốn xoá bản ghi này?');" class="btn default btn-xs red">
												<i class="fa fa-trash-o"></i> Xóa
											</a>
										</td>
									</tr>
									<?php } ?>								
							</tbody>
						</table>

						<div class="table-toolbar">
							<br>
							<div class="btn-group">
								<a class="btn green" href="<?php echo base_url();?>album_image/update"><i class="fa fa-plus"></i> Thêm mới</a>
								<button class="btn red" onClick="delete_items();">
									<i class="fa fa-minus"></i> Xóa chọn
								</button>

								<label for="">
									<select size="1" class="per_page form-control input-small">
				                        <?php $session_per_page = $this->session->userdata('session_per_page');
				                        if(isset($session_per_page) && $session_per_page>0)
				                            $per_page = $session_per_page;
				                        else $per_page = 10; ?>
				                        <option <?php if($per_page==10) echo 'selected="selected"'; ?> value="10">Hiện 10</option>
				                        <option <?php if($per_page==20) echo 'selected="selected"'; ?> value="20">Hiện 20</option>
				                        <option <?php if($per_page==30) echo 'selected="selected"'; ?> value="30">Hiện 30</option>
				                        <option <?php if($per_page==50) echo 'selected="selected"'; ?> value="50">Hiện 50</option>
				                    </select>						    	
								</label>
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