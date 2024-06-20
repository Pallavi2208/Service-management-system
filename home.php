<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Electronic items</title>
    <style>
        *{
            margin:0;
            padding: 0;
            overflow: visible;
        }
        body{
            width: 100%;
            height: 100%;
        }
        .image{
            position: relative;
        }
        .image .image1{
            background-position: center;
            height: 500px;
            margin-bottom: 30px;
            background-repeat: no-repeat;
            background-size: cover;   
        }
        .image .image2{
            position: absolute;
            right: 100px;
            margin-top: 120px;
            width: 500px;
            border-radius: 20px;  
        }
        .image pre{
            position: absolute;
            top: 8px;
            left: 16px;
            margin-top: 150px;
            color: white;
            font-size: 40px;
            margin-left: 150px;
            font-style: italic;
        }

        .image button{
            position: absolute;
            top: 8px;
            left: 16px;
            margin-top: 280px;
            margin-left: 230px;
            padding: 10px 10px 10px 10px;
            border-radius: 15px;
            font-style: italic;
            cursor: pointer;
        }
        h2{
            text-align: center;
        }
        .box{
          float: left;
          margin-bottom: 50px;
          border-style: double;
          margin-right: 5px;
          margin-left: 40px;
          padding: 2px 2px 2px 2px; 
           
        }
        .box img{
          margin:10px 10px 10px 10px;
         
        }
        .box h5{
          margin-left: 150px;
          margin-right: 80px;
         
        }
        .box p{
          margin-left: 150px;
          margin-right: 200px;
         
        }
        .box a{
          margin:0px 0px 10px 150px;
        }
    </style>
  </head>
  <body>
    <?php
    include("navbar.php");
    include("connection.php");
    ?>
    <div class="image">
        <img class="image1" src="/images/background image.jpg" height="" width="100%">
        <img class="image2" src="/images/electric_product.avif" height="50%" width="50%">
        <pre>Latest trending  
Electronic items </pre>
        <a href="products.php"><button>Find more Products</button></a>   
    </div>
    <h2>Services</h2>
    <?php
    $sql="SELECT * FROM services limit 3";
    $result=mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){   
    ?>
    <div class="box">
      <img src="<?=$row['photo']?>" height="300px" width="400px">
      <h5><?=$row['small_desc']?></h5>
      <p>Price:<?=$row['price']?></p>
      <a href="description.php?id=<?php echo $row['id']?>" class='btn btn-primary'>Read more</a>
    </div>
    <?php
      }
    }
    ?>
    <footer>
      <?php include("footer.php")?>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>