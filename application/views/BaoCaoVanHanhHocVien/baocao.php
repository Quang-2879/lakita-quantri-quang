

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>jQuery UI Datepicker - Default functionality</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
        <script>
            $(function () {
                $(".datepicker").datepicker({
                    dateFormat: "dd/mm/yy",
                    changeYear: true,
                    changeMonth: true,
                });
            });
        </script>
        <style>
            table{
                margin: 0 auto;
                border-collapse: collapse;
                background-color: #f7f7f7;
            }

            table, th, td {
                border: 1px solid black;
            }
            thead{
                background-color: #009933;
                color: white;
            }
            th{
                padding: 5px 5px;
            }
            td{
                padding: 5px 5px;
            }
            form{
                margin-left:200px;
                margin-top: 30px;
                margin-bottom: 30px;
            }
            form >input{
                padding: 10px 10px; 
                margin-right: 50px;
                background-color: #f7f7f7;
                border: none;
                border:1px solid #f1f1f1;
            }
            th.kt{
                background-color: #939939;
            }
            th.ex{
                background-color: #006600;
            }
            td.kh{
                background-color: #DD0000;
                color: #fff;
            }
            td.vd{
                color: white;
                background-color: #666666;
            }
            td.cmt{
                color: white;
                background-color: #AA0000;
            }
            td.vote{
                color: white;
                background-color: #777777;
            }

        </style>
    </head>
    <body>

        <div class="content">
            <?php
            date_default_timezone_set('Asia/Ho_Chi_Minh');


            $date1 = (isset($start)) ? $start : date('d/m/y');
            $date2 = (isset($end)) ? $end : date('d/m/y');
            ?>

            <h1 style="text-align: center">Báo cáo vận hành học viên</h1>
            <form action="" method="post" >
                Từ: <input readonly="readonly" type="text" class="datepicker" name="date1" value="<?php echo $date1; ?>">
                Đến: <input readonly="readonly" type="text" class="datepicker" name="date2" value="<?php echo $date2; ?>">
                <input type="submit" value="Tìm kiếm" name="sub" style="        background-color: #009933;color: white;">
            </form>
            <div class="result">
                <?php
                ?>
            </div>
            <table>
                <thead>
                <th></th>
                <th class="kt">KT110</th>
                <th class="kt">KT130</th>
                <th class="kt">KT120</th>
                <th class="kt">KT210</th>
                <th class="kt">KT800</th>
                <th class="kt">KT600</th>
                <th class="kt">KT400</th>
                <th class="kt">KT500</th>
                <th class="kt">KT300</th>
                <th class="kt">KT100</th>
                <th class="kt">KT200</th>
                <th class="ex">EM100</th>
                <th class="ex">E100</th>
                <th class="ex">E200</th>
                <th class="ex">E300</th>
                <th class="ex">E400</th>
                </thead>
                <tbody>
                    <tr style="border-bottom: 2px solid #000;">
                        <td class="kh">Tổng số Kh đã kích hoạt tính đến thời điểm hiện tại</td>
<?php foreach ($tongkh as $key => $value) {
    ?> <td><?php echo $value['sohv'] ?> </td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td class="vd">Tổng số Kh học ít nhất 1 video</td>
<?php foreach ($motvideo as $key => $value) {
    ?> <td><?php echo $value['sohocvien'] ?> </td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td class="vd">Tổng số Kh học ít nhất 10 video</td>
                        <?php foreach ($muoivideo as $key => $value) {
                            ?> <td><?php echo $value['sohocvien'] ?> </td>
<?php } ?>
                    </tr>
                    <tr style="border-bottom: 2px solid #000;">
                        <td class="vd">Tổng số Kh toàn bộ video</td>
                        <?php foreach ($allvideo as $key => $value) {
                            ?> <td><?php echo $value['sohocvien'] ?> </td>
<?php } ?>
                    </tr>

                    <tr style="border-bottom: 2px solid #000;">
                        <td class="cmt">Tổng số khách hàng viết cảm nhận</td>
                        <?php foreach ($camnhan as $key => $value) {
                            ?> <td><?php echo $value['socamnhan'] ?> </td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td class="vote">Tổng số khách hàng đánh 5 sao khóa học</td>
<?php foreach ($fivestar as $key => $value) {
    ?> <td><?php echo $value['sovote'] ?> </td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td class="vote">Tổng số khách hàng đánh 4 sao khóa học</td>
<?php foreach ($forstar as $key => $value) {
    ?> <td><?php echo $value['sovote'] ?> </td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td class="vote">Tổng số khách hàng đánh 3 sao khóa học</td>
                        <?php foreach ($threestar as $key => $value) {
                            ?> <td><?php echo $value['sovote'] ?> </td>
<?php } ?>
                    </tr>
                    <tr>
                        <td class="vote">Tổng số khách hàng đánh 2 sao khóa học</td>
                        <?php foreach ($twostar as $key => $value) {
                            ?> <td><?php echo $value['sovote'] ?> </td>
<?php } ?>
                    </tr>
                    <tr>
                        <td class="vote">Tổng số khách hàng đánh 1 sao khóa học</td>
                        <?php foreach ($onestar as $key => $value) {
                            ?> <td><?php echo $value['sovote'] ?> </td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>

        </div> 

    </body>
</html>

                        <?php
                        ?>
