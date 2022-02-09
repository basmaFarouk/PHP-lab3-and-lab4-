<?php
// put here any action that i nedd to call database
require("db.php");
$db=new db();
$connection=$db->get_connection();
require("student.php");
$student=new Student();


//before db.php file
// try{

//     $connection = new pdo("mysql:host=localhost;dbname=qena2","admin","123");
// }catch(PDOExcption $e){
//     echo $e->getMessage();
// }

//////// ADD ////////
if(isset($_POST['addstudent'])){
$student->fname=$_POST['firstName'];
$student->lname=$_POST['lastName'];
$student->address=$_POST['Address'];
$student->country=$_POST['country'];
$student->gender=$_POST['gender'];
$student->department=$_POST['department'];
$student->email=$_POST['email'];
$student->password=$_POST['password'];
$image=($_POST['img']);

//before student.php file
// $fname=validation($_POST['firstName']);
// $lname=validation($_POST['lastName']);
// $Address=validation($_POST['Address']);
// $country=validation($_POST['country']);
// $gender=validation($_POST['gender']);
// $department=validation($_POST['department']);
// $email=validation($_POST['email']);
// $password=($_POST['password']);
$errors=[];
if(strlen($fname)<3){
    //error
    $errors["fname"]="First Name must be more than 3 char";
}
if(strlen($lname)<3){
    //error
    $errors["lname"]="Last Name must be more than 3 char";
}
if(!filter_var($email,FILTER-VALIDATE-EMAIL)){
    //error
    $errors["email"]="not valid email";
}

if(count($student->errors>0)){
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

try{
    //query
    $cols="firstname='$student->fname', lastname='$student->lname', address='$student->address', gender='$student->gender', department='$student->department', country='$student->country', email='$student->email', image='$image', pass='$student->password' ";
    $db->insert("student",$cols);
    //before db.php file
    //$connection->query("insert into student
    //set firstname='$fname', lastname='$lname', address='$Address', gender='$gender', department='$department', country='$country', email='$email', image='$image' ");

}catch(PDOExcption $e){
    echo $e->getMessage();
}
//close-connection
    $connection=null;
    header("Location:list.php");
}
}
//////// Delete ////////
else if(isset($_GET["delete"])){
//get id from $_GET
$id=$_GET["id"];
try{
    //query
    //$connection->query("delete from student where id = $id");
    $db->delete(student,"id=$id");
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
    //$data=$connection->query("select * from student where id = $id");
    $data=$db->select("*","student","id=$id");
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
        //$data=$connection->query("select * from student where id = $id");
        $data=$db->select("*","student","id=$id");
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
$student->fname=$_GET['firstName'];
$student->lname=$_GET['lastName'];
$student->address=$_GET['Address'];
$student->country=$_GET['country'];
$student->department=$_GET['department'];
$student->email=$_GET['email'];
$student->password=($_GET['password']);


// $fname=$_GET['firstName'];
// $lname=$_GET['lastName'];
// $Address=$_GET['Address'];
// $country=$_GET['country'];
// $department=$_GET['department'];
// $email=$_GET['email'];
// $password=($_GET['password']);

try{
    //query
    $cols="firstname='$student->fname',
    lastname='$student->lname',
    address='$student->address',
    department='$student->department',
    country='$student->country',
    email='$student->email',
    pass='$student->password' ";
 
    $data=$db->update("student",$cols,"id=$id");
    /*$data=$connection->query("update student set
    firstname='$fname',
    lastname='$lname',
    address='$Address',
    department='$department',
    country='$country',
    email='$email'
    where id ='$id'
    ");*/
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
    $conditionlog="email='{$_POST['email']}' and pass={$_POST['password']}";
    //$data=$db->select("*","student","email='{$_POST['email']}' and pass={$_POST['password']}");
    $data=$db->select("*","student",$conditionlog);
    //$data= $connection->query("select * from student where email='{$_POST['email']}' and pass={$_POST['password']}");
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