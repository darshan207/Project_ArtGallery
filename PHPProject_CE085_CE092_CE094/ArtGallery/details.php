<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_SESSION['loggedin']) and $_SESSION['loggedin']=='yes' and isset($_POST['place-order-form']))
    {
        $userid=$_SESSION['id'];
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
    <link rel="stylesheet" href="CSS/style.css">
    <title>Better Eyes:Details</title>
</head>
<body>
<?php
    $connect = new PDO("mysql:host=127.0.0.1;dbname=art_gallery", 'root', '');
    $userid=$_SESSION['id'];
	$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="select * from userdata where id='".$userid."'";
    $userdetails=$connect->query($sql)->fetchAll();
    if(empty($userdetails[0]['address']) and empty($userdetails[0]['mobile_no']))
    {
    echo '<div>
        <form action="payment.php" method="POST">
            <div class="box-1">
            <h1>Fill Details</h1>
            <div class="textbox">
            <i class="far fa-address-card"></i>
                <textarea name="address" placeholder="Address" required="required"></textarea>
            </div>
            <input type="hidden" name="total_bill" value='.$total_bill.'>
            <div class="textbox">
            <i class="fa fa-mobile-alt"></i>
                <input type="text" name="mobile_no" placeholder="Mobile" required="required">
            </div>
            <br>
            <input type="submit" value="Save and Proceed" class="btn btn-1">
        </div>
        </form>
        
    </div>';
    }
    else
    {
        echo '<div>
        <form action="payment.php" method="POST">
            <div class="box-1">
            <h1>Confirm Details</h1>
            <div class="textbox">
                <i class="fas fa-address-card"></i>
                <textarea name="address" placeholder="Address" required="required">'.$userdetails[0]['address'].'</textarea>
            </div>
            <input type="hidden" name="total_bill" value='.$total_bill.'>
            <div class="textbox">
                <i class="fas fa-mobile-alt"></i>
                <input type="text" name="mobile_no" placeholder="MOBILE NUMBER" value="'.$userdetails[0]['mobile_no'].'" required="required">
            </div>
            <br>
            <input type="submit" value="Save and Proceed" class="btn btn-1">
        </div>
        </form>
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