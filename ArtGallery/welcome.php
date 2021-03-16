<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="navbar-1">
            <a href="#">Home</a>
            <a href="#"> Art</a>
            <a href="#"> Gallery</a>
            <a href="#"> About Us</a>
            <a href="#"> Shoping</a>
            <?php
                if(isset($_SESSION['loggedin']) and $_SESSION['loggedin']=='yes')
                {
                    echo '<a href="logout.php" class="right"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a><p class="right-1"><i class="fas fa-user"></i>&nbsp;'
                    .$_SESSION['username'].'</p>';
                }
                else
                {
                    echo '<a href="signup.php" class="right"> Sign Up</a>
                    <a href="login.php" class="right"> Login</a>';
                }
            ?>
        </div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css />
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class="box">
                <img src="Image/2.jpg">
                <div class="box-content">
                    <h3 class="title">Williamson</h3>
                    <span class="post">Web designer</span>
                </div>
                <ul class="icon">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-link"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="box">
                <img src="Image/2.jpg">
                <div class="box-content">
                    <h3 class="title">Miranda Roy</h3>
                    <span class="post">Web designer</span>
                </div>
                <ul class="icon">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-link"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="box">
                <img src="Image/2.jpg">
                <div class="box-content">
                    <h3 class="title">Miranda Roy</h3>
                    <span class="post">Web designer</span>
                </div>
                <ul class="icon">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-link"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="box">
                <img src="Image/2.jpg">
                <div class="box-content">
                    <h3 class="title">Miranda Roy</h3>
                    <span class="post">Web designer</span>
                </div>
                <ul class="icon">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-link"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="box">
                <img src="Image/2.jpg">
                <div class="box-content">
                    <h3 class="title">Miranda Roy</h3>
                    <span class="post">Web designer</span>
                </div>
                <ul class="icon">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-link"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>