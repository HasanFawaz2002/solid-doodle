<?php

class Client{
    public $cid;
    public $cname;
    public $products;
    public $cpassword;
    function __construct()
    {
        $products = array();
    }

    function getTotalFees(){
        $sum = 0;
        foreach($this->products as $product){
            $sum  += $product->price;
        }
        return $sum;
    }
}

class Section{
    public $sid;
    public $section;
    public $products;

    function __construct()
    {
        $products = array();
    }
}

class Product{
    public $pid;
    public $cid;
    public $sid;
    public $product;
    public $image_path;
    public $price;
}

class Admin{
    public $Aid;
    public $Aname;
    public $Apassword;
    public $type;
}



function ConnectToDB($Sname, $Uname, $p, $db)
{
    try{
        $con = new mysqli($Sname, $Uname, $p, $db);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        else {
            return $con;
        }
    }
    catch(Exception $e){
        return null;
    }
}


function getSectionId($con, $section_name)
{
    $sql = "SELECT Section.sid
    FROM Section
    where section = '$section_name'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $SID = $row['sid'];
    }
    else{
        die("<h3 style='color:red'>Not a valid section name!</h3>");
    }
    return $SID;
}


function getProductId($con,$product_name){
    $sql = "SELECT Product.pid 
    FROM Product
    where product = '$product_name';";
    $result = $con->query($sql);
    if($result->num_rows <= 0){
        return -1;
    }
    $row = $result->fetch_assoc();
    $pid = $row['pid'];
    return $pid;
}

function getClientId($con,$client_name){
    $sql = "SELECT Client.cid 
    FROM Client
    where cname = '$client_name';";
    $result = $con->query($sql);
    if($result->num_rows <= 0){
        die("getClientId function failed!!!");
    }
    $row = $result->fetch_assoc();
    $cid = $row['cid'];
    return $cid;
}


function isBoughtProduct($con,$pid,$sid){
    $sql = "SELECT Product.cid 
    FROM Product
    where pid = '$pid' AND sid = ".$sid.";";
    $result = $con->query($sql);
    if($result->num_rows <= 0){
        die("<p style='color:red'>Product doesn't exist</p>");
    }
    $row = $result->fetch_assoc();
    $cid = $row['cid'];
    if($cid == 0) return false;
    else return true;
}



//any product that is not bought by a client will have client id as 0
function insertProduct($con,$section_name,Product $product)
{
    $product->sid = getSectionId($con,$section_name);
    $sql = "INSERT INTO Product(sid,cid,product,image_path,price)
    VALUES (".$product->sid.",0,'".$product->product."','".$product->image_path."',".$product->price.");";
    if ($con->query($sql) === TRUE) {
        echo "<p style='color:lightgreen'>product added successfully successfully</p>";
    } 
    else {
        echo "Error adding record: " . $con->error;
    }
}

function updateProduct($con,$section_name,$oldPname,Product $product)
{
    $product->sid = getSectionId($con, $section_name);
    $product->pid = getProductId($con,$oldPname);
    if(isBoughtProduct($con,$product->pid,$product->sid)){
        echo "<h3>Can't delete or edit a product that is already reserved to buy by a customer!</h3>";
        return;
    }
    $sql = "UPDATE Product SET product = '" . $product->product . "' ,image_path = '" . $product->image_path . "', price = '" . $product->price . "'" .
        " WHERE pid = '" . $product->pid . "' AND sid = " . $product->sid . "";
    if ($con->query($sql) === TRUE) {
        echo "product updated successfully";
    } else {
        die("Error updating record: " . $con->error);
    }
}

//return section object  that containe product objects
function ProductsOfSection($con, $section_name)
{
    $sid = getSectionId($con, $section_name);
    $sql = "SELECT pid,product,image_path,price FROM Product
    WHERE sid = $sid;";
    $result = $con->query($sql);
    $section = new Section();
    if ($result->num_rows > 0) {
        $section->products = array();
        while ($row = $result->fetch_assoc()) {
            $product = new Product();
            $product->product = $row['product'];
            $product->image_path = $row['image_path'];
            $product->price = $row['price'];

            $pid = getProductId($con,$product->product);
            if(!isBoughtProduct($con,$row['pid'],$sid)){
                array_push($section->products,$product);
            }
        }
    }
    return $section;
}

function DeleteProduct($con, $section_name,Product $product)
{
    $product->sid = getSectionId($con, $section_name);
    $product->pid = getProductId($con,$product->product);
    if($product->pid == -1){
        echo "<h3 style='color:red'>The product name is not valid please make sure to enter an existing product name!</h3>";
        $con->close();
        return;
    }
    if(isBoughtProduct($con,$product->pid,$product->sid)){
        echo "<h3 style='color:red'>Can't delete or edit a product that is already reserved to buy by a customer!</h3>";
        $con->close();
        return;
    }

    $TogetImg  = "SELECT image_path FROM Product WHERE pid = ".$product->pid.";";
    $result = $con->query($TogetImg);
    $row = $result->fetch_assoc();
    $img = $row['image_path'];
    unlink($img);
    

    $sql = "Delete FROM Product WHERE sid = $product->sid AND product = '" . $product->product . "';";
    if ($con->query($sql) === TRUE) {
        echo "product deleted successfully";
    } else {
        echo "failure: " . $con->error;
    }
}

function ClientLogin(Client $client){
    $con = ConnectToDB('localhost', 'root', '', 'FactoryMarketing');
    if($con == null){
        return null;
    }
    $sql = "SELECT * FROM Client where cname = '" . $client->cname . "' AND cpassword = '" . $client->cpassword. "'";
    $result = $con->query($sql);
    return $result;
}


function LoginAdmin(Admin $admin)
{
    $con = ConnectToDB('localhost', 'root', '', 'FactoryMarketing');
    $sql = "SELECT * FROM Admin where aname = '" . $admin->Aname . "' AND apassword = '" . $admin->Apassword . "'";
    $result = $con->query($sql);
    return $result;
}

function getClientProducts($con,Client $client)
{
    $client->cid = getClientId($con,$client->cname);
    $con = ConnectToDB("localhost", "root", '', "FactoryMarketing");
    $sql = "SELECT * FROM Product 
    WHERE cid = '" . $client->cid . "';";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $client->products = array();
        while ($row = $result->fetch_assoc()) {
            $product = new Product();
            $product->product = $row['product'];
            $product->image_path = $row['image_path'];
            $product->price = $row['price'];

            $pid = getProductId($con,$product->product);
            array_push($client->products,$product);
        }
    }
}

function CreateClientAccount($con,Client $client){

    $check = "SELECT * FROM Client 
    WHERE cname = '".$client->cname."';";

    $result = $con->query($check);

    if($result->num_rows <= 0 ){
        $sql = "INSERT INTO Client(cname,cpassword)
        VALUES ('".$client->cname."','".$client->cpassword."');";
        $con->query($sql);
        $con->close();
        return true;
    }
    return false;
}


function BuyProduct($con,Client $client,Product $product){
    //$client->cid = getClientId($con,$client->cname);
    $product->pid = getProductId($con,$product->product);
    $sql = "UPDATE Product SET cid = ".$client->cid." 
    WHERE pid = ".$product->pid.";";
    $con->query($sql);
}



function AddAdmin($con,Admin $admin){
    $check = "SELECT * FROM ADMIN WHERE aname = '".$admin->Aname."';";
    $result = $con->query($check);
    if($result->num_rows != 0){
        echo "<p style='color:red'>An admin already exist with same name!!!</p>";
        return false;
    }
    $sql = "INSERT INTO ADMIN (aname,apassword,type)
    VALUES ('".$admin->Aname."','".$admin->Apassword."','Admin')";
    if($con->query($sql)) return true;
    else{
        echo  "<p style='color:red'>Sorry a Database operation failure</p>";
        return false;
    }
}


function deleteAdmin($con,Admin $admin){
    $check = "SELECT * FROM ADMIN WHERE aname = '".$admin->Aname."' AND apassword = '".$admin->Apassword."';";
    $result = $con->query($check);
    if($result->num_rows == 0){
        echo "<p style='color:red'>no such name or account</p>";
        return false;
    }
    if($admin->type == 'Super'){
        echo "<p style='color:red'>can't delete a super admin!</p>";
        return false;
    }
    $sql = "DELETE FROM ADMIN WHERE aname = '".$admin->Aname."';";
    if($con->query($sql)) return true;
    else{
        echo  "<p style='color:red'>Sorry a Database operation failure</p>";
        return false;
    }
}