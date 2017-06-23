<?php
    include("../../../includes/common.php");
    if(empty($userid)){
        header("Location: ../../../index.php?sessionExpired=1");
        die("Redirecting...");
    } 

    $day=$_GET['day'];
    
    if(empty($day)){
        date_default_timezone_set('Europe/London');
        $day=date("w");
        $day=$day+1;
    }

    include("../../../assets/days.php");

    $title=$dayText;

    $bookingComplete=$_GET['bookingComplete'];
    $invalidRegion=$_GET['invalidRegion'];
    $maxBookings=$_GET['maxBookings'];

    if(!empty($maxBookings)){
        $banner="<div class='alert alert-danger' style='width: 100%;'><b>Booking not complete.</b> It seems you have reached your maximum amount of bookings this week. But don't worry! We've sent a request to management for you - if they approve your booking you'll be added to the timetable and notified on Discord!</div>";
    }
    if(!empty($invalidRegion)){
        $banner="<div class='alert alert-danger' style='width: 100%;'><b>Booking not complete.</b> It seems the region you are attempting to book in is not your region. But don't worry! We've sent a request to management for you - if they approve your booking you'll be added to the timetable and notified on Discord!</div>";
    }
    if(!empty($bookingComplete)){
        $banner="<div class='alert alert-success' style='width: 100%;'><b>Booking Complete!</b> You have booked your slot!</div>";
    }
