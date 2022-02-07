<?php
// put here any action that i nedd to call database


try{

    $connection = new pdo("mysql:host=localhost;dbname=qena2","admin","123");
}catch(PDOExcption $e){
    echo $e->getMessage();
}

//////// ADD ////////
if(isset($_POST['addstudent'])){
$fname=validation($_POST['firstName']);
$lname=validation($_POST['lastName']);
$Address=validation($_POST['Address']);
$country=validation($_POST['country']);
$gender=validation($_POST['gender']);
$department=validation($_POST['department']);
$email=validation($_POST['email']);
$image=($_POST['img']);
$errors=[];
if(strlen($fname)<3){
    //error
    $errors["fname"]="First Name must be more than 3 char";
}
if(strlen($lname)<3){
    //error
    $errors["lname"]="Last Name must be more than 3 char";
}
// if(!filter_var($email,FILTER-VALIDATE-EMAIL)){
//     //error
//     $errors["email"]="not valid email";
// }

if(count($errors>0)){
    $errorArray=json_encode($errors);
    header("Location:addstudent.php?error=$errorArray");
}
$imgextension=pathinfo($_FILES["img"]["tmp_name"],PATHINFO_EXTENSION);
$allowedExten=["png","jpg"];
if(!in_array($imgextension,$allowedExten)){
    $errors["img_extention"]="allowed extention are jpg and png";

}

if(!move_uploaded_file($_FILES["img"]["tmp_name"],"imgs/".$_FILES["img"]["name"])){
    $errors["img"]="Failed to upload image";
}
else{
//upload img on server

    move_uploaded_file($_FILES["img"]["tmp_name"],"imgs/".$_FILES["img"]["name"]);

/*try{
    //query
    $connection->query("insert into student
    set firstname='$fname', lastname='$lname', address='$Address', gender='$gender', department='$department', country='$country', email='$email', image='$image' ");

}catch(PDOExcption $e){
    echo $e->getMessage();
}
//close-connection
    $connection=null;
    header("Location:list.php");*/
}
}
//////// Delete ////////
else if(isset($_GET["delete"])){
//get id from $_GET
$id=$_GET["id"];
try{
    //query
    $connection->query("delete from student where id = $id");
    header("Location:list.php");
}catch(PDOExcption $e){
    echo $e->getMessage();
}

//close
$connection=null;
}
//////// Show ////////
else if(isset($_GET["show"])){

    $id=$_GET["id"];

try{
    //query
    $data=$connection->query("select * from student where id = $id");
    $studentInfo=$data->fetch(PDO::FETCH_ASSOC); //associative array
    $data=json_encode($studentInfo); //حولتها عشان اقدر ابعتها 
    header("Location:show.php?data=$data");
}catch(PDOExcption $e){
    echo $e->getMessage();
}

//close
$connection=null;

}
//////// Edit ////////
else if(isset($_GET["edit"])){


    $id=$_GET["id"];

    try{
        //query
        $data=$connection->query("select * from student where id = $id");
        $studentInfo=$data->fetch(PDO::FETCH_ASSOC); //associative array
        $data=json_encode($studentInfo); //حولتها عشان اقدر ابعتها 
        header("Location:edit.php?data=$data");
    }catch(PDOExcption $e){
        echo $e->getMessage();
    }
    
    //close
    $connection=null;

}
//////// Update ////////
else if(isset($_GET["update"])){

$id=$_GET["id"];
$fname=$_GET['firstName'];
$lname=$_GET['lastName'];
$Address=$_GET['Address'];
$country=$_GET['country'];
$department=$_GET['department'];
$email=$_GET['email'];

try{
    //query
    $data=$connection->query("update student set
    firstname='$fname',
    lastname='$lname',
    address='$Address',
    department='$department',
    country='$country',
    email='$email'
    where id ='$id'
    ");
    header("Location:list.php");

}catch(PDOExcption $e){
    echo $e->getMessage();
}

//close
$connection=null;
}


function validation($data){
    $data=htmlspecialchars(stripcslashes(trim($data)));
    return $data;
}

///Login/////
if(isset($_POST["login"])){
    $data= $connection->query("select * from student where email='{$_POST['email']}' and pass={$_POST['password']}");
    if($data){
        $studentInfo=$data->fetch(PDO::FETCH_ASSOC);
        setcookie("fname",$studentInfo["firstname"]);
        session_start();
        $_SESSION["password"]=$studentInfo["pass"];
        header("Location:list.php");
    }else{
        header("Location:login.php");
    }
}

?>