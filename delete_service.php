<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include("connection.php");
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql="DELETE FROM services where id=$id";
    $result=mysqli_query($conn,$sql);
} 
?>  
</body>
</html>
