<?php
session_start();
$message="";
$connect = new PDO("mysql:host=127.0.0.1;dbname=art_gallery", 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION['loggedin']) and $_SESSION['loggedin']=='yes')
    {
        
		try
        {
            $userid=$_SESSION['id'];
            // echo $userid;
            $sql2="select * from cart where user_id='".$userid."'";
            $items=$connect->query($sql2)->fetchall();
            foreach($items as $item)
            {
                $sql="update item SET is_sold=TRUE where id=?";
                $connect->prepare($sql)->execute([$item['item_id']]);
            }
		}
		catch(Exception $e)
		{
			$message="Something went wrong please try again1!!";
            echo $e;
		}
        finally{
            $sql="delete from cart where user_id=?";
            try
            {
			    $connect->prepare($sql)->execute([$userid]);
		    }
		    catch(Exception $e)
		    {
			    $message="Something went wrong please try again2!!";
		    }
        }
    }
    else
    {
      header('location:login.php');
    }

?>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Better Eyes:Payment</title>
    <link rel="shortcut icon" href="../static/Logo2.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="CSS/style.css">
</head>
<body align=center>
    <h1>payment successfull</h1>
    <h6> Your product will arrived in 5-6 bussiness days!!</h6>
    <a href="index.php" class="btn btn-1">return Home</a> 
    <?php
		if($message!="")
		{
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>'.$message.'</strong>
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>