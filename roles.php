<?php
    $sql="SELECT `id`, `role`, `visiblerole` FROM `users` WHERE `id` = '$fetchID'";
    $data=mysqli_query($conn, $sql);
    $roleData=mysqli_fetch_assoc($data);

    if($roleData['role']=="1"){
        $roleName="Radio DJ";
        $roleColor="#54A4FF";
    }
    
    if($roleData['role']=="2"){
        $roleName="Head DJ";
        $roleColor="#DD89F5";
    }

    if($roleData['role']=="3"){
        $roleName="Manager";
        $roleColor="#2DC254";
    }

    if($roleData['role']=="4"){
        $roleName="Admin";
        $roleColor="#FA5050";
    }

    if($roleData['role']=="5"){
        $roleName="Owner";
        $roleColor="#AF2BE3";
    }

    if($roleData['visiblerole']=="1"){
        $trialRole="Trial Radio DJ";
    }

    if($roleData['visiblerole']=="2"){
        $trialRole="Trial Head DJ";
    }

    if($roleData['visiblerole']=="3"){
        $trialRole="Trial Manager";
    }

    if($roleData['visiblerole']=="4"){
        $trialRole="Trial Admin";
    }

    if(empty($roleData['visiblerole'])){
        $trialRole="";
    }


    $roleBadge="<span class='badge badge-default' style='background-color: ".$roleColor.";'>".$roleName."</span>";
    $trialBadge="<span class='badge badge-default' style='background-color: ".$roleColor.";'>".$trialRole."</span>";

    if(empty($trialRole)){
        $trialBadge="<span class='badge badge-default' style='background-color: ".$roleColor.";'>No Trial Role</span>";
    }
?>