?>
<html>
    <style>
        a { color: #FA5050; }
    </style>
    <?php $fetchID = $userid; ?>
    <?php include("../../../assets/conn.php"); ?>
    <?php include("../../../assets/roles.php"); ?>
    <?php include("../../../assets/header.php"); ?>
    <?php include("../../../assets/navbar.php"); ?>
    
    
    <div class="content">
        <div class="col-md-10 offset-md-1">
            <h3 class="text-md-center text-sm-center" style="color: #ffffff;"><?php echo $dayText ?></h3>
            <p class="text-md-center text-sm-center"><span class="badge badge-danger"><?php
        date_default_timezone_set('Europe/London'); echo date("m-d-Y | H:i e"); ?></span></p>
            <div class="container">
                <div class="row">
                    <p class='text-md-center text-sm-center'><?php echo $banner; ?></p>
                </div>
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-left" href="index.php?day=1" style="color: #ff5361;">Sunday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-left" href="index.php?day=2" style="color: #ff5361;">Monday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-left" href="index.php?day=3" style="color: #ff5361;">Tuesday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-left" href="index.php?day=4" style="color: #ff5361;">Wednesday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-left" href="index.php?day=5" style="color: #ff5361;">Thursday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-left" href="index.php?day=6" style="color: #ff5361;">Friday</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-left" href="index.php?day=7" style="color: #ff5361;">Saturday</a>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                    <?php
                        $sql="SELECT * FROM `timetable` WHERE `day` = '$day' LIMIT 6";
                        $timetableFetch=mysqli_query($conn, $sql);
                        
                        while($timetable=mysqli_fetch_assoc($timetableFetch)){
                            $region=$timetable['region'];
                            include("../../../assets/regions.php");
                            
                            $timetableuser=$timetable['user'];
                            
                            $sql="SELECT `username`, `role` FROM `users` WHERE `id` = '$timetableuser'";
                            $userFetch=mysqli_query($conn, $sql);
                            $userData=mysqli_fetch_assoc($userFetch);
                            
                            $fetchID=$timetableuser;
                            include("../../../assets/roles.php");
                            
                            $timetableid=$timetable['id'];
                            if(empty($timetableuser)){
                                $booking="Unbooked";
                                $role="<a href='book.php?id=".$timetableid."' style='color: #ff5361;'>Click to Book</a>";
                            } else {
                                $booking="<a style='color: #ffffff' href='/portal/profile?username=".$userData['username']."'>".$userData['username']."</a>";
                                $role=$roleBadge;
                            }
                            
                            echo "<div class='row' style='padding-bottom: 5px; padding-left: 3px; padding-right: 3px;'>";
                                echo "<div class='card' style='width: 100%; height: 60px; background-color: #363636; '>";
                                        echo "<div class='row' style='padding-top: 3px; padding-left: 6px; padding-right: 6px;'>";
                                            echo "<div class='col-md-6 col-sm-6'>";
                                                echo "<p style='color: #ffffff'>".$timetable['start'].":00 - ".$timetable['end'].":00<br>".$region."</p>";
                                            echo "</div>";
                                            echo "<div class='col-md-6 col-sm-6'>";
                                                echo "<p style='color: #ffffff' class='text-md-right text-sm-right'>".$booking."<br>".$role."</p>";
                                            echo "</div>";
                                        echo "</div>";
                                echo "</div>";
                            echo "</div>";
                            
                            $timetableid=$timetable['id'];
                            $nextID=$timetableid+1;
                        }
                    ?>
                    </div>
                    <div class="col-md-3 col-sm-12">
                    <?php
                        $sql="SELECT * FROM `timetable` WHERE `id`>='$nextID' LIMIT 6";
                        $timetableFetch=mysqli_query($conn, $sql);
                        
                        while($timetable=mysqli_fetch_assoc($timetableFetch)){
                            $region=$timetable['region'];
                            include("../../../assets/regions.php");
                            
                            $timetableuser=$timetable['user'];
                            
                            $fetchID=$timetableuser;
                            include("../../../assets/roles.php");
                            
                            $sql="SELECT `username`, `role` FROM `users` WHERE `id` = '$timetableuser'";
                            $userFetch=mysqli_query($conn, $sql);
                            $userData=mysqli_fetch_assoc($userFetch);
                            
                            
                            $timetableid=$timetable['id'];
                            if(empty($timetableuser)){
                                $booking="Unbooked";
                                $role="<a href='book.php?id=".$timetableid."' style='color: #ff5361;'>Click to Book</a>";
                            } else {
                                $booking="<a style='color: #ffffff' href='/portal/profile?username=".$userData['username']."'>".$userData['username']."</a>";
                                $role=$roleBadge;
                            }
                            
                            echo "<div class='row' style='padding-bottom: 5px; padding-left: 3px; padding-right: 3px;'>";
                                echo "<div class='card' style='width: 100%; height: 60px; background-color: #363636; '>";
                                        echo "<div class='row' style='padding-top: 3px; padding-left: 6px; padding-right: 6px;'>";
                                            echo "<div class='col-md-6 col-sm-6'>";
                                                echo "<p style='color: #ffffff'>".$timetable['start'].":00 - ".$timetable['end'].":00<br>".$region."</p>";
                                            echo "</div>";
                                            echo "<div class='col-md-6 col-sm-6'>";
                                                echo "<p style='color: #ffffff' class='text-md-right text-sm-right'>".$booking."<br>".$role."</p>";
                                            echo "</div>";
                                        echo "</div>";
                                echo "</div>";
                            echo "</div>";
                            
                            $timetableid=$timetable['id'];
                            $nextID=$timetableid+1;
                        }
                    ?>
                    </div>
                    <div class="col-md-3 col-sm-12">
                    <?php
                        $sql="SELECT * FROM `timetable` WHERE `id`>='$nextID' LIMIT 6";
                        $timetableFetch=mysqli_query($conn, $sql);
                        
                        while($timetable=mysqli_fetch_assoc($timetableFetch)){
                            $region=$timetable['region'];
                            include("../../../assets/regions.php");
                            
                            $timetableuser=$timetable['user'];
                            
                            $fetchID=$timetableuser;
                            include("../../../assets/roles.php");
                            
                            $sql="SELECT `username`, `role` FROM `users` WHERE `id` = '$timetableuser'";
                            $userFetch=mysqli_query($conn, $sql);
                            $userData=mysqli_fetch_assoc($userFetch);
                            
                            
                            
                            $timetableid=$timetable['id'];
                            if(empty($timetableuser)){
                                $booking="Unbooked";
                                $role="<a href='book.php?id=".$timetableid."' style='color: #ff5361;'>Click to Book</a>";
                            } else {
                                $booking="<a style='color: #ffffff' href='/portal/profile?username=".$userData['username']."'>".$userData['username']."</a>";
                                $role=$roleBadge;
                            }
                            
                            echo "<div class='row' style='padding-bottom: 5px; padding-left: 3px; padding-right: 3px;'>";
                                echo "<div class='card' style='width: 100%; height: 60px; background-color: #363636; '>";
                                        echo "<div class='row' style='padding-top: 3px; padding-left: 6px; padding-right: 6px;'>";
                                            echo "<div class='col-md-6 col-sm-6'>";
                                                echo "<p style='color: #ffffff'>".$timetable['start'].":00 - ".$timetable['end'].":00<br>".$region."</p>";
                                            echo "</div>";
                                            echo "<div class='col-md-6 col-sm-6'>";
                                                echo "<p style='color: #ffffff' class='text-md-right text-sm-right'>".$booking."<br>".$role."</p>";
                                            echo "</div>";
                                        echo "</div>";
                                echo "</div>";
                            echo "</div>";
                            
                            $timetableid=$timetable['id'];
                            $nextID=$timetableid+1;
                        }
                    ?>
                    </div>
                    <div class="col-md-3 col-sm-12">
                    <?php
                        $sql="SELECT * FROM `timetable` WHERE `id`>='$nextID' LIMIT 6";
                        $timetableFetch=mysqli_query($conn, $sql);
                        
                        while($timetable=mysqli_fetch_assoc($timetableFetch)){
                            $region=$timetable['region'];
                            include("../../../assets/regions.php");
                            
                            $timetableuser=$timetable['user'];
                            
                            $fetchID=$timetableuser;
                            include("../../../assets/roles.php");
                            
                            $sql="SELECT `username`, `role` FROM `users` WHERE `id` = '$timetableuser'";
                            $userFetch=mysqli_query($conn, $sql);
                            $userData=mysqli_fetch_assoc($userFetch);
                            
                            
                            
                            $timetableid=$timetable['id'];
                            if(empty($timetableuser)){
                                $booking="Unbooked";
                                $role="<a href='book.php?id=".$timetableid."' style='color: #ff5361;'>Click to Book</a>";
                            } else {
                                $booking="<a style='color: #ffffff' href='/portal/profile?username=".$userData['username']."'>".$userData['username']."</a>";
                                $role=$roleBadge;
                            }
                            
                            echo "<div class='row' style='padding-bottom: 5px; padding-left: 3px; padding-right: 3px;'>";
                                echo "<div class='card' style='width: 100%; height: 60px; background-color: #363636; '>";
                                        echo "<div class='row' style='padding-top: 3px; padding-left: 6px; padding-right: 6px;'>";
                                            echo "<div class='col-md-6 col-sm-6'>";
                                                echo "<p style='color: #ffffff'>".$timetable['start'].":00 - ".$timetable['end'].":00<br>".$region."</p>";
                                            echo "</div>";
                                            echo "<div class='col-md-6 col-sm-6'>";
                                                echo "<p style='color: #ffffff' class='text-md-right text-sm-right'>".$booking."<br>".$role."</p>";
                                            echo "</div>";
                                        echo "</div>";
                                echo "</div>";
                            echo "</div>";
                            
                            $timetableid=$timetable['id'];
                            $nextID=$timetableid+1;
                        }
                    ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="alert alert-info" style="width: 100%">
                        <b>Notice:</b> Limits are now in place! Everyone can only book <u>5</u> sessions per timetable rotation, and only slots within their region, or that are not associated with a region. If you try to book a slot when you've reached your limit, or you are outside of the allowed region - a notification will be sent to Head DJ+ and they will have the option to either allow you to take the slot, or deny.
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>