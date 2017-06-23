<?php

    include("../../../assets/conn.php");
    include("../../../includes/common.php");

    // First, we check to see if the user already has an existing row in the User Details table.

    $sql="SELECT * FROM `slurradi_main`.`user-details` WHERE `id` = '$userid'";
    $fetch=mysqli_query($conn, $sql);
    $data=mysqli_fetch_assoc($fetch);
    
    if(empty($data['id'])){
        // So, if the user does not have a row in the table - we'll now create one for them.
        $sql="INSERT INTO `user-details`(`id`) VALUES ('$userid')";
        mysqli_query($conn, $sql);
    } else {
        // We won't do anything because if it did not return true on line 11, they already have a row here.
    }

    // now that we've confirmed they have a row, we'll update it.

    $bio=$_POST['description'];
    $twitter=$_POST['twitter'];
    $instagram=$_POST['instagram'];
    $spotify=$_POST['spotify'];
    $snapchat=$_POST['snapchat'];

    $sql="UPDATE `slurradi_main`.`user-details` SET `bio` = '$bio', `twitter` = '$twitter', `instagram` = '$instagram', `spotify` = '$spotify', `snapchat` = '$snapchat' WHERE `user-details`.`id` = '$userid'";
    mysqli_query($conn, $sql);

    // now we will return the user to the profile page.
    header("Location: index.php?profileUpdated=1");