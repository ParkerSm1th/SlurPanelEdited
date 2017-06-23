<nav class="navbar navbar-toggleable-md sticky-top navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
        <a class="navbar-brand" href="#"><img src="/assets/black-logo.png" width="auto" height="30" class="d-inline-block align-top" alt=""></a>
        <span class="navbar-text">
            <?php echo $username ?>
            <span class="badge badge-default" style="background-color: <?php echo $roleColor ?>;"><?php echo $roleName; ?></span>
        </span>
        <img src="/images/<?php echo $username; ?>.png" onerror="/images/slur.png" height="40" class="d-inline-block align-top rounded">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link hvr-underline-from-left" href="/portal">Dashboard</a>
                </li>
                <?php
                    if($roleData['role'] >= "1"){
                        echo "
                        <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle hvr-underline-from-left' href='http://example.com' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                Radio DJ
                            </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                <a class='dropdown-item' href='/portal/radio-dj/timetable'>Timetable</a>
                                <a class='dropdown-item disabled' href='#'>My Warnings</a>
                            </div>
                        </li>
                        ";
                    }
                    if($roleData['role'] >= "2"){
                        echo "
                        <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle hvr-underline-from-left' href='http://example.com' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                Head DJ
                            </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                <a class='dropdown-item' href='/portal/head-dj/bookings'>Manage Slots</a>
                                <a class='dropdown-item disabled' href='#'>Issue A Warning</a>
                                <a class='dropdown-item disabled' href='#'>Allow Connection Information</a>
                                <a class='dropdown-item disabled' href='#'>Song Logs</a>
                                <a class='dropdown-item disabled' href='#'>Warning Logs</a>
                            </div>
                        </li>
                        ";
                    }
                    if($roleData['role'] >= "3"){
                        echo "
                        <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle hvr-underline-from-left' href='http://example.com' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                Manager
                            </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                <a class='dropdown-item' href='/portal/manager/generate-pin'>Create Registration Pin</a>
                                <a class='dropdown-item' href='/portal/manager/users'>Manage Staff Accounts</a>
                                <a class='dropdown-item disabled' href='/portal/manager/permshow/add'>Add Permanent Show</a>
                                <a class='dropdown-item disabled' href='/portal/manager/permshow'>Manage Permanent Show</a>
                            </div>
                        </li>
                        ";
                    }
                ?>
                <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle hvr-underline-from-left' href='http://example.com' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        My Account
                    </a>
                    <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                        <a class='dropdown-item disabled'><b><?php echo $username ?></b><br><small style="color: <?php echo $roleColor ?>"><?php echo $roleName ?></small></a>
                        <a class='dropdown-item' href='/portal/account/profile'>My Profile</a>
                        <a class='dropdown-item disabled' href='#'>Account Settings</a>
                        <a class='dropdown-item' href='/includes/logout.php'>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>    
</nav>
<style>body { overflow-x: hidden; }</style>