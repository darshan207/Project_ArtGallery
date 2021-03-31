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
        $email=$_POST['email'];
        $password=md5($_POST['username'].$_POST['pass']);
		
		if($_POST['pass']!=$_POST['cpass'])
		{
			$message="Password and Confirm Password differs!!";
		}
		else
		{
			$sql="insert into userdata (username,email,password) values(?,?,?)";
			try{
				$connect->prepare($sql)->execute([$username,$email,$password]);
			}
			catch(Exception $e)
			{
				$message="Username or Email already exits!!";
			}
			if($message==""){
				$_SESSION['username']=$username;
				$_SESSION['email']=$email;
				$sql1="select id from userdata where username='".$username."' and email='".$email."'";
				$id=$connect->query($sql1)->fetchAll();
				$_SESSION['id']=$id[0]['id'];
				$_SESSION['loggedin']="yes";
				header('location:index.php');
			}
		}
    }
?>
<head>
	<title>Better Eyes:Registration</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="CSS/style.css">
</head>

<body>
	<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST" >
		<div class="box-1">

			<!-- Username : -->
			<h1>Sign Up</h1>
			<div class="textbox">
				<i class="fas fa-user"></i>
				<input type = "text" name = "username"  placeholder="username" required="required"/><br>
			</div>
			

            <div class="textbox">
				<i class="fas fa-envelope"></i>
				<input type = "email" name = "email"  placeholder="Email" required="required"/><br>
			</div>


			<!-- Password :  -->
			<div class="textbox">
				<i class="fas fa-lock"></i>
				<input type = "password" name = "pass" id="password" placeholder="Password" minlength = "6" required="required" onchange="check_pass();"><br>
			</div>


			<!-- Confirm Password :  -->
			<div class="textbox">
				<i class="fas fa-lock"></i>
				<input type = "password" name = "cpass" id="cpassword" placeholder="Confirm Password" minlength = "6" required="required" onchange="check_pass();">
			</div>
			
			<input type = "submit" class="btn" name= "submit" id="submit" value = "Register">
			<a href="login.php" class="btn">Login</button></a>

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>