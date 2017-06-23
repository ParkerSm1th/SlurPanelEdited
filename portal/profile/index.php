<?php
    include("../../includes/common.php");
    if(empty($userid)){
        header("Location: ../index.php?sessionExpired=1");
        die("Redirecting...");
    }

    $user=$_GET['username'];

    if(empty($user)){
        $user=$username;
    }

    date_default_timezone_set('Europe/London');
    $day=date("w");
    $day=$day+1;

$title=$user;
?>
<html>
    <?php $fetchID = $userid; ?>
    <?php include("../../assets/conn.php"); ?>
    <?php include("../../assets/roles.php"); ?>
    <?php include("../../assets/header.php"); ?>
    <?php include("../../assets/navbar.php"); ?>
    
    <?php
        $sql="SELECT `id`, `username`, `role`, `visiblerole` FROM `users` WHERE `username` = '$user'";
        $fetchAccount=mysqli_query($conn, $sql);
        $accountData=mysqli_fetch_assoc($fetchAccount);
    
        $acctId=$accountData['id'];
        $fetchID=$acctId;
        $acctUser=$accountData['username'];
        $acctRole=$accountRole['role'];
        $acctTrial=$accountRole['visiblerole'];
    
        $sql="SELECT * FROM `user-details` WHERE `id` = '$acctId'";
        $fetchDetails=mysqli_query($conn, $sql);
        $accountDetails=mysqli_fetch_assoc($fetchDetails);
    
        $bio=$accountDetails['bio'];
        $spotify=$accountDetails['spotify'];
        $snapchat=$accountDetails['snapchat'];
        $instagram=$accountDetails['instagram'];
        $twitter=$accountDetails['twitter'];
    
        include("../../assets/roles.php");
        include("../../assets/regions.php");
    
        $imgurl="/images/".$acctUser.".png";
    ?>
    
    <body>
        <div class="content">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-block">
                            <h3 class="card-title text-center"><?php echo $acctUser; ?></h3>
                            <div class="row">
                                <div class="col-6">
                                    <p class="text-center">
                                        <img src="<?php echo $imgurl; ?>" width="120px" height='auto' class='rounded-circle' onerror="this.src='/images/slur.png'">
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p>Last Login: <span class="badge badge-success">Coming Soon!</span></p>
                                    <p>Role: <?php echo $roleBadge; ?></p>
                                    <p>Trial: <?php echo $trialBadge; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8 offset-2">
                                    <div class="row">
                                        <div class="col-4">
                                            <p><b>About Me:</b></p>
                                        </div>
                                        <div class="col-8">
                                            <?php echo $bio; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <?php
                                                if(!empty($spotify)){
                                                    echo "<div class='row'>";
                                                        echo "<div class='col-6'>";
                                                            echo "<p class='pull-right'>Spotify</p>";
                                                        echo "</div>";
                                                        echo "<div class='col-6'>";
                                                            echo "<p>".$spotify."</p>";
                                                        echo "</div>";
                                                    echo "</div>";
                                                }
                                            ?>
                                            <?php
                                                if(!empty($snapchat)){
                                                    echo "<div class='row'>";
                                                        echo "<div class='col-6'>";
                                                            echo "<p class='pull-right'>Snapchat</p>";
                                                        echo "</div>";
                                                        echo "<div class='col-6'>";
                                                            echo "<p>".$snapchat."</p>";
                                                        echo "</div>";
                                                    echo "</div>";
                                                }
                                            ?>
                                            <?php
                                                if(!empty($instagram)){
                                                    echo "<div class='row'>";
                                                        echo "<div class='col-6'>";
                                                            echo "<p class='pull-right'>Instagram</p>";
                                                        echo "</div>";
                                                        echo "<div class='col-6'>";
                                                            echo "<p>".$instagram."</p>";
                                                        echo "</div>";
                                                    echo "</div>";
                                                }
                                            ?>
                                            <?php
                                                if(!empty($twitter)){
                                                    echo "<div class='row'>";
                                                        echo "<div class='col-6'>";
                                                            echo "<p class='pull-right'>Twitter</p>";
                                                        echo "</div>";
                                                        echo "<div class='col-6'>";
                                                            echo "<p>".$twitter."</p>";
                                                        echo "</div>";
                                                    echo "</div>";
                                                }
                                            ?>
                                        </div>
                                        <?php
                                            $sql="SELECT * FROM `timetable` WHERE `user` = '$acctId' AND `day` >= '$day'";
                                            $timetableQuery=mysqli_query($conn, $sql);
                                            $upcomingCount=mysqli_num_rows($timetableQuery);
                                        ?>
                                        <div class="col-6">
                                            <h4 class="text-center"><?php echo $upcomingCount; ?> Upcoming Sessions</h4>
                                            <ul class="list-group">
                                                <?php
                                                    while($data=mysqli_fetch_assoc($timetableQuery)){
                                                        $day=$data['day'];
                                                        include("../../assets/days.php");
                                                        
                                                        echo "<li class='list-group-item justify-content-between'>";
                                                        echo "".$dayText."";
                                                        echo "<span class='badge badge-default badge-pill'>".$data['start'].":00 BST</span>";
                                                        echo "</li>";
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>