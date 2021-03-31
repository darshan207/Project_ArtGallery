<?php
	session_start();
    $message="";
    if(isset($_SESSION['loggedin']))
    {
        header("location:index.php");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $connect = new PDO("mysql:host=127.0.0.1;dbname=art_gallery", 'root', '');
	    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $username=$_POST['username'];
        $password=md5($_POST['username'].$_POST['password']);
        $sql="select * from userdata where username='".$username."' and password='".$password."'";
       $user= $connect->query($sql)->fetchAll();
       if(sizeof($user)==0)
      {
        $message="Username or Password invalid";
      }
			else{
				$_SESSION['username']=$username;
				$_SESSION['email']=$user[0]['email'];
				$_SESSION['id']=$user[0]['id'];
				$_SESSION['loggedin']="yes";
				header('location:index.php');
			}
		}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Better Eyes:Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="CSS/style.css">
</head>
<style type="text/css">
::placeholder {

    color: darkgrey;
    opacity: 10;
}
</style>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <div class="box-1">
            <h1>Login</h1>
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username">
            </div>

            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" id="password">
            </div>
            <br>
            <label class="checkbox">
                <input type="checkbox" onclick="myFunction()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;show password
                <span class="default"></span>
            </label>
            <input type="submit" name="submit" class="btn" value="Login">
            <a href="signup.php" class="btn">Sign Up</button></a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
    <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>

</html>