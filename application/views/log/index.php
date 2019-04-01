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
                Nhật ký website <small>Danh sách</small>
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
                        <a href="<?php echo base_url();?>log">
                            Danh sách nhật ký website
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
							<i class="fa fa-users"></i> Danh sách nhật ký website (<?php echo number_format($total); ?> bản ghi)
						</div>
					</div>

					<div class="portlet-body">
						<div class="table-toolbar">
							<div class="btn-group">
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
				                        <option <?php if($per_page==100) echo 'selected="selected"'; ?> value="100">Hiện 100</option>
				                    </select>
								</label>

							</div>

							<div class="btn-group pull-right">
								<form action="<?php echo base_url();?>log/search" method="post">
									<label for="">
										<select size="1" name="admin_id" class="form-control input-small">
					                        <option <?php if(isset($admin_id) && $admin_id==0) echo 'selected="selected"'; ?> value="0">Toàn bộ</option>
											<?php if(isset($admin)) foreach ($admin as $key => $value) { ?>												
					                        <option <?php if(isset($admin_id) && $admin_id==$value['admin_id']) echo 'selected="selected"'; ?> value="<?php echo $value['admin_id']; ?>"><?php echo $value['admin_name']; ?></option>
											<?php } ?>					                        
					                    </select>						    	
									</label>

									<label><input type="text" name="key_word" <?php if(isset($key_word) && $key_word !='empty') { ?> value="<?php echo $key_word; ?>" <?php }else{ ?> placeholder="Từ khóa tìm kiếm" <?php } ?> class="form-control input-medium input-inline"></label>
									<button class="btn purple">
										<i class="fa fa-search"></i> Tìm
									</button>
									<?php if(isset($is_search)){ ?>
		                            <button type="submit" onclick="window.location = window.location.protocol + '//' + window.location.host + '/' + 'log/index'; return false;" class="btn red">Hủy</button>
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
										Id
									</th>
									<th>
										Thao tác
									</th>
									<th>
										Người thao tác
									</th>
									<th>
										Thời gian
									</th>
									<th>
										Địa chỉ IP
									</th>
									<th>
										Thao tác
									</th>
								</tr>
							</thead>
							<tbody>
                				<form class="form-horizontal" role="form" action="<?php echo base_url();?>log/delete" method="POST" id="form-del">
									<?php foreach ($rows as $key => $value) { ?>
									<tr class="odd gradeX">
										<td class="center">
											<input type="checkbox" name="items_id[]" class="checkboxes" value="<?php echo $value['log_id'];?>"/>
										</td>	
										<td class="center">
											<?php echo $value['log_id'];?>
										</td>																				
										<td>
											<a href="<?php echo base_url().'log/view/'.$value['log_id']; ?>">
												<?php echo word_limiter($value['log_action'], 10); ?>
											</a>
										</td> 
										<td class="center">
											<?php $admin_exec = $this->lib_mod->detail('admin', array('admin_id'=>$value['admin_id']));											
											if(isset($admin_exec[0])) echo $admin_exec[0]['admin_name'];?>
										</td>
										<td class="center">
											<?php echo date('H:i d/m/Y', $value['log_time']);?>
										</td>
										<td class="center">
											<?php echo $value['log_ip'];?>
										</td>										
										<td class="center">
											<a href="<?php echo base_url().'log/view/'.$value['log_id']; ?>" class="btn default btn-xs blue">
												<i class="fa fa-eye"></i> Xem
											</a>
											<a href="<?php echo base_url().'log/delete/'.$value['log_id']; ?>" onclick="return confirm('Bạn chắc chắn muốn xoá bản ghi này?');" class="btn default btn-xs red">
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
				                        <option <?php if($per_page==100) echo 'selected="selected"'; ?> value="100">Hiện 100</option>
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