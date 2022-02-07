<?php
//get id
//connection
//query
//fetch
//print data on screen
//close

$studentInfo=json_decode($_GET["data"],true);
if($_COOKIE["fname"]){
    echo "<h2>Welcome {$_COOKIE['fname']} </h2>";
}else{
    header("Location:login.php");
}
?>

<html>
    <body>
        <form action="studentController.php">
            <input type="hidden" name="id" value="<?= $studentInfo['id']?>">
            <label for="">First Name</label>
            <input type="text" name="firstName" value="<?= $studentInfo['firstname']?>"><br>
            <label for="">Last Name</label>
            <input type="text" name="lastName" value="<?= $studentInfo['lastname']?>"><br>
            <label for="">Address</label>
            <input type="text" name="Address" value="<?= $studentInfo['address']?>"><br>
            <label for="">Country</label>
            <select name="country" id="" value="<?= $studentInfo['country']?>">
                <option value="egypt">Egypt</option>
                <option value="tounes">tounes</option>
                <option value="libya">libya</option>
            </select><br>

            <label for="">Department</label>
            <input type="text" name="department" value="<?= $studentInfo['department']?>"><br>

            <input type="submit" value="Update Student" name="update">

        </form>

    </body>
</html>