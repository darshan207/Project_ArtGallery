<?php
    session_start();
    $message="";
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION['loggedin']) and $_SESSION['loggedin']=='yes')
    {
        $connect = new PDO("mysql:host=127.0.0.1;dbname=art_gallery", 'root', '');
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $name=$_POST['name'];
        $price=$_POST['price'];
        $userid=$_SESSION['id'];
        $target_dir = "Image/";
        $target_file = $target_dir . basename($_FILES["imageupload"]["name"]);
        $uploadOk = 1;
        
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imageupload"]["tmp_name"]);
        if($check !== false) {
            $message="File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $message="File is not an image.";
            $uploadOk = 0;
        }
        }
        if($imageFileType != "jpg" ) {
            $message="Sorry, only JPG files are allowed.";
            $uploadOk = 0;
        }
        else{
            $sql="insert into item (name,userid,image_url,price) values(?,?,?,?)";
            try{
				$connect->prepare($sql)->execute([$name,$userid,$target_file,(int)$price]);
			}
			catch(Exception $e)
			{
				$message="Something went wrong, Please try again!!";
			}
            finally{
                if ($uploadOk == 0) {
                    $message="Sorry, your file was not uploaded.";
                  // if everything is ok, try to upload file
                  } else {
                    if (move_uploaded_file($_FILES["imageupload"]["tmp_name"], $target_file)) {
                      echo "The file ". htmlspecialchars( basename( $_FILES["imageupload"]["name"])). " has been uploaded.";
                    } else {
                      $message="Sorry, there was an error uploading your file.";
                    }
                  }
                header('location:index.php');
            }
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
    <title>Better Eyes:Add Art</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<!-- <div class="navbar-1">
            <a href="#">Home</a>
            <a href="#"> Art</a>
            <a href="#"> Gallery</a>
            <a href="#"> About Us</a>
            <a href="#"> Shopping</a>
            <?php
                // if(isset($_SESSION['loggedin']) and $_SESSION['loggedin']=='yes')
                // {
                //     echo '<a href="logout.php" class="right"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a><p class="right-1"><i class="fas fa-user"></i>&nbsp;'
                //     .$_SESSION['username'].'</p> <a href="cart.php" class="right"><i class="fa fa-shopping-cart"></i></a>';
                // }
                // else
                // {
                //     echo '<a href="signup.php" class="right"> Sign Up</a>
                //     <a href="login.php" class="right"> Login</a>';
                // }
            ?>
        </div> -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
    <div class="box-1">
            <h1>Art Data</h1>
            <div class="textbox">
                <input type="text" name="name" placeholder="Art name">
            </div>
            <div class="textbox">
                <input type="text" name="price" placeholder="Set Price">
            </div>
            <div class="textbox">
                <input type="file" name="imageupload" id="imageupload">
            </div>
            <br>
            <input type="submit" name="submit" class="btn" value="Add This art">
            <a href="index.php" class="btn">Back</button></a>
        </div>
    </form>
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
</html>