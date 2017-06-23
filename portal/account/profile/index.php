<?php
    include("../../../includes/common.php");
    if(empty($userid)){
        header("Location: ../../../index.php?sessionExpired=1");
        die("Redirecting...");
    } 

    $title="My Profile";

    $imageUpload=$_GET['pictureUpdated'];
    $profileUpdate=$_GET['profileUpdated'];

    if($imageUpload == "1"){
        $banner="<div class='alert alert-success' role='alert'><b>Success!</b> New profile picture has uploaded! Please allow a few hours for it to update everywhere!</div>";
    }

    if($imageUpload == "0"){
        $banner="<div class='alert alert-warning' role='alert'><b>Bummer.</b> Your photo couldn't upload. Please make sure it is a PNG file, and under 2 megabytes.</div>";
    }

    if($profileUpdate == "0"){
        $banner="<div class='alert alert-success' role='alert'><b>Success!</b> You've updated your <b>SlurRadio</b> profile!</div>";
    }
?>
<html>
    <?php $fetchID = $userid; ?>
    <?php include("../../../assets/conn.php"); ?>
    <?php include("../../../assets/roles.php"); ?>
    <?php include("../../../assets/header.php"); ?>
    <?php include("../../../assets/navbar.php"); ?>
    
    <?php
        $sql="SELECT * FROM `user-details` WHERE `id` = '$userid'";
        $query=mysqli_query($conn, $sql);
        $data=mysqli_fetch_assoc($query);
        
        $instagram=$data['instagram'];
        $snapchat=$data['snapchat'];
        $twitter=$data['twitter'];
        $spotify=$data['spotify'];
        $bio=$data['bio'];
    ?>
    <div class="content">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <h3>My Profile <small><?php echo $username ?></small></h3>
                        <?php echo $banner ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="text-md-center text-sm-center">
                                    <img src="/images/<?php echo $username; ?>.png" onerror="/images/slur.png" width="50%" height='auto' class='rounded-circle'>
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <form action="upload.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                        <input type="hidden" name="username" value="<?php echo $username ?>">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Upload Image</button>
                                    </div>
                                    <p><small>Your image must be square, and no larger than <b>2 MB</b>.</small></p>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-8 offset-md-2">
                                <form action="update-profile.php" method="post">
                                    <div class="form-group row">
                                        <label for="username" class="col-4 col-form-label">Username</label>
                                        <div class="col-8">
                                            <input class="form-control" type="text" value="<?php echo $username ?>" disabled />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-10 offset-1">
                                            <div class="input-group">
                                                <textarea class="form-control" rows="4" name="description" placeholder="Your bio!" value="<?php echo $bio ?>"><?php echo $bio ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Instagram</label>
                                        <div class="col-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">@</div>
                                                <input class="form-control" type="text" name="instagram" value="<?php echo $instagram ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Twitter</label>
                                        <div class="col-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">@</div>
                                                <input class="form-control" type="text" name="twitter" value="<?php echo $twitter ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Snapchat</label>
                                        <div class="col-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">@</div>
                                                <input class="form-control" type="text" name="snapchat" value="<?php echo $snapchat ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Spotify</label>
                                        <div class="col-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">@</div>
                                                <input class="form-control" type="text" name="spotify" value="<?php echo $spotify ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <button class="btn btn-outline-primary btn-block" type="submit">Save Profile Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>