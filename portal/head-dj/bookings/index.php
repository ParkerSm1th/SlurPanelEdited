<?php
    include("../../../includes/common.php");
    if(empty($userid)){
        header("Location: ../../../index.php?sessionExpired=1");
        die("Redirecting...");
    } 

    if($role <= "1"){
        header("Location: ../../../portal");
    }

    $title="Manage Bookings"
?>
<html>
    <?php $fetchID = $userid; ?>
    <?php include("../../../assets/conn.php"); ?>
    <?php include("../../../assets/roles.php"); ?>
    <?php include("../../../assets/header.php"); ?>
    <?php include("../../../assets/navbar.php"); ?>
    
    
    <div class="content">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-block">
                    <div class="col-md-10 offset-md-1">
                    <table class="table">
                        <tr>
                            <th>Slot ID</th>
                            <th>Username</th>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Delete Booking</th>
                        </tr>
                        <?php
                        
                            $sql="SELECT * FROM `timetable` WHERE `user` IS NOT NULL";
                            $fetchBookings=mysqli_query($conn, $sql);
                        
                            while($bookingData=mysqli_fetch_assoc($fetchBookings)){
                                $fetchID=$bookingData['user'];
                                include("../../../assets/roles.php");
                                
                                $sql="SELECT `username`, `role` FROM `users` WHERE `id` = '$fetchID'";
                                $query=mysqli_query($conn, $sql);
                                $userData=mysqli_fetch_assoc($query);
                                
                                $day=$bookingData['day'];
                                include("../../../assets/days.php");
                                
                                echo "<tr>";
                                    echo "<td>".$bookingData['id']."</td>";
                                    echo "<td>".$userData['username']." ".$roleBadge."</td>";
                                    echo "<td>".$dayText."</td>";
                                    echo "<td>".$bookingData['start'].":00</td>";
                                    echo "<td>".$bookingData['end'].":00</td>";
                                    echo "<td><a href='delete.php?id=".$bookingData['id']."'>Delete Slot</td>";
                                echo "</tr>";
                            }
                        
                        ?>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>