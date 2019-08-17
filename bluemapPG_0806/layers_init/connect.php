<?php
    $conn = pg_connect("host=localhost port=5432 dbname=bluemap user=postgres password=root");
    if (!$conn) {
        die('数据库连接失败');
    }
 ?>
