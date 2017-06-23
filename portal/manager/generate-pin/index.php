<?php
    include("../../../includes/common.php");
    if(empty($userid)){
        header("Location: ../../../index.php?sessionExpired=1");
        die("Redirecting...");
    } 

    if($role <= "2"){
        header("Location: ../../../portal");
    }

    $title="Create Staff Account"
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
        <div class="col-md-4 offset-md-4">
            <div class="card">
                <div class="card-block">
                    <h4>Create a New Account</h4>
                    <p>This form will generate a <b>registration pin</b> which you will share with the Staff Member. From there - the staff member will go to <a href="#">http://staff.slur-radio.net</a>, type in the pin you provide, then set a password. They will then be able to login and use panel functions.</p>
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <form action="generate-pin.php" method="post">
                                <div class="form-group row">
                                    <label for="username" class="col-4 col-form-label">Username</label>
                                    <div class="col-8">
                                        <input class="form-control" type="text" name="username" id="username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-4 col-form-label">Role</label>
                                    <div class="col-8">
                                        <select class="form-control" name="role" id="role" >
                                            <option value="1">Radio DJ</option>
                                            <option value="2">Head DJ</option>
                                            <option value="3">Manager</option>
                                            <option value="4">Admin</option>
                                            <option value="5">Owner</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="trial" class="col-4 col-form-label">Trial Role</label>
                                    <div class="col-8">
                                        <select class="form-control" name="trial" id="trial" >
                                            <option value="0">None</option>
                                            <option value="1">Trial Radio DJ</option>
                                            <option value="2">Trial Head DJ</option>
                                            <option value="3">Trial Manager</option>
                                            <option value="4">Trial Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="region" class="col-4 col-form-label">Region</label>
                                    <div class="col-8">
                                        <select class="form-control" name="region" id="region" >
                                            <option value="1">North America</option>
                                            <option value="2">Oceanic</option>
                                            <option value="3">Europe</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button type="submit" class="btn btn-outline-danger btn-block">Generate Pin</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>