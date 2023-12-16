<?php
     $conn_NLDT = new mysqli("localhost","root","","database/csdl-nguyenleducthanh.sql");
     if(!$conn_NLDT){
        echo "<h2> Lỗi: ". mysqli_error($conn_NLDT). "</h2>";
     }else{
        echo "<h2>Xin chào ,nguyễn lê đức thành-2210900065 </h2>";
     }
     ?>