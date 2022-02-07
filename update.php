<?php
//get id
//connection
//query
//fetch
//print data on screen
//close
if($_COOKIE["fname"]){
    echo "<h2>Welcome {$_COOKIE['fname']} </h2>";
}else{
    header("Location:login.php");
}
$id=$_GET["id"];
$fname=$_GET['firstName'];
$lname=$_GET['lastName'];
$Address=$_GET['Address'];
$country=$_GET['country'];
$department=$_GET['department'];


try{
    //connection
    $connection = new pdo("mysql:host=localhost;dbname=qena2","admin","123");

    //query
    $data=$connection->query("update student set
    firstname='$fname',
    lastname='$lname',
    address='$Address',
    department='$department',
    country='$country'
    where id ='$id'
    ");
    header("Location:list.php");

}catch(PDOExcption $e){
    echo $e->getMessage();
}

//close
$connection=null;




?>