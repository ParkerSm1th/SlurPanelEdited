<?php
    $id=$_GET['id'];
    include("../../../assets/conn.php");
    $sql="UPDATE `slurradi_main`.`timetable` SET `type` = NULL, `user` = NULL WHERE `timetable`.`id` = $id";
    mysqli_query($conn, $sql);

    header("Location: index.php");
?>