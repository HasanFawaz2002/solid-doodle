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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="products.css">
    <title>Products</title>
</head>

<body>
    <header>
        <div class="Logo" style="overflow:hidden">
            <img src="./Resources/attachment_63803293.png"  alt="">
            <p class="logo-description">
                Welcome <?php echo ' '.$client->cname.''; ?></p>
        </div>
        <nav class="navbar">
            <div class="Enterprise-title"><a href="index.html">Marketing Factory</a></div>
            <div class="nav-links">
                <ul>
                    <li><a href="index.html"> Home</a></li>
                    <li><a href="http://localhost:3000/MyPurchases.php">My Purchases</a></li>
                    <li><a href="#Contact   ">Contact</a></li>
                    <form class="book-btn" method="POST" style="position: relative; left:10vw;" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <input type="submit" class="Booking" name="logout" value="logout">
                    </form>
                    
                </ul>
            </div>
        </nav>
        <div class="page-title">
            <h1>Best services in digital marketing</h1>
        </div> 
    </header>
    <section class="product-page">
        <div class="product-page-bk"></div>

        <div class="product-page-section Clothes-page ">
            <div class="product-Title">Clothes</div>
            <div class="Item-container reveal">
                <?php
                $section = ProductsOfSection($con,"Clothes");
                if($section->products == null){
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
                    foreach($section->products as $product){
                        echo "<div class='Item'>
                                  <div class='Item-image' style='background-image:url(".$product->image_path.")'></div>
                                    <h3 id='Item-name'>".$product->product."</h3>
                                    <h3 id='Item-price'>
                                    <form action='http://localhost:3000/ProductView.php' method='post'>
                                        <input type='submit' class='Booking' value='view'>
                                        <input type = 'hidden' name='product_name' value='".$product->product."'>
                                        <input type = 'hidden' name='product_image' value=".$product->image_path.">
                                        <input type = 'hidden' name='product_price' value=".$product->price.">
                                    </form>
                                    </h3>
                                    </div>";      
                    }   
                }
                
                ?>
            </div>
        </div>


        <div class="product-page-section Auto-page">
            <div class="product-Title"> AutoMobiles</div>
            <div class="Item-container reveal">
            <?php
                $section = ProductsOfSection($con,"AutoMobiles");
                if($section->products == null){
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
                    foreach($section->products as $product){
                        echo "<div class='Item'>
                                  <div class='Item-image' style='background-image:url(".$product->image_path.")'></div>
                                    <h3 id='Item-name'>".$product->product."</h3>
                                    <h3 id='Item-price'>
                                    <form action='http://localhost:3000/ProductView.php' method='post'>
                                        <input type='submit' class='Booking' value='view'>
                                        <input type = 'hidden' name='product_name' value='".$product->product."'>
                                        <input type = 'hidden' name='product_image' value=".$product->image_path.">
                                        <input type = 'hidden' name='product_price' value=".$product->price.">
                                    </form>
                                    </h3>
                                    </div>";           
                    }   
                }
                
                ?>
            </div>
        </div>


        <div class="product-page-section Elec-page">
            <div class="product-Title"> Electronics</div>
            <div class="Item-container reveal">
            <?php
                $section = ProductsOfSection($con,"Electronics");
                if($section->products == null){
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
                    foreach($section->products as $product){
                        echo "<div class='Item'>
                                  <div class='Item-image' style='background-image:url(".$product->image_path.")'></div>
                                    <h3 id='Item-name'>".$product->product."</h3>
                                    <h3 id='Item-price'>
                                    <form action='http://localhost:3000/Welcome.php' method='post'>
                                        <input type='submit' class='Booking' value='view'>
                                        <input type = 'hidden' name='product_name' value='".$product->product."'>
                                        <input type = 'hidden' name='product_image' value=".$product->image_path.">
                                        <input type = 'hidden' name='product_price' value=".$product->price.">
                                    </form>
                                    </h3>
                                    </div>";            
                    }   
                }
                
                ?>

            </div>
        </div>


        <div class="product-page-section HouseStuff-page">
            <div class="product-Title"> House Stuff</div>
            <div class="Item-container reveal">
            <?php
                $section = ProductsOfSection($con,"HouseStaff");
                if($section->products == null){
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
                    foreach($section->products as $product){
                        echo "<div class='Item'>
                                  <div class='Item-image' style='background-image:url(".$product->image_path.")'></div>
                                    <h3 id='Item-name'>".$product->product."</h3>
                                    <h3 id='Item-price'>
                                    <form action='http://localhost:3000/ProductView.php' method='post'>
                                        <input type='submit' class='Booking' value='view'>
                                        <input type = 'hidden' name='product_name' value='".$product->product."'>
                                        <input type = 'hidden' name='product_image' value=".$product->image_path.">
                                        <input type = 'hidden' name='product_price' value=".$product->price.">
                                    </form>
                                    </h3>
                                    </div>";            
                    }   
                }
                
                ?>

            </div>
        </div>





        <div class="product-page-section Devices-page">
            <div class="product-Title"> Devices</div>
            <div class="Item-container reveal">
            <?php
                $section = ProductsOfSection($con,"Devices");
                if($section->products == null){
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
                    foreach($section->products as $product){
                        echo "<div class='Item'>
                                  <div class='Item-image' style='background-image:url(".$product->image_path.")'></div>
                                    <h3 id='Item-name'>".$product->product."</h3>
                                    <h3 id='Item-price'>
                                    <form action='http://localhost:3000/ProductView.php' method='post'>
                                        <input type='submit' class='Booking' value='view'>
                                        <input type = 'hidden' name='product_name' value='".$product->product."'>
                                        <input type = 'hidden' name='product_image' value=".$product->image_path.">
                                        <input type = 'hidden' name='product_price' value=".$product->price.">
                                    </form>
                                    </h3>
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