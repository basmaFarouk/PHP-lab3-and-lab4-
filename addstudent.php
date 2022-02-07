<?php

if(isset($_GET['error'])){
    $errors=json_decode($_GET['error']);
}
if($_COOKIE["fname"]){
    echo "<h2>Welcome {$_COOKIE['fname']} </h2>";
}else{
    header("Location:login.php");
}


?>



<html>
    <body>
        <form method ="post" enctype="multipart/form-data" action="studentController.php">
            <label for="">First Name</label>
            <input type="text" name="firstName">
            <?php if(isset($errors->fname)){
                echo $errors->fname;
            }?><br>
            <label for="">Last Name</label>
            <input type="text" name="lastName">
            <?php if(isset($errors->lname)){
                echo $errors->lname;
            }?><br>
            <label for="">Address</label>
            <input type="text" name="Address"><br>
            <label for="">Email</label>
            <input type="text" name="email">
            <?php if(isset($errors->email)){
                echo $errors->email;
            }?><br>
            <label for="">Country</label>
            <select name="country" id="">
                <option value="egypt">Egypt</option>
                <option value="tounes">tounes</option>
                <option value="libya">libya</option>
            </select><br>
            <label for="">Gender</label>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br>

            <!-- <label for="">Skills</label>
            <input type="checkbox" id="PHP" name="skill[]" value="PHP">
            <label for="PHP"> PHP</label>
            <input type="checkbox" id="J2se" name="skill[]" value="j2se">
            <label for="J2se">J2SE</label><br>
            <input type="checkbox" id="mysql" name="skill[]" value="myaql">
            <label for="mysql">MYSQL</label>
            <input type="checkbox" id="postgreesql" name="skill[]" value="postgreesql">
            <label for="postgreesql">Postgreesql</label><br> -->
<!-- 
            <label for="">Username</label>
            <input type="text" name="username"><br>
            <label for="">Password</label>
            <input type="password" name="password"><br> -->
            <label for="">Department</label>
            <input type="text" name="department"><br>
            <input type="file" name="img">
            <input type="submit" value="Add User" name="addstudent">
            <input type="reset" value="Reset">


        </form>

    </body>
</html>