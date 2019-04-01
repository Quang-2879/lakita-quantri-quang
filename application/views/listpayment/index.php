<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="tl_tag_select" id="pmh_tag_select">
                <div style="margin-left: 338px;" class="banktab active1"> NỘP TIỀN QUA NGÂN HÀNG </div>
                <div class="directtab"> NỘP TIỀN TRỰC TIẾP </div>
                <div class="clr"></div>

            </div>
        </div>
        <?php if ($success == 1) { ?>
            <div class="row">
                <div class="pmh_method1 bank">
                    <div class="row-fluid1" style="min-height: 200px">
                        Thêm bản ghi thành công  !   Click vào <a href="<?php echo base_url(); ?>listpayment"> đây </a> để tiếp tục nhập.
                    </div>
                </div>
            </div>
        <?php } else {
            ?>
            <div class="row">
                <div class="pmh_method1 bank">
                    <form  action="<?php echo base_url() . "listpayment/updateviabank" ?>" method="post" name="fr_register">
                        <div class="row-fluid1">
                            <div style="margin-top: 30px; font-size: 15px;"> NỘP TIỀN QUA NGÂN HÀNG </div>
                        </div>
                        <div class="row-fluid1">
                            <div class="span12 wrap-icon-fullname2">
                                <input class="input-large LeadPanel_form_name" type="text" required placeholder="Họ tên" name="name" id="name" />
                            </div>
                        </div>	
                        <div class="row-fluid1">
                            <div class="span6 wrap-icon-email2">
                                <input type="email" name="email" id="email" class="input-large LeadPanel_form_name" required placeholder="Email"   />
                            </div>
                        </div>
                        <div class="row-fluid1">
                            <div class="span6 wrap-icon-phone2">
                                <input class="input-large LeadPanel_form_name"  required placeholder="Số điện thoại"  type="tel" name="phone" id="phone" />
                            </div>
                        </div>			  
                        <div class="row-fluid1">
                            <div class="span6 wrap-icon-district2">
                                <input  class="input-large LeadPanel_form_company" id="accountform" type="text" name="accountfrom" required placeholder="Tài khoản chuyển" />
                            </div>
                        </div>
                        <div class="row-fluid1">
                            <div class="span6  wrap-icon-province2">
                                <input class="input-large LeadPanel_form_company" id="accountto" type="text" name="accountto" required placeholder="Tài khoản nhận" />
                            </div>
                        </div>				  
                        <div class="row-fluid1">
                            <div class="span12 wrap-icon-money2">
                                <input class="input-large LeadPanel_form_company" id="amount" type="text" name="amount" required placeholder="Số tiền chuyển"  />
                            </div>
                        </div>
                        <div class="row-fluid1">
                            <div class="span12 wrap-icon-date2">
                                <input class="input-large LeadPanel_form_company" type="text"  name ="datepicker" id="datepicker" required placeholder="Ngày chuyển tiền (dd/mm/yyyy)"  />
                                <input type="hidden" name ="date1" id="date1" value="">
                            </div>
                        </div>
                        <div class="row-fluid1">
                            <div class="span12">
                                <div class="input-icon">
                                    <select class="form-control" name="courseID" id="courseID">
                                        <option >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chọn khóa học</option>
                                        <?php foreach ($courses as $key => $cour) {
                                            ?>
                                            <option value="<?php echo $cour['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cour['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="courseSelected" id="courseSelected" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid1">
                            <div style="margin-left: 60px;">
                                <input class="btn btn-large btn-primary LeadPanel_action button radius e_btn_submit reg_bt submitmethod1" type="submit" name="some_name" value="Submit" id="form-submit"/>
                            </div>
                        </div>  
                    </form>   
                </div>
                <div class="pmh_method1 direct">
                    <form  action="<?php echo base_url() . "listpayment/updateviadirect" ?>" method="post" name="fr_register">
                        <div class="row-fluid1">
                            <div style="margin-top: 30px; font-size: 15px;"> NỘP TIỀN TRỰC TIẾP </div>
                        </div>
                        <div class="row-fluid1">
                            <div class="span12 wrap-icon-fullname2">
                                <input class="input-large LeadPanel_form_name" type="text" required placeholder="Họ tên" name="name" id="name" />
                            </div>
                        </div>	
                        <div class="row-fluid1">
                            <div class="span6 wrap-icon-email2">
                                <input type="email" name="email" id="email" class="input-large LeadPanel_form_name" required placeholder="Email"   />
                            </div>
                        </div>
                        <div class="row-fluid1">
                            <div class="span6 wrap-icon-phone2">
                                <input class="input-large LeadPanel_form_name"  required placeholder="Số điện thoại"  type="tel" name="phone" id="phone" />
                            </div>
                        </div>			  
                        <div class="row-fluid1">
                            <div class="span12 wrap-icon-address2">
                                <input class="input-large LeadPanel_form_company" id="dia_chi" type="text" name="dia_chi" required placeholder="Địa chỉ"  />
                            </div>
                        </div>
                        <div class="row-fluid1">
                            <div class="span12 wrap-icon-money2">
                                <input class="input-large LeadPanel_form_company" id="amount" type="text" name="amount" required placeholder="Số tiền nộp"  />
                            </div>
                        </div>
                        <div class="row-fluid1">
                            <div class="span12 wrap-icon-date2">
                                <input class="input-large LeadPanel_form_company" type="text"  name ="datepicker2" id="datepicker2" required placeholder="Ngày nộp (dd/mm/yyyy)"  />
                                <input type="hidden" name ="date2" id="date2" value="">
                            </div>
                        </div>
                        <div class="row-fluid1">
                            <div class="span12 ">
                                <div class="input-icon">
                                    <select class="form-control" name="courseID2" id="courseID2">
                                        <option >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chọn khóa học</option>
                                        <?php foreach ($courses as $key => $cour) {
                                            ?>

                                            <option value="<?php echo $cour['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cour['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="courseSelected2" id="courseSelected2" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid1">
                            <div style="margin-left: 60px;">
                                <input class="btn btn-large btn-primary LeadPanel_action button radius e_btn_submit reg_bt submitmethod1" type="submit" name="some_name" value="Submit" id="form-submit"/>
                            </div>
                        </div>  
                    </form>   
                </div>
            </div>
        <?php } ?>
    </div>
</div>
