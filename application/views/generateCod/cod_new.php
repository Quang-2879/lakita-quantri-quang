<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="tl_tag_select" id="pmh_tag_select">
                <div style="margin-left: 300px;" class="banktab <?php if ($activity == 0) echo 'active1'; ?>"> SINH MÃ KÍCH HOẠT </div>
                
                <div class="directtab <?php if ($activity == 1) echo 'active1'; ?>"> KIỂM TRA MÃ KÍCH HOẠT </div>
                <div class="clr"></div>

            </div>
        </div>

        <!--            <div class="row">
                        <div class="pmh_method1 bank">
                            <div class="row-fluid1" style="min-height: 200px">
                                Thêm bản ghi thành công  !   Click vào <a href="<?php echo base_url(); ?>listpayment"> đây </a> để tiếp tục nhập.
                            </div>
                        </div>
                    </div>-->

        <div class="row">
            <!-- kiểm tra mã kích hoạt -->
            
            <?php
            if ($activity == 1) {
                $learn = (isset($trial_learn) && $trial_learn == 0) ? 'Học thật' : 'Học thử';

                if ($codStt == 'notActive') {
                    echo '<p style="font-size:20px;text-align: center;"> Mã "' . $cod . '" tồn tại trên hệ thống nhưng chưa được kích hoạt (mã của khóa học "[' . $learn . '] ' . $courseNotactive . '")</p>';
                } else if ($codStt == 'notValid') {
                    echo '<p style="font-size:20px;text-align: center;">Mã "' . $cod . '" không tồn tại trên hệ thống </p>';
                } else {
                    echo '<p style="font-size:20px;text-align: center;"> Mã "' . $cod . '"  đã được kích hoạt bởi "' . $activedDetail['studentEmail'] . '" lúc ' . date('H:i:s \n\g\à\y d/m/Y', $activedDetail['time']) . ' (mua khóa học "[' . $learn . '] ' . $activedDetail['courseName'] . '") </p>';
                }
                ?>
                <div class="text-center pmh_method1">
                    <form  action="<?php echo base_url() . "generateCod/checkCod" ?>" method="post" name="fr_register">
                        <div class="row-fluid1">
                            <div class="span12">
                                <input class="input-large LeadPanel_form_name" type="text" required placeholder="Nhập mã kích hoạt càn kiểm tra" id="cod" name ="cod"/>
                            </div>
                        </div>	
                        <div class="row-fluid1">
                            <div style="margin-left: -20px;" >
                                <input class="btn btn-large btn-primary LeadPanel_action button radius e_btn_submit reg_bt submitmethod1" type="submit" name="some_name" value="Kiểm tra mã" id="form-submit"/>
                            </div>
                        </div>  
                    </form>  
                </div> 
                <?php
            }
            ?>

            <!-- tạo mã khóa học đơn activity 0 -->

            <?php if ($activity == 0) { ?>
                <div class="pmh_method1 bank">
                    <?php if ($generated == 0) { ?>
                        <form  action="<?php echo base_url() . "generateCod/generate_new" ?>" method="post" name="fr_register">

                            <div class="row-fluid1">
                                <div class="span12">
                                    <input class="input-large LeadPanel_form_name" type="text" required placeholder="Số lượng mã" name="number" id="number" />
                                </div>
                            </div>
                            <div class="row-fluid1" style="padding-right: 42px;">
                                <div class="span12">
                                    <div class="input-icon">
                                        <input class="input-large LeadPanel_form_name" type="text" required placeholder="Lý do tạo mã" name="reason" id="reason" />
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid1">
                                <div style="margin-left: 60px;">
                                    <input type="submit" class="btn btn-large btn-primary LeadPanel_action button radius e_btn_submit reg_bt submitmethod1" name="some_name" value="Tạo mã" id="form-submit"/>
                                </div>
                            </div>  
                        </form>  
                        <?php
                    }
                    
                    if ($generated == 1) {
                        echo '<div style="font-size:20px;text-align: center;"> Các mã kích hoạt là: </div>';
                        foreach ($cod_add as $value) {
                            echo '<p class="lakita" style="font-size:20px;text-align: center;">' . $value . '</p>';
                        }
                        echo '<p style="font-size:20px;text-align: center;"> Click vào <a href="' . base_url() . 'generateCod/new_cod_view' . '"> ĐÂY </a> để sinh mã tiếp </p>';
                    }
                    ?>
                </div>
            <?php } ?>


            <div class="pmh_method1 direct">
                <form  action="<?php echo base_url() . "generateCod/checkCod" ?>" method="post" name="fr_register">
                    <div class="row-fluid1">
                        <div class="span12">
                            <input class="input-large LeadPanel_form_name" type="text" required placeholder="Nhập mã kích hoạt cần kiểm tra" id="cod" name ="cod"/>
                        </div>
                    </div>	
                    <div class="row-fluid1">
                        <div style="margin-left: 60px;">
                            <input class="btn btn-large btn-primary LeadPanel_action button radius e_btn_submit reg_bt submitmethod1" type="submit" name="some_name" value="Kiểm tra mã" id="form-submit"/>
                        </div>
                    </div>  
                </form>  
            </div>

            
        </div>
    </div>
</div>
