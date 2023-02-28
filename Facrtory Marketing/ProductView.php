<?php
require_once("DBConnect.php");
session_start();
$client = new Client();
$product = new Product();

$client->cid = $_SESSION['client_id'];
$client->cname = $_SESSION['client_name'];

$product->product = $_POST['product_name'];
$product->image_path = $_POST['product_image'];
$product->price = $_POST['product_price'];
?>


<!DOCTYPE html>
<html lang=”en”>
<head>
<style>
    
body {
  background-color: firebrick;
  margin: auto;
  width: 640px; 
  padding: 50px;
  font-family: 'Avenir', sans-serif; 
  color:aliceblue;    
}

/* Centered Image Code */

.container {
  height: 500px;
  position: relative;
  border: 3px solid #dbe4ed; /* Border color is optional */ 
  background-color: #3c3c3c;
}

 .center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  /* overflow:hidden; */
}

 .Booking{
    
    padding: 8px 16px;
    background-color: #3c3c3c; 
    border-radius: 30px;
    border: #cc950a solid 2px;
    color: rgb(202, 57, 57);
    font-size: 1.2rem;
    font-family: Poppins;
    font-weight: bold;
    white-space: nowrap;    
    position: relative;
    top: 5vh;
    vertical-align: middle;
}
.Booking:hover{
    background-color: rgba(255, 255, 255, 0.24);
    cursor: pointer;
    transition: 0.2s all ease-in;
}

.fit {
  width: 400px;
  max-height: 450px;
  border: dashed firebrick 1px;
}

</style>



<title></title>

</head>
  
<body>
<h1 style="font-family:Verdana, Geneva, Tahoma, sans-serif;"><?php echo $product->product; ?></h1>
<p>Final price: <?php echo "$product->price"; ?></p>
  
<div class="container">
<div class="center">

<img class="fit" width="400" src="<?php echo $product->image_path ?>">
</div>
</div>


<form method="POST">
<?php 
if(!isset($_POST['buy'])){
echo '<input type="submit" name="buy" value="buy" class="Booking">
<input type="hidden" value="'.$product->product.'" name="product_name">
<input type="hidden" value="'.$product->image_path.'" name="product_image">
<input type="hidden" value="'.$product->price.'" name="product_price">';
}
else{
    echo '<input type="submit" name="buy" value="buy" class="Booking" style="background-color:rgba(255, 255, 255, 0.24);" disabled>';
}
?>
</form>

<?php 
if(isset($_POST['buy'])){
    echo "<span style='color:white;position: relative;left:10vw'><h4>".$product->product." is reserved for ".$client->cname."</h4></span>";
    $con = ConnectToDB('localhost', 'root', '', 'FactoryMarketing');
    BuyProduct($con,$client,$product);
}
?>

<p><a href="http://localhost:3000/Products.php"><button class="Booking">Go back</button></a></p>
</body>
</html>