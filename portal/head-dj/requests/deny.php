<?php
    $id=$_GET['id'];
    include("../../../assets/conn.php");

    $sql="DELETE FROM `timetable-requests` WHERE `id` = '$id'";
    mysqli_query($conn, $sql);

    header("Location: index.php"); 
    die("Redirected");
