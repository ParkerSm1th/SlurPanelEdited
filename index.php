<?php
    $created=$_GET['accountCreated'];
    $failure=$_GET['loginFailure'];
    $expired=$_GET['sessionExpired'];
    $invalid=$_GET['invalidPin'];

    $title="Login/Register";

    if($created=="1"){
        $banner="<div class='alert alert-success' role='alert'><strong>Success!</strong> Account created!</div>";
    }

    if($failure=="1"){
        $banner="<div class='alert alert-danger' role='alert'><strong>Uh oh!</strong> Login failed!</div>";
    }

    if($invlaid=="1"){
        $banner="<div class='alert alert-danger' role='alert'><strong>Invalid pin!</strong> Registration failed!</div>";
    }

    if($expired=="1"){
        $banner="<div class='alert alert-info' role='alert'><strong>Umm...</strong> Your session expired, please login again.</div>";
    }
?>
<html>
    <?php
        include("assets/header.php");
    ?>
    <style>
        body {
            padding-top: 24px;
            background-color: dimgrey;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Roboto Slab';
        }
        
        p {
            font-family: 'Roboto';
        }
    </style>
    <body>
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12">
                <p class="text-md-center text-sm-center"><img src="/assets/logo.png" width="25%" height="auto"></p>
                <div class="card">
                    <div class="card-block">
                        <?php echo $banner ?>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <h4>Login <small>to an existing account</small></h4>
                                <form action="/includes/login.php" method="post">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-primary">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <h4>Register <small>a new account</small></h4>
                                <p>To get a <b>Registration Pin</b>, please reach out to your Manager.</p>
                                <form action="/includes/register.php" method="post">
                                    <div class="form-group">
                                        <label for="pin">Registration Pin</label>
                                        <input type="text" class="form-control" name="pin" id="pin" placeholder="Pin" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-primary">Create Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php include("assets/footer-text.php") ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>