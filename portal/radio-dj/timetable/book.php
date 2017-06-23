<?php

    include("../../../includes/common.php");
    include("../../../assets/conn.php");
    
    $id=$_GET['id'];

    $sql="SELECT `username`, `role`, `region` FROM `users` WHERE `id` = '$userid'";
    $fetchUser=mysqli_query($conn, $sql);
    $userInfo=mysqli_fetch_assoc($fetchUser);

    $username=$userInfo['username'];
    $role=$userInfo['role'];
    $region=$userInfo['region'];

    $sql="SELECT * FROM `timetable` WHERE `id` = '$id'";
    $fetchTime=mysqli_query($conn, $sql);
    $timeTable=mysqli_fetch_assoc($fetchTime);
    
    $timeRegion=$timeTable['region'];
    $day=$timeTable['day'];
    
    $sql="SELECT * FROM `timetable` WHERE `user` = '$userid'";
    $fetchBookings=mysqli_query($conn, $sql);
    $bookingsCount=mysqli_num_rows($fetchBookings);


        $sql="UPDATE `slurradi_main`.`timetable` SET `user` = '$userid', `type` = '1' WHERE `timetable`.`id` = '$id'";
        mysqli_query($conn, $sql);   
        
        
        header("Location: index.php?day=$day&bookingComplete=1");