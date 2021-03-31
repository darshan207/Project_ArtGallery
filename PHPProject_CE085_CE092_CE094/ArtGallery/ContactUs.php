<?php session_start();
$connect = new PDO("mysql:host=127.0.0.1;dbname=art_gallery", 'root', '');
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Better Eyes:Contact Us</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="navbar-1">
            <b><a href="">Better Eyes</a></b>
            <a href="index.php">Home</a>
            <a href="art.php"> Art</a>
            <a href="ContactUs.php" class="active"> Contact Us</a>
        <?php
        if (isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == 'yes') {
            echo '<a href="logout.php" class="right"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a><p class="right-1"><i class="fas fa-user"></i>&nbsp;'
                . $_SESSION['username'] . '</p>';
        } else {
            echo '<a href="signup.php" class="right"> Sign Up</a>
                    <a href="login.php" class="right"> Login</a>';
        }
        ?>
    </div>
    <div class="contact" align="center">
        <h2>Better Eyes<h2>
        <h6 style="font-family:verdana ;color:rgba(126, 126, 126, 0.829)">(A unit of Chisel Crafts Pvt. Ltd.)<br>
        College Road,Vaniyavad<br>
        12/3A, Hungerford Street<br>
        Nadiad-387001<br>
        Fax No : +91 33 56326265<br>
        E-Mail : art.bettereyes@gmail.com <h6>
    </div>
    <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>