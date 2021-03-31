<?php session_start();

$connect = new PDO("mysql:host=127.0.0.1;dbname=art_gallery", 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION['loggedin']) and $_SESSION['loggedin']=='yes')
    {
        $userid=$_SESSION['id'];
        $itemid=$_POST['itemid'];
        $sql="delete from cart where user_id='".$userid."' and item_id='".$itemid."'";
		try
        {
			$connect->prepare($sql)->execute();
		}
		catch(Exception $e)
		{
			$message="Something went wrong please try again!!";
		}
        finally{
            // header('location:cart.')
        }
    }
    else if($_SERVER["REQUEST_METHOD"]=="POST")
    {
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
        <title>Better Eyes:Cart</title>
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
            <a href="index.php">Home</a>
            <a href="art.php"> Art</a>
            <a href="ContactUs.php"> Contact Us</a>
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
        <?php
    echo '<div class="container">';//<table border=2 align="center">';
    // echo '<tr><td width="200">Item name</td><td width="350">Item</td><td with="100">Price</td><td>remove</td></tr>';
    $connect = new PDO("mysql:host=127.0.0.1;dbname=art_gallery", 'root', '');
    $userid=$_SESSION['id'];

	$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="select * from cart where user_id='".$userid."'";
    $usercart=$connect->query($sql)->fetchAll();
    $sum=0;
    $x=0;
    foreach($usercart as $cart_item){
        $sql1="select * from item where id='".$cart_item['item_id']."'";
        $item=$connect->query($sql1)->fetchAll();
        if(!$item[0]['is_sold'])
        {
            $x=$x+1;
            echo '
            <form action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="post">
            <input type="hidden" value='.$item[0]['id'].' name="itemid">
                <div class="row">
                    <div class="cart-item col-md-3">
                        <h3>'.$item[0]['name'].'</h3>
                    </div>
                    <div class="cart-item col-md-3 zoom">
                        <img src='.$item[0]['image_url'].' alt='.$item[0]['name'].' width="250" height="250">
                    </div>
                    <div class="cart-item col-md-3">
                        <h3>'.$item[0]['price'].'</h3>
                    </div>
                    <div class="cart-item col-md-3">
                    <button class="submit-btn" type="submit"  value="submit" title="Delete item '.$item[0]['name'].' from cart"> <i class="fa fa-trash-alt" onclick="" ></i></button>
                    </div>
                </div>
                </form>';
                $sum=$sum+(int)$item[0]['price'];
        }
        else
        {
            echo '
            <form action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="post">
            <input type="hidden" value='.$item[0]['id'].' name="itemid">
                <div class="row">
                    <div class="cart-item col-md-3">
                        <h3>'.$item[0]['name'].'</h3>
                    </div>
                    <div class="cart-item col-md-3 zoom">
                        <img src='.$item[0]['image_url'].' alt='.$item[0]['name'].' width="250" height="250">
                    </div>
                    <div class="cart-item col-md-3">
                        <h3>Sold</h3>
                    </div>
                    <div class="cart-item col-md-3">
                    <button class="submit-btn" type="submit"  value="submit" title="Delete item '.$item[0]['name'].' from cart"> <i class="fa fa-trash-alt" onclick="" ></i></button>
                    </div>
                </div>
                </form>';
        }
        
    }
    if(sizeof($usercart)==0)
    {
        echo '<h3>It seems your cart is empty!!</hr>';
    }
    echo '<div class="row">
                <div class="cart-item col-md-3">
                   
                </div>
                <div class="cart-item col-md-3 zoom">
                    
                </div>
                <div class="cart-item col-md-3">
                    <h3>Total</h3>
                </div>
                <div class="cart-item col-md-3">
                <h3>'.$sum.'</h3>
                </div>
                
            </div>';
    echo '</div></div>';
    ?>
        <?php
        if($x==sizeof($usercart) and $x!=0)
            echo '<div class="submit" align=center>
                <form action="details.php" method="post">
                    <input type="hidden" value="place-order-form" name="place-order-form">
                    <input type="hidden" value='.$sum.' name="total_bill">
                    <input type="submit" value="Placeorder" class="btn btn-1">
            </form>'
        ?>
			</div>
            <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
    </body>