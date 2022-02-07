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


$studentInfo=json_decode($_GET["data"],true); //turn into associative array

    echo "<ul>";
    foreach($studentInfo as $value){
        echo "<li> $value </li>";
    }
    echo "</ul>";
?>