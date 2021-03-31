<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION['loggedin']) and $_SESSION['loggedin']=='yes')
    {
        $connect = new PDO("mysql:host=127.0.0.1;dbname=art_gallery", 'root', '');
        $userid=$_SESSION['id'];
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="Update userdata SET address=?, mobile_no=? where id=?";
        try{
            $connect->prepare($sql)->execute([$_POST['address'],$_POST['mobile_no'],$userid]);
        }
        catch(Exception $e)
        {
            $message="Something went wrong!!";
        }
        $total_bill=$_POST['total_bill'];
    }
    else
    {
      header('location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Better Eyes:Payment</title>

</head>
<style>
body {
  background: #1C1D21;
}

h1 {
  color: #EEEFF7;
  text-align: center;
  font-size:30px;
}

form {
  width: 350px;
  margin: 0 auto;
}
form .half input {
  width: 165px;
  float: left;
}
form .half input:first-child {
  margin-right: 20px;
}
form input, form button {
  box-sizing: border-box;
  display: block;
  float: left;
  width: 100%;
  padding: 5px;
  font-size: 20px;
  margin-bottom: 20px;
  outline: none;
  border: none;
}
form input {
  color: #1C1D21;
}
form button {
  color: #1C1D21;
  background: #EEEFF7;
  font-weight: bold;
}
</style>
<body>
    <h1>::Payment::<h1>
    <checkout>
  <form method="post" action='payment_complete.php'>
    <input placeholder="Card number" type="text" required="required"/><input placeholder="Name on card" required="required" type="text" />
    <div class="half">
      <input placeholder="MM/YY" type="text" required="required"/><input placeholder="CVC" type="text" required="required"/>
    </div>
    <input type="submit" value="Pay ₹<?php echo $total_bill;?>">
  </form>
</checkout>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>