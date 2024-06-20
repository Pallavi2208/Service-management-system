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
            /* overflow: hidden; */
        }
        body{
            width: 100%;
            height: 100%;
        }
        .image{
            float: right;
            margin-top: 10px;
            margin-right: 20px;
        }
        .description{
            font-size: 18px;
            width: 700px;
            /* text-align: center; */
            margin-top: 50px;
            margin-left: 50px; 
             
        }
        .small_description{
            font-size: 20px;
            font-weight: bold;
            margin-top: 30px;
            margin-left: 300px;
        }
        .price{
            font-size: 20px;
            margin-left: 48px;
        }
        
    </style>
</head>
<body>
    <?php
    include("connection.php");
    include("navbar.php");
    $id=$_GET['id'];
    $sql="SELECT * FROM services where id='$id'";
    $result=mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
    ?>
    <div class="small_description"><?=$row['small_desc']?></div>
    <div class="image"><img src="<?=$row['photo']?>" width="600px"></div>
    <div class="description"><?php echo $row['large_desc']?></div>
    <div class="price"><b>Price:</b><?=$row['price']?></div>
    <?php
        }
    }
    ?>
    
    
</body>
</html>