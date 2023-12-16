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
        //đọc dữ liệu cần sửa
        if(isset($_GET["spid_NLDT"])){
            //lấy mã nhân viên cần sửa
            $SPID_NLDT= $_GET["spid_NLDT"];
            //tạo truy vấn đọc dữ liệu từ bảng nhân viên
            $sql_edit_NLDT= "SELECT * FROM `sanpham_NLDT` WHERE SPID_NLDT='$SPID_NLDT'";
            // thực thi câu lệnh truy vấn
            $result_edit_NLDT = $conn_NLDT->query($sql_edit_NLDT);
            //đọc bản ghi từ kết quả
            $row_edit_NLDT = $result_edit_NLDT->fetch_array();
        }else{
            header("Location: sanpham-list-NLDT.php");
        }
        //đọc dữ liệu phòng ban
        $sql_pb_NLDT = "SELECT * FROM DANHMUC_NLDT WHERE 1=1";
        $res_pb_NLDT = $conn_NLDT->query($sql_pb_NLDT);
        // => hiển thị trong điều khiển select
        // Thực hiện thêm dữ liệu
        $error_message_NLDT ="";
        if(isset($_POST["btnSubmit_NLDT"])){
            // lấy dữ liệu trên form
            $SPID_NLDT = $_POST["SPID_NLDT"];
            $TENSP_NLDT = $_POST["TENSP_NLDT"];
            $SOLUONG_NLDT = $_POST["SOLUONG_NLDT"];
            $GIABAN_NLDT = $_POST["GIABAN_NLDT"];
            $GIAMUA_NLDT = $_POST["GIAMUA_NLDT"];
            $TRANGTHAI_NLDT = $_POST["TRANGTHAI_NLDT"];
            $MADM = $_POST["MADM"];
            $sql_update_NLDT= "UPDATE `sanpham_NLDT` SET";
            $sql_update_NLDT.="TENSP_NLDT='$TENSP_NLDT',";
            $sql_update_NLDT.="SOLUONG_NLDT='$SOLUONG_NLDT',";
            $sql_update_NLDT.="GIABAN_NLDT='$GIABAN_NLDT',";
            $sql_update_NLDT.="GIAMUA_NLDT='$GIAMUA_NLDT',";
            $sql_update_NLDT.="TRANGTHAI_NLDT='$TRANGTHAI_NLDT',";
            $sql_update_NLDT.="MADM='$MADM'";
            $sql_update_NLDT.=" WHERE SPID_NLDT='$SPID_NLDT'";
            if($conn_NLDT->query($sql_update_NLDT)){
                   header("Location:sanpham-list-NLDT.php"); 
            }else{
                $error_message_NLDT="Lỗi sửa dữ liệu". mysqli_error($conn_NLDT);
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
                            <input type="text" name="SPID_NLDT" id="SPID_NLDT" readonly
                                value="<?php echo  $row_edit_NLDT["SPID_NLDT"]?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Tên</td>
                        <td>
                            <input type="text" name="TENSP_NLDT" id="TENSP_NLDT"
                                value="<?php echo  $row_edit_NLDT["TENSP_NLDT"]?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Số lượng</td>
                        <td>
                            <input type="text" name="SOLUONG_NLDT" id="SOLUONG_NLDT"
                                value="<?php echo  $row_edit_NLDT["SOLUONG_NLDT"]?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Đơn giá</td>
                        <td>
                        <input type="text" name="GIABAN_NLDT" id="GIABAN_NLDT"
                                value="<?php echo  $row_edit_NLDT["GIABAN_NLDT"]?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Đơn giá</td>
                        <td>
                        <input type="text" name="GIAMUA_NLDT" id="GIAMUA_NLDT"
                                value="<?php echo  $row_edit_NLDT["GIAMUA_NLDT"]?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Trạng thái</td>
                        <td>
                            <select name="TRANGTHAI_NLDT" >
                                <option value="1" <?php if($row_edit_NLDT["TRANGTHAI_NLDT"]==1){echo "selected";}?>>Hoạt động</option>
                                <option value="0" <?php if($row_edit_NLDT["TRANGTHAI_NLDT"]==0){echo "selected";}?>>Không hoạt động</option>
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
                                <option value="<?php echo $row["MADM_NLDT"]?>"
                                <?php
                                    if($row["MADM_NLDT"]==$row_edit_NLDT["MADM_NLDT"]){
                                        echo "selected";
                                    }
                                ?>
                                >
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
        <a href="sanpham-list-NLDT.php">Danh sách sản phẩm</a>
    </section>
</body>
</html>