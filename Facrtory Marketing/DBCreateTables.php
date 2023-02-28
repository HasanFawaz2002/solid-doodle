<?php
require_once("DBConnect.php");
$con = ConnectToDB("localhost", "root", "", "FactoryMarketing");


$sql1 = "CREATE TABLE Section (
    sid int NOT NULL AUTO_INCREMENT,
    section varchar(30),
    PRIMARY KEY (sid)
);";

$sql2 = "CREATE TABLE Client (
    cid int NOT NULL AUTO_INCREMENT,
    cname varchar(50) NOT NULL,
    cpassword varchar(50) NOT NULL,
    PRIMARY KEY (cid)
);";

$sql3 = "CREATE TABLE Product (
    pid int NOT NULL AUTO_INCREMENT,
    sid int NOT NULL,
    cid int NOT NULL,
    product varchar(30) NOT NULL,
    image_path varchar(100) NOT NULL, 
    price int NOT NULL,
    PRIMARY KEY (pid),
    CONSTRAINT FK_SectionId FOREIGN KEY (sid)
    REFERENCES Section(sid),
    CONSTRAINT FK_ClientId FOREIGN KEY (cid)
    REFERENCES Client(cid)
);";

$sql4 = "CREATE TABLE Admin (
    aid int NOT NULL AUTO_INCREMENT,
    aname varchar(100) NOT NULL,
    apassword varchar(100) NOT NULL,
    type varchar(100) NOT NULL,
    PRIMARY KEY (aid)
);";






if ($con->query($sql1) === TRUE) {
    echo "Section created successfully<br>";
} else {
    echo "Error creating database: " . $con->error . "<br>";
}

if ($con->query($sql2) === TRUE) {
    echo "Client created successfully<br>";
} else {
    echo "Error creating database: " . $con->error . "<br>";
}

if ($con->query($sql3) === TRUE) {
    echo "Product created successfully<br>";
} else {
    echo "Error creating database: " . $con->error . "<br>";
}

if ($con->query($sql4) === TRUE) {
    echo "Admin created successfully<br>";
} else {
    echo "Error creating database: " . $con->error;
}


$sql = "INSERT INTO Client (cname,cpassword)
Values ('guestClient','guest123')";
if ($con->query($sql) === TRUE) {
    echo "guest client created successfully<br>";
} else {
    echo "Error updating record: " . $con->error;
}


$sql = "UPDATE Client SET cid = 0
         WHERE cid = 1";
    if ($con->query($sql) === TRUE) {
        echo "guest client id updated successfully<br>";
    } else {
        echo "Error updating record: " . $con->error;
    }

$sql = "INSERT INTO ADMIN (aname,apassword,type)
Values ('SuperAdmin','Super123','Super')";
if ($con->query($sql) === TRUE) {
    echo "super admin created successfully<br>";
} else {
    echo "Error updating record: " . $con->error;
}

$statement = "INSERT INTO Section(section)
Values ('Clothes'),('AutoMobiles'),('Electronics'),('Devices'),('HouseStaff')";
if ($con->query($statement) === TRUE) {
    echo "sections added successfully<br>";
} else {
    echo "Error inserting sections record: " . $con->error;
}


$con->close();


