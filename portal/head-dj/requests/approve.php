<?php
    $id=$_GET['id'];
    include("../../../assets/conn.php");

    $sql="SELECT * FROM `timetable-requests` WHERE `id` = '$id'";
    $requestData=mysqli_fetch_assoc(mysqli_query($conn, $sql));

    $slotid=$requestData['requestslot'];
    $userid=$requestData['userid'];

    $sql="UPDATE `slurradi_main`.`timetable` SET `type` = '1', `user` = '$userid' WHERE `timetable`.`id` = '$slotid'";
    mysqli_query($conn, $sql);

    $sql="DELETE FROM `timetable-requests` WHERE `id` = '$id'";
    mysqli_query($conn, $sql);

    header("Location: index.php"); 
    die("Redirected");
