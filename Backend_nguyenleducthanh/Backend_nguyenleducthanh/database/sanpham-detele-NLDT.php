<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
        include("ketnoi.php");
        $sql_NLDT = "SELECT * FROM sanpham_NLDT WHERE 1=1";
        $result_NLDT = $conn_NLDT->query($sql_NLDT);
        //Duyệt và hiển thị kết quả -> tbody
    ?>
    <section class="container">
        <h1>Danh sách sản phẩm</h1>
        <hr/>
        <a href="sanpham-create-NLDT.php" class="btn">Thêm mới sản phẩm</a>
        <table width="100%" border="1px">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã</th>
                    <th>Tên</th>
                    <th>Số lượng</th>
                    <th>Giá mua</th>
                    <th>Giá bán</th>
                    <th>Trạng thái</th>
                    <th>Mã loại</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($result_NLDT->num_rows>0){
                        $stt=0;
                        while($row_NLDT = $result_NLDT->fetch_array()):
                        $stt++;
                ?>
                <tr>
                    <td><?php echo $stt;?></td>
                    <td><?php echo $row_NLDT["SPID_NLDT"];?></td>
                    <td><?php echo $row_NLDT["TENSP_NLDT"];?></td>
                    <td><?php echo $row_NLDT["SOLUONG_NLDT"];?></td>
                    <td><?php echo $row_NLDT["GIAMUA_NLDT"];?></td>
                    <td><?php echo $row_NLDT["GIABAN_NLDT"];?></td>
                    <td><?php echo $row_NLDT["TRANGTHAI_NLDT"];?></td>
                    <td><?php echo $row_NLDT["MADM"];?></td>
                    <td>
                        <a href="sanpham-edit-NLDT.php?spid_NLDT=<?php echo $row_NLDT["SPID_NLDT"];?>">Sửa</a>|
                        <a href="sanpham-list-NLDT.php?spid_NLDT=<?php echo $row_NLDT["SPID_NLDT"];?>">Xóa</a>
                    </td>
                </tr>
                <?php
                    endwhile;
                }
                ?>
            </tbody>
        </table>
        <a href="sanpham-create-NLDT.php" class="btn">Thêm mới sản phẩm</a>
    </section>
    <?php
        if(isset($_GET["spid_NLDT"])){
            $proid_NLDT = $_GET["spid_NLDT"];
            $sql_delete_NLDT = "DELETE FROM SANPHAM_NLDT where SPID_NLDT='$spid_NLDT'";
            if($conn_NLDT->query($sql_delete_NLDT)){
                header("Location:sanpham-list-NLDT.php");
            }else{
                echo "<script> alert('lỗi xóa'; </script>";
            }
        }
    ?>
</body>
</html>