<?php
require_once("DBConnect.php");
session_start();
if(isset($_POST['admin_name']) && isset($_POST['password'])){
$_SESSION['admin_name'] = $_POST['admin_name'];
$_SESSION['password'] = $_POST['password'];
}

if(isset($_POST['logout'])){
    session_destroy();
    header("location: StaffLogin.html");
}

if (!isset($_SESSION['admin_name']) || !isset($_SESSION['password'])) {
    header("location: StaffLogin.html");
} else {
    $admin = new Admin();

    $admin->Aname = $_SESSION['admin_name'];
    $admin->Apassword = $_SESSION['password'];
    $result = LoginAdmin($admin);
    if ($result->num_rows == 0) {
        die("<span style='color:red'>Invalid login</span>");
    }
}
$row = $result->fetch_assoc();
$admin->type = $row['type'];
if ($admin->type == 'Super') {
    $_SESSION['user-type'] = 'Super';
    
echo '
<html>

<div style="margin-bottom: 200px;">
<h3 style="color: chartreuse;">Add a new admin:</h3>
<form action="http://localhost:3000/DBManagement.php" method="post">

    <input type="hidden" name="op-type" value="addAdmin">


    <label for="admin_name">admin name</label><br>
    <input type="text" placeholder="new admin name" name="new_admin_name"><br>

    <label for="password">password:</label><br>
    <input type="password" placeholder="new password" name="new_password"><br>
    <input type="submit" value="submit">
</form>
</div>



<div style="margin-bottom: 200px;">
<h3 style="color: chartreuse;">Delete admin account:</h3>
<form action="http://localhost:3000/DBManagement.php" method="post">

    <input type="hidden" name="op-type" value="deleteAdmin">


    <label for="admin_name">admin name</label><br>
    <input type="text" placeholder="admin name" name="del_admin_name"><br>

    <label for="password">password:</label><br>
    <input type="password" placeholder="password" name="del_password"><br>
    <input type="submit" value="submit">
</form>
</div>


<div style="margin-bottom: 200px;margin: top 50px;">
        <form class="book-btn" method="POST" action="'.$_SERVER["PHP_SELF"].'">
            <input type="submit" name="logout" value="logout" style="background-color:#ADD8E6">
        </form>
</div>
</html>
';





}




else {
    $_SESSION['user-type'] = 'admin';
    echo '
    <html>

<body>
    <div style="margin-bottom: 200px;">
        <h3 style="color: chartreuse;">Add a new product:</h3>
        <form action="http://localhost:3000/DBManagement.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="op-type" value="addProduct">


            <label for="section">Section:</label><br>
            <input type="text" placeholder="Section Title" name="section"><br>

            <label for="product">product:</label><br>
            <input type="text" placeholder="product name" name="product"><br>

            <label for="price">price:</label><br>
            <input type="number" placeholder="price in $" name="price"><br>

            <p>
            <h4>upload an image:</h4>
            </p>
            <input type="file" name="image_path"><br>

            <input type="submit" value="submit">
        </form>
    </div>

    <div style="margin-bottom: 200px;margin: top 100px;">
        <h3 style="color:aqua;">update an existing item:</h3>
        <form action="http://localhost:3000/DBManagement.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="op-type" value="updateProduct">


            <label for="section">Section:</label><br>
            <input type="text" placeholder="Section Title" name="section"><br>

            <label for="product">product:</label><br>
            <input type="text" placeholder="old product name" name="product"><br>

            <label for="newProductName"> new name:</label><br>
            <input type="text" placeholder="new product name" name="newProductName"><br>

            <label for="price">price:</label><br>
            <input type="number" placeholder="price in $" name="price"><br>

            <p>
            <h4>upload an image:</h4>
            </p>
            <input type="file" name="image_path"><br>

            <input type="submit" value="submit">
        </form>
    </div>

    <div style="margin-bottom: 200px;margin: top 100px;">
        <h3 style="color:firebrick;">delete an existing item:</h3>
        <form action="http://localhost:3000/DBManagement.php" method="post">

            <input type="hidden" name="op-type" value="deleteProduct">


            <label for="section">Section:</label><br>
            <input type="text" placeholder="Section Title" name="section"><br>

            <label for="product">product:</label><br>
            <input type="text" placeholder="old product name" name="product"><br>

            <input type="submit" value="submit">
        </form>
    </div>




    <div style="margin-bottom: 200px;margin: top 50px;">
        <form method="POST"  action="'.$_SERVER["PHP_SELF"].'">
            <input type="submit" name="logout" value="logout" style="width: 70px; background-color:red">
        </form>
    </div>
</body>

</html>
    ';
}