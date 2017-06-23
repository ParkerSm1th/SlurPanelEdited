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

    $userLimit="5";
    date_default_timezone_set('Europe/London');

    $day=date("w");
    $day=$day+1;
    
    $hour=date("H");
    $mins=date("i");

    if(empty($timeTable['user'])){
        $startHour=$timeTable['start'];
        $dayTable=$timeTable['day'];
        
    }

    if($timeRegion==$region){
        $ok="1";
    } else {
        if($timeRegion=="0"){
            $ok="1";
        } else {
            if($hour == $startHour && $day == $dayTable && $mins > 5){
                $ok="1";
            } else {
                $ok="0";
                $sql="INSERT INTO `timetable-requests`(`userid`, `requestslot`, `reason`) VALUES ('$userid', '$id', 'Region')";
                mysqli_query($conn, $sql);
                header("Location: index.php?invalidRegion=1&page=$day");
                die("redirecting");
            }
        }
    }

    if($bookingsCount < $userLimit){
        $ok="1";
    } else {
        $ok="0";
        $sql="INSERT INTO `timetable-requests`(`userid`, `requestslot`, `reason`) VALUES ('$userid', '$id', 'Limit')";
        mysqli_query($conn, $sql);
        header("Location: index.php?maxBookings=1&page=$day");
        die("redirecting");
    }

    if($ok=="1"){
        $sql="UPDATE `slurradi_main`.`timetable` SET `user` = '$userid', `type` = '1' WHERE `timetable`.`id` = '$id'";
        mysqli_query($conn, $sql);   
        
        header("Location: index.php?day=$day&bookingComplete=1");
    }