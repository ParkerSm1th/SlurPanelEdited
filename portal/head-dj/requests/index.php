<?php
    include("../../../includes/common.php");
    if(empty($userid)){
        header("Location: ../../../index.php?sessionExpired=1");
        die("Redirecting...");
    }

    if($role < "2"){
        header("Location: ../../../panel/");
        die("redirecting");
    }
?>
<html>
    <?php $fetchID = $userid; ?>
    <?php include("../../../assets/conn.php"); ?>
    <?php include("../../../assets/roles.php"); ?>
    <?php include("../../../assets/header.php"); ?>
    <?php include("../../../assets/navbar.php"); ?>
    
    <head>
    <script src="https://use.fontawesome.com/2f6d77eae3.js"></script>
    </head>
    <div class="content">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-block">
                    <h3 class="text-md-center text-sm-center">Booking Requests</h3>
                    <div class="row">
                        <div class="col-10 offset-1">
                            <div class="alert alert-danger">
                                <b>Beware:</b> If you click the approve button, the request will be honored - but if someone has since booked the slot it will replace them!
                                <hr>
                                <b>Please remember:</b> The system will NOT notify the user if you honor or deny their request, it is YOUR responsibility to let them know personally on Discord.
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <tr>
                            <th>Slot ID #</th>
                            <th>Username</th>
                            <th>Error Reason</th>
                            <th>Slot Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Approve</th>
                            <th>Deny</th>
                        </tr>
                        <?php
                            $sql="SELECT * FROM `timetable-requests`";
                            $fetchRequests=mysqli_query($conn, $sql);

                            while($requestData=mysqli_fetch_assoc($fetchRequests)){

                                $reqid=$requestData['requestslot'];
                                $userid=$requestData['userid'];

                                $sql="SELECT * FROM `timetable` WHERE `id` = '$reqid'";
                                $slotData=mysqli_fetch_assoc(mysqli_query($conn, $sql));
                                
                                $sql="SELECT `username` FROM `users` WHERE `id` = '$userid'";
                                $userData=mysqli_fetch_assoc(mysqli_query($conn, $sql));

                                $username=$userData['username'];
                                
                                $day=$slotData['day'];
                                include("../../../assets/days.php");
                                
                                if($requestData['reason']=="Region"){
                                    $reason="User booked outside region.";
                                }
                                
                                if($requestData['reason']=="Limit"){
                                    $reason="User reached booking limit.";
                                }

                                echo "<tr>";
                                    echo "<td>".$requestData['requestslot']."</td>";
                                    echo "<td>".$username."</td>";
                                    echo "<td>".$reason."</td>";
                                    echo "<td>".$dayText."</td>";
                                    echo "<td>".$slotData['start'].":00</td>";
                                    echo "<td>".$slotData['end'].":00</td>";
                                    echo "<td><a class='btn btn-success btn-sm' href='approve.php?id=".$requestData['id']."'><i class='fa fa-check' aria-hidden='true'></i></a>";
                                    echo "<td><a class='btn btn-danger btn-sm' href='deny.php?id=".$requestData['id']."'><i class='fa fa-trash' aria-hidden='true'></i></a>";
                                echo "</tr>";



                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</html>