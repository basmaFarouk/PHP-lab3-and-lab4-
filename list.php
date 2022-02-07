<html>
    <body>
        <?php
        session_start();
            if($_COOKIE["fname"]){
                echo "<h2>Welcome {$_COOKIE['fname']} </h2>";
            }else{
                header("Location:login.php");
            }
            echo $_SESSION["password"];
        
        ?>
        <a href="addstudent.php">Add Student</a>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Department</th>
                <th>Country</th>
                <th>Email</th>
            </tr>

<?php

try{

    $connection = new pdo("mysql:host=localhost;dbname=qena2","admin","123");

    //query
    $data=$connection->query("select * from student"); //return object(PDOStatment) so use fetch
    
    while($row=$data->fetch(PDO::FETCH_ASSOC)){ //طول ما في داتا اعملي فيتش وحط الداتا دي في الرو
        echo "<tr>";
            foreach($row as $value){
                echo "<td> $value </td>";
            }
            echo "<td><a href='studentController.php?id={$row['id']}&edit'>Edit</a></td>";
            echo "<td><a href='studentController.php?id={$row['id']}&show'>Show</a></td>";
            echo "<td><a href='studentController.php?id={$row['id']}&delete'>Delete</a></td>";
        echo "</tr>";
    } //turn into associative array //FETCH_ASSOC is a static variable
    

}catch(PDOExcption $e){
    echo $e->getMessage();
}
//close-connection
    $connection=null;


?>

</table>
</body>
</html>