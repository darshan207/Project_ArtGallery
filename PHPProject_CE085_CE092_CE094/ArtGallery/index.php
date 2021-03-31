<?php session_start();
$connect = new PDO("mysql:host=127.0.0.1;dbname=art_gallery", 'root', '');
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "select * from item";
$allarts = $connect->query($sql)->fetchAll();
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == 'yes') {
    $userid = $_POST['userid'];
    $itemid = $_POST['itemid'];
    $sql = "insert into cart (user_id,item_id) values(?,?)";
    try {
        $connect->prepare($sql)->execute([$userid, $itemid]);
    } catch (Exception $e) {
        $message = "You have already added this item to cart!! Please select different item.";
    } finally {
        // header('location:cart.')
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/style.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Better Eyes</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="navbar-1">
            <b><a href="">Better Eyes</a></b>
            <a href="index.php" class=active>Home</a>
            <a href="art.php"> Art</a>
            <a href="ContactUs.php"> Contact Us</a>
            <?php
                if (isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == 'yes') {
                    echo '<a href="logout.php" class="right"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a><p class="right-1"><i class="fas fa-user"></i>&nbsp;'
                        . $_SESSION['username'] . '</p> <a href="cart.php" class="right"><i class="fa fa-shopping-cart"></i></a>';
                } else {
                    echo '<a href="signup.php" class="right"> Sign Up</a>
                            <a href="login.php" class="right"> Login</a>';
                }
            ?>
        </div>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <div class="container">
            <div class="row">
                <?php
            foreach ($allarts as $art) {
                if (isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == 'yes' and !$art['is_sold']) {
                    echo '<div class="col-md-4 col-sm-6">
                <div class="box">
                    <form action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' method="POST">
                    <input type="hidden" value=' . $_SESSION["id"] . ' name="userid">
                    
                    <input type="hidden"  value=' . $art["id"] . ' name="itemid">
                    <img src=' . $art["image_url"] . '>
                    <div class="box-content">
                        <h3 class="title">' . $art["name"] . '</h3>
                        <span class="post">₹.' . $art["price"] . '</span>
                    </div>
                    <ul class="icon">
                        <li><button type="submit"  value="submit" class="submit-btn"> <i class="fa fa-shopping-cart" onclick="" title="Add to cart"></i></button></li>
                    </ul>
                    </form>

                </div>
            </div>';
                }
                else if(isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == 'yes' and $art['is_sold']){
                    echo '<div class="col-md-4 col-sm-6">
                    <div class="box">
                        <form action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' method="POST">
                        <input type="hidden" value=' . $_SESSION["id"] . ' name="userid">
                        
                        <input type="hidden"  value=' . $art["id"] . ' name="itemid">
                        <img src=' . $art["image_url"] . '>
                        <div class="box-content">
                            <h3 class="title">' . $art["name"] . '</h3>
                            <span class="post">₹.' . $art["price"] . '</span>
                        </div>
                        <ul class="icon">
                            <li>SOLD OUT</li>
                        </ul>
                        </form>

                    </div>
                        </div>';
                }
                else{
                    echo '<div class="col-md-4 col-sm-6">
                <div class="box">
                    <form action=' . htmlspecialchars($_SERVER["PHP_SELF"]) . ' method="POST">
                    <input type="hidden"  value=' . $art["id"] . ' name="itemid">
                    <img src=' . $art["image_url"] . '>
                    <div class="box-content">
                        <h3 class="title">' . $art["name"] . '</h3>
                        <span class="post">₹.' . $art["price"] . '</span>
                    </div>
                    <ul class="icon">
                        <li><button type="submit"  value="submit" class="submit-btn"> <i class="fa fa-shopping-cart" onclick="" title="Add to cart"></i></button></li>
                    </ul>
                    </form>

                </div>
            </div>';
                }
            }
            if(sizeof($allarts)==0)
            {
                echo '<h3>Sorry no new art currently for sell !!</h3>';
            }
            ?>
            </div>
            <a class="btnicon-2" href="newart.php"><i class="fas fa-plus" title="Add New Art"></i></a>

        </div>
        <?php
    if (isset($message) and $message != "") {
        echo '<div class="alert alert-danger alert-dismissible fade show top" role="alert">
			<strong>' . $message . '</strong>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>';
    }
    ?>
    <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
    </body>

</html>