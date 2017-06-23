<?php
    include("../../../includes/common.php");
    if(empty($userid)){
        header("Location: ../../../index.php?sessionExpired=1");
        die("Redirecting...");
    } 

    if($role <= "2"){
        header("Location: ../../../portal");
    }

    if(!empty($_GET['username'])){
        $banner = "<div class='alert alert-info'>Your pin is **".$_GET['pin']."**. Go to http://staff.slur-radio.net/ - enter the pin in on the RIGHT side, and set a password. Click 'Create Account'. You will then be able to login using your username **".$_GET['username']."** and the password you set.</div>";
    }

    $title="Manage Accounts"
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
                        <?php echo $banner ?>
                    </div>
                    <div class="col-md-10 offset-md-1">
                    <table class="table">
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Trial Role</th>
                            <th>Manage User</th>
                        </tr>
                        <?php
                        
                            $sql="SELECT `username`, `id`, `role`, `visiblerole` FROM `users`";
                            $fetchUsers=mysqli_query($conn, $sql);
                        
                            while($userData=mysqli_fetch_assoc($fetchUsers)){
                                $fetchID=$userData['id'];
                                include("../../../assets/roles.php");
                                
                                echo "<tr>";
                                    echo "<td>".$userData['id']."</td>";
                                    echo "<td>".$userData['username']."</td>";
                                    echo "<td>".$roleBadge."</td>";
                                    echo "<td>".$trialBadge."</td>";
                                    echo "<td><a class='disabled' href='#'>Manage User</td>";
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