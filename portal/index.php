<?php
    include("../includes/common.php");
    if(empty($userid)){
        header("Location: ../index.php?sessionExpired=1");
        die("Redirecting...");
    }

    $title="Home";
?>
<html>
    <?php $fetchID = $userid; ?>
    <?php include("../assets/conn.php"); ?>
    <?php include("../assets/roles.php"); ?>
    <?php include("../assets/header.php"); ?>
    <?php include("../assets/navbar.php"); ?>
    
    <body>
        <div class="content">
            <div class="row">
                <div class="col-md-10 offset-md-1 col-sm-12">
                    <div class="card">
                        <div class="card-block">
                            <h4 class="card-title">Change Log/Features</h4>
                            <h6 class="card-subtitle mb-2 text-muted">Will be updated as features are updated/added.<br>If you have any feature suggestions - I'd love to hear them, send me a message on Discord (@Samuel#8750)</h6>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <p>
                                        <b>Radio DJs:</b>
                                        <br>
                                        - <strike>Ability to view the Timetable</strike>
                                            <br>
                                        - <strike>Ability to book slots.</strike>
                                            <br>
                                        - <strike>Book only 5 slots a week.</strike>
                                            <br>
                                        - <strike>Book only slots in your region.</strike>
                                            <br>
                                        - <strike>Request to book slots outside of your region.</strike>
                                            <br>
                                        - <strike>Request to book more than 5 slots a week.</strike>
                                            <br>
                                        - View my warnings.

                                            <hr>

                                        <b>Head DJs:</b>
                                        <br>
                                        - <strike>Remove booked slots.</strike>
                                            <br>
                                        - Issue warnings.
                                            <br>
                                        - View warning logs.
                                            <br>
                                        - View song logs.
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p>                                
                                        <b>Managers:</b>
                                        <br>
                                        - <strike>Create registration pins.</strike>
                                            <br>
                                        - <strike>View list of all members.</strike>
                                            <br>
                                        - Manage Members (View profile, wipe profile, suspend user, promote/demote user, etc.)
                                            <br>
                                        - Add a permanent show.
                                            <br>
                                        - Manage a permanent show.
                                
                                            <hr>
                                
                                        <b>Profiles:</b>
                                        <br>
                                        - <strike>Upload profile images.</strike>
                                            <br>
                                        - <strike>Edit bio.</strike>
                                            <br>
                                        - <strike>Edit social media networks.</strike>
                                            <br>
                                        - Reset password, etc.
                            
                                            <hr>
                            
                                        <b>Backend:</b>
                                        <br>
                                        - <strike>Setup cron job to wipe timetable every Saturday at 6pm (Chicago Time).</strike>
                                    </p>
                                </div>
                            </div>
                            <?php include("../assets/footer-text.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>