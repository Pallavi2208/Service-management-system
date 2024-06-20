<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>edit service</title>
    <style>
        #create_service .container{
        width: 30%;
        height: 550px;
        margin-left: 500px;
        position: absolute;
        top: 0;
        float: right;
        margin-top: 120px;
        background-color: #B79DA9;
        border-radius: 20px;
        }
        .container button{
        margin-left: 165px;
        }
    </style>
</head>
<body>
<div id="create_service">
    <?php
    include("connection.php");
    if(isset($_GET["id"])){
        $id=$_GET["id"];
        $sql="SELECT * FROM services where id='$id'";
        $result=mysqli_query($conn,$sql);
        $row = $result->fetch_assoc();
        }
?>

    <div class="container">
        <form action="edit_service.php" method="POST" id="input" enctype="multipart/form-data" name="myform">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="small_desc"><b>Service</label>
                <input type="text" class="form-control" id="small_desc" name="small_desc" value="<?=$row['small_desc']?>">
                <span id="service_error" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="<?=$row['price']?>">
                <span id="price_error" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="large_desc">Description</label>
                <textarea class="form-control" id="large_desc" name="large_desc" rows="5"><?=$row['large_desc']?></textarea>
                <span id="desc_error" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="image">Upload image</label>
                <img src="<?=$row['photo'];?>" width="100px" height="100px">
                <input type="file"  id="image" name="image">
                <span id="image_error" style="color:red"></span>
            </div>
            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>  
    </div>
    <?php
    if($_SERVER['REQUEST_METHOD']==='POST'){
      $service=$_POST['small_desc'];
      $price=$_POST['price'];
      $large_desc=$_POST['large_desc'];
      $id =$_POST['id'];
      $target_dir = "images/";
      $target_file = $target_dir .basename($_FILES['image']['name']);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}
if ($uploadOk == 1) {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
  } else {
      echo "Sorry, there was an error uploading your file.";
  }
  $stmt = $conn->prepare("UPDATE services SET small_desc=?, price=?, large_desc=?, photo=? WHERE id=?");
    $stmt->bind_param("ssssi", $service, $price, $large_desc, $target_file, $id);
    if ($stmt->execute()) {
        header("location:services.php");
    } else {
        echo "Update not successful";
    }
    $stmt->close();
}
    }
    ?>    
</body>
</html>
