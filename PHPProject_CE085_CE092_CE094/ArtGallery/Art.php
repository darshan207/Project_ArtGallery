<?php session_start();
    $connect = new PDO("mysql:host=127.0.0.1;dbname=art_gallery", 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $message=""; 
    if(!isset($_SESSION['loggedin']))
    {
        header("location:index.php");
    }

    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION['loggedin']) and $_SESSION['loggedin']=='yes')
    {
        $userid=$_SESSION['id'];
        $itemid=$_POST['itemid'];
        $sql="delete from item where id='".$itemid."'";
		try
        {
			$connect->prepare($sql)->execute();
		}
		catch(Exception $e)
		{
			$message="You have already added this item to cart!! Please select different item.";
		}
        finally{
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Better Eyes:Art</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="navbar-1">
            <b><a href="">Better Eyes</a></b>
            <a href="index.php">Home</a>
            <a href="art.php" class="active"> Art</a>
            <a href="ContactUs.php"> Contact Us</a>
            <?php
                if(isset($_SESSION['loggedin']) and $_SESSION['loggedin']=='yes')
                {
                    echo '<p class="right-1"><i class="fas fa-user"></i>&nbsp;'.$_SESSION['username'].'</p>';
                }
                else
                {
                    header("location:login.php");
                }
            ?>
        </div>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<div class="container">
    <div class="row">
        <?php
        $sql="select * from item WHERE userid='".$_SESSION['id']."'";
        $allarts=$connect->query($sql)->fetchAll();
            foreach($allarts as $art)
            {
                if(isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == 'yes' and !$art['is_sold'])
                {
                echo '<div class="col-md-4 col-sm-6">
                <div class="box">
                    <form action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="POST">
                    <input type="hidden" value='.$_SESSION["id"].' name="userid">
                    
                    <input type="hidden"  value='.$art["id"].' name="itemid">
                    <img src='.$art["image_url"].'>
                    <div class="box-content">
                        <h3 class="title">'.$art["name"].'</h3>
                        <span class="post">₹.'.$art["price"].'</span>
                    </div>
                    <ul class="icon">
                        <li><button type="submit"  value="submit" class="submit-btn"> <i class="fas fa-trash-alt" onclick="" title="Add to cart"></i></button></li>
                    </ul>
                    </form>

                </div>
            </div>' ;
            
                }
                else if(isset($_SESSION['loggedin']) and $_SESSION['loggedin'] == 'yes' and $art['is_sold']){
                    // $message="Your some Items are sold-out!"; 
                    echo '<div class="col-md-4 col-sm-6">
                <div class="box">
                    <form action='.htmlspecialchars($_SERVER["PHP_SELF"]).' method="POST">
                    <input type="hidden" value='.$_SESSION["id"].' name="userid">
                    
                    <input type="hidden"  value='.$art["id"].' name="itemid">
                    <img src='.$art["image_url"].'>
                    <div class="box-content">
                        <h3 class="title">'.$art["name"].'</h3>
                        <span class="post">₹.'.$art["price"].'</span>
                    </div>
                    <ul class="icon">
                    <li>SOLD OUT</i></button></li>
                        <li><button type="submit"  value="submit" class="submit-btn"> <i class="fas fa-trash-alt" onclick="" title="Add to cart"></i></button></li>
                    </ul>
                    </form>

                </div>
            </div>';
                }
            }
        ?>
    </div>
    
</div>
<?php
		if(isset($message) and $message!="")
		{
		echo '<div class="alert alert-danger alert-dismissible fade show top" role="alert">
			<strong>'.$message.'</strong>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>';
		}
	?>
</body>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>