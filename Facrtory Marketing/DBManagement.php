<?php


function isImage($image){
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $imgExtArr = ['jpg', 'jpeg', 'png'];
    if(in_array($extension, $imgExtArr)){
        return true;
    }
    return false;
}



require_once("DBConnect.php");
$con = ConnectToDB('localhost', 'root', '', 'FactoryMarketing');
session_start();

if (isset($_SESSION['user-type'])) {
    if ($_SESSION['user-type'] == 'admin') {
        if ($_POST['op-type'] == 'addProduct') {
            $product = new Product();

            $section = $_POST['section'];
            $product->product = $_POST['product'];
            $product->price = $_POST['price'];
            $target_dir = ".\Resources";
            foreach ($_FILES as $uploads => $distinct_file) {
                if (is_uploaded_file($distinct_file['tmp_name'])) {

                    //check if the uploaded file is image
                    $check = getimagesize($distinct_file["tmp_name"]);
                    if($check == false) {
                        echo "".$distinct_file["tmp_name"]."";
                        echo "<p style='color:red'>The file should be of image type!!!</p>";
                        break;
                    }

                    $name = "name";
                    $file = $distinct_file['name'];
                    move_uploaded_file($distinct_file['tmp_name'], "$target_dir/$distinct_file[$name]") or die("Couldn't copy");
                    $product->image_path = "Resources/$file";
                    insertProduct($con,$section,$product);
                    echo "done<br>";
                } else {
                    echo $distinct_file['error'];
                }
            }
        }
        elseif ($_POST['op-type'] == 'updateProduct') {
            $product = new Product();
            $section = $_POST['section'];
            $product->product = $_POST['newProductName'];
            $product->price = $_POST['price'];
            $oldPname = $_POST['product'];
            $target_dir = ".\Resources";
            foreach ($_FILES as $uploads => $distinct_file) {
                if (is_uploaded_file($distinct_file['tmp_name'])) {
                    
                    $check = getimagesize($distinct_file["tmp_name"]);
                    if($check == false) {
                        echo "".$distinct_file["tmp_name"]."";
                        echo "<p style='color:red'>The file should be of image type!!!</p>";
                        break;
                    }

                    $name = "name";
                    $file = $distinct_file['name'];
                    $product->image_path = "Resources/$file";
                    updateProduct($con,$section,$oldPname,$product);
                    move_uploaded_file($distinct_file['tmp_name'], "$target_dir/$distinct_file[$name]") or die("Couldn't copy");
                    echo "done<br>";
                } else {
                    echo $distinct_file['error'];
                }
            }
        } 
        else {
            $product = new Product();
            $section = $_POST['section'];
            $product->product = $_POST['product'];
            DeleteProduct($con, $section, $product);
            echo "done<br>";
        }
    } 
    
    else {
        if($_POST['op-type'] == 'addAdmin'){
            $admin = new Admin();
            $admin->Aname = $_POST['new_admin_name'];
            $admin->Apassword = $_POST['new_password'];
            $result = AddAdmin($con,$admin);
            if($result){
                echo '<p style="color:lightgreen">Admin added successfully</p>';
            }
        }
        else{
            $admin = new Admin();
            $admin->Aname = $_POST['del_admin_name'];
            $admin->Apassword = $_POST['del_password'];
            $result = DeleteAdmin($con,$admin);
            if($result){
                echo '<p style="color:lightgreen">Admin deleted sucessfully successfully</p>';
            }
        }
    }
    $con->close();
    //session_destroy();
}

//else: the session is not set => client registeration(if no account and reservation)
//here use the function to register the client and echo to him a successful or failure message.
else {
    header("location: Admin.php");
}
?>

<html>
<a href="http://localhost:3000/Admin.php"><button>Go Back</button></a>

</html>