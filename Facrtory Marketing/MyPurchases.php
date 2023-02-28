<?php
require_once("DBConnect.php");
session_start();
if(!isset($_SESSION['client_id']) || !isset($_SESSION['client_name'])){
    session_destroy();
    header("location: login.php");
}
if(isset($_POST['logout'])){
    session_destroy();
    header("location: index.html");
}
$con = ConnectToDB('localhost', 'root', '', 'FactoryMarketing');
$client = new Client();
$client->cid = $_SESSION['client_id'];
$client->cname = $_SESSION['client_name'];
getClientProducts($con,$client);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="products.css">
    <title>Reserved Products:<?php echo $client->cid?></title>
</head>

<body>
    <header>
        <div class="Logo" style="overflow:hidden">
            <img src="./Resources/attachment_63803293.png"  alt="">
            <p class="logo-description" style="font-family:'Times New Roman', Times, serif">
            <?php echo ' '.$client->cname.''; ?> Products</p>
        </div>
        <nav class="navbar">
            <div class="Enterprise-title"><a href="index.html">Marketing Factory</a></div>
            <div class="nav-links">
                <ul>
                    <li><a href="index.html"> Home</a></li>
                    <li><a href="http://localhost:3000/Products.php">Products</a></li>
                    <li><a href="#Contact   ">Contact</a></li>
                    <form class="book-btn" method="POST" style="position: relative; left:10vw;" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <input type="submit" class="Booking" name="logout" value="logout">
                    </form>
                    
                </ul>
            </div>
        </nav>
        <div class="page-title">
            <?php
            if($client->products == null){
                echo '<h1>You have selected nothing yet.</h1>';
                $sec_title = "Nothing TO Show...";
            }
            else{
                echo "<h1>Your Total Fees: ".$client->getTotalFees()."</h1>";
                $sec_title = "Your Selected Items";
            }
            ?>
            
        </div> 
    </header>
    <section class="product-page">
        <div class="product-page-bk"></div>

        <div class="product-page-section Sections-page ">
            <div class="product-Title"><?php echo $sec_title; ?></div>
            <div class="Item-container reveal">
                <?php
                $section = ProductsOfSection($con,"Clothes");
                if($client->products == null){
                    echo '
                    <div class="Item">
                        <div class="Item-image"></div>
                        <h3 id="Item-name">currently no items</h3>
                        <h3 id="Item-price">...</h3>
                    </div>
                    <div class="Item">
                        <div class="Item-image"></div>
                        <h3 id="Item-name">currently no items</h3>
                        <h3 id="Item-price">...</h3>
                    </div>';
                }
                else{
                    foreach($client->products as $product){
                        echo "<div class='Item'>
                                  <div class='Item-image' style='background-image:url(".$product->image_path.")'></div>
                                    <h3 id='Item-name'>".$product->product."</h3>
                                    <h3 id='Item-price'>".$product->price." $</h3>
                                    </div>";      
                    }   
                }
                
                ?>
            </div>
        </div>


      

        
    </section>


    <footer class="footer" id="Contact">
            <p class="footer-title">CopyRights@ <span>FactoryMarketing</span></p>
            <div class="social-icons">
                <a href="#">
                    <i class="fab fa-facebook"></i></a>

                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
            <div class="contact-info">
                <p id="phone">+33 1234567890</p>
                <p id="email">FactoryMarketing@mail.com</p>
                <a href="">


                    <i class="fa-light fa-map-pin"></i>Location</a>
            </div>
        </footer>
   

    <script src="./file.js"></script>


</body>

</html>