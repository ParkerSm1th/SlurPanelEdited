<?php
    include("../../../assets/conn.php");

    $username=$_POST['username'];
    $role=$_POST['role'];
    $trial=$_POST['trial'];
    $region=$_POST['region'];
    $pin=rand(1000000,9999999);
    
    $username=mysqli_real_escape_string($conn, $username);

    $sql="INSERT INTO `registration` (`pin`, `username`, `region`, `role`, `visiblerole`) VALUES ('$pin', '$username', '$region', '$role', '$trial')";
    mysqli_query($conn, $sql);

    header("Location: /portal/manager/users?username=$username&pin=$pin");