<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới thông tin sản phẩm</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
        include("ketnoi.php");
        $sql_pb_NLDT = "SELECT * FROM danhmuc_NLDT WHERE 1=1";
        $res_pb_NLDT = $conn_NLDT->query($sql_pb_NLDT);
        // => hiển thị trong điều khiển select
        // Thực hiện thêm dữ liệu
        $error_message_NLDT ="";
        if(isset($_POST["btnSubmit_NLDT"])){
            // lấy dữ liệu trên form
            $SPID_NLDT = $_POST["SPID_NLDT"];
            $TENSP_NLDT = $_POST["TENSP_NLDT"];
            $SOLUONG_NLDT = $_POST["SOLUONG_NLDT"];
            $GIAMUA_NLDT = $_POST["GIAMUA_NLDT"];
            $GIABAN_NLDT = $_POST["GIABAN_NLDT"];
            $TRANGTHAI_NLDT = $_POST["TRANGTHAI_NLDT"];
            $MADM_NLDT = $_POST["MADM_NLDT"];
            //kiểm trả khóa chính không được trùng
            $sql_check_NLDT = "SELECT SPID_NLDT FROM SANPHAM_NLDT WHERE SPID_NLDT = 'SPID_NLDT' ";
            $res_check_NLDT = $conn_NLDT->query($sql_check_NLDT);
            if($res_check_NLDT->num_rows>0){
                $error_message_NLDT="Lỗi trùng khóa chính.";
            }
            $sql_insert_NLDT = "INSERT INTO `sanpham_NLDT` (`SPID_NLDT`, `TENSP_NLDT`, `SOLUONG_NLDT`,`GIAMUA_NLDT`, `GIABAN_NLDT`, `TRANGTHAI_NLDT`, `MADM_NLDT`)";
            $sql_insert_NLDT.="VALUES ('$SPID_NLDT','$TENSP_NLDT','$SOLUONG_NLDT','$GIAMUA_NLDT','$GIABAN_NLDT','$TRANGTHAI_NLDT','$MADM_NLDT');";
            if($conn_NLDT->query($sql_insert_NLDT)){
                   header("Location: sanpham-list-NLDT.php"); 
            }else{
                $error_message_NLDT="Lỗi thêm mới". mysqli_error($conn_NLDT);
            }
        }
        ?>
    <section class="container">
        <h1>Thêm mới thông tin sản phẩm</h1>
        <form name="frm_NLDT" method="post" action="">
            <table border="1" width="100%" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Mã</td>
                        <td>
                            <input type="text" name="SPID_NLDT" id="SPID_NLDT">
                        </td>
                    </tr>
                    <tr>
                        <td>Tên</td>
                        <td>
                            <input type="text" name="TENSP_NLDT" id="TENSP_NLDT">
                        </td>
                    </tr>
                    <tr>
                        <td>Số lượng</td>
                        <td>
                            <input type="text" name="SOLUONG_NLDT" id="SOLUONG_NLDT">
                        </td>
                    </tr>
                    <tr>
                        <td>Giá bán</td>
                        <td>
                            <input type="text" name="GIABAN_NLDT" id="GIABAN_NLDT">
                        </td>
                    </tr>
                    <tr>
                        <td>Giá mua</td>
                        <td>
                            <input type="text" name="GIAMUA_NLDT" id="GIAMUA_NLDT">
                        </td>
                    </tr>
                    <tr>
                        <td>Trạng thái</td>
                        <td>
                            <select name="TRANGTHAI_NLDT" >
                                <option value="1" selected>Hoạt động</option>
                                <option value="0" selected>Không hoạt động</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Mã loại</td>
                        <td>
                            <select name="MADM_NLDT" id="MADM_NLDT">
                                <?php
                                    while($row = $res_pb_NLDT->fetch_array()):        
                                ?>
                                <option value="<?php echo $row["MADM_NLDT"]?>">
                                    <?php echo $row["TENDM_NLDT"]?>
                                </option>
                                <?php
                                    endwhile;
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Thêm" name="btnSubmit_NLDT">
                            <input type="reset" value="Làm lại" name="btnReset_NLDT">
                        </td>
                    </tr>
                </tbody>
            </table>    
            <div>
                <?php echo $error_message_NLDT;?>
            </div>
        </form>
        <a href="sanpham-list-NLDT.php">Danh sách nhân viên</a>
    </section>
</body>
</html>