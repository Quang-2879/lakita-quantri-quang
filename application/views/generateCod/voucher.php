 <?php
                    
                    if ($genVoucher == 1) {
                        echo '<div style="font-size:20px;text-align: center;"> Các mã kích hoạt là: </div>';
                        foreach ($voucherInserted as $value) {
                            echo '<p class="lakita" style="font-size:20px;text-align: center;">' . $value . '</p>';
                        }
                        echo '<p style="font-size:20px;text-align: center;"> Click vào <a href="' . base_url() . 'generateCod/generateVoucher' . '"> ĐÂY </a> để sinh voucher tiếp </p>';
                    }
                    else{
                    ?>

<div class="row">
    <div class="pmh_method1 bank">
        <form action="<?php echo base_url();?>generateCod/generateVoucher" method="post" name="fr_register">
            <div class="row-fluid1" style="padding-right: 42px;">
                <div class="span12">
                    <div class="input-icon">
                        <select class="form-control" name="courseID" id="courseID">
                            <option value="select">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chọn khóa học</option>
                            <?php foreach ($courses as $key => $cour) {
                                ?>
                                <option value="<?php echo $cour['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cour['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row-fluid1" style="padding-right: 42px;">
                <div class="span12">
                    <div class="input-icon">
                        <input class="input-large LeadPanel_form_name" type="text" name="money" id="money" placeholder="Số tiền discount" />
                    </div>
                </div>
            </div>
            <div class="row-fluid1">
                <div class="span12">
                    <input class="input-large LeadPanel_form_name" type="text" placeholder="ID người giới thiệu" name="merchantID" id="merchantID" />
                </div>
            </div>
             <div class="row-fluid1">
                <div class="span12">
                    <input class="input-large LeadPanel_form_name" type="text" placeholder="Số lượng voucher" name="number" id="number" />
                </div>
            </div>
            <div class="row-fluid1">
                <div style="margin-left: 60px;">
                    <input class="btn btn-large btn-primary LeadPanel_action button radius e_btn_submit reg_bt submitmethod1" type="submit" name="submitGenVoucher" value="Tạo voucher" id="form-submit">
                </div>
            </div>  
        </form>  
    </div>
   
</div>
                    <?php }?>