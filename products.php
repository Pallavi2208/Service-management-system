<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic items</title>
    <style>
        *{
            margin: 0px;
            padding: 0px;
        }
        body{
            width: 100%;
            height: 100%;
        }
        .products1{
            float:left;
            margin-left: 90px;
            margin-top: 100px;
            width: 25%;
            border-style: double;
            margin-bottom: 50px;
            padding: 2px 2px 2px 2px; 
        }
        .products1 img{
            margin:10px 10px 10px 10px;  
        }
        .products1 h5{
            margin-left: 150px;
            margin-right: 80px;   
        }
        .products1 p{
            margin-left: 150px;
             margin-right: 200px;
        }
        .products1 a{
            margin:0px 0px 10px 150px;
        }
    </style>
</head>
<body>
    <?php
    include("navbar.php");
    include("connection.php");
    $sql="SELECT * FROM services";
    $result=mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){ 
    ?>
    <div class="products1">
        <img src="<?=$row['photo']?>"height="300px" width="350px">
        <h5><?=$row['small_desc']?></h5>
        <p>Price:<?=$row['price']?></p>
        <a href="description.php?id=<?php echo $row['id']?>" class='btn btn-primary'>Read more</a>
    </div>
    <?php
    }
}?>
<footer>
    <?php include("footer.php")?>
</footer>   
</body>
</html>