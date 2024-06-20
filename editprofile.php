<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
    <style>
        .edit .container{
        width: 30%;
        height: 550px;
        margin-left: 700px;
        position: absolute;
        top: 0;
        float: right;
        margin-top: 160px;
        background-color: #B79DA9;
        border-radius: 20px;
        }
        .edit .container button{
        margin-left: 165px;
        }
    </style>
</head>
<body>
    <div class="edit">
    <?php 
    include("connection.php");
    include("dashboard.php");
    if(isset($_GET["id"])){
    $id=$_GET["id"];
    $sql="SELECT * FROM user where id='$id'";
    $result=mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
    }
    ?>
    <div class="container">
    <form action="editprofile.php" method="POST" id="input" enctype="multipart/form-data" name="myform">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="form-group">
        <label for="name"><b>Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo $row['fullname'];?>">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $row['email'];?>">
      </div>
      <div class="form-group">
        <label for="phonenumber">Phonenumber</label>
        <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Enter phonenumber"
        value="<?php echo $row['phonenumber'];?>">
      </div>
      <div class="form-group">
        <label for="password">Passsword</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="<?php echo $row['password'];?>">
      </div>
      <div class="form-group">
        <label for="image">Profile Photo</label>
        <img src="<?php echo $row['profilephoto']; ?>" width="80px" height="80px" style="margin-left:15px">
        <input type="file" class="form-control" id="image" name="image"style="margin-top:15px"> 
      </div>
      <button type="submit" class="btn btn-primary" id="submit">Update</button>
        </form>
    </div>
    </div>
    <?php
    if($_SERVER['REQUEST_METHOD']==='POST'){
      $firstname=$_POST['name'];
      $email=$_POST['email'];
      $phone=$_POST['phonenumber'];
      $pass=$_POST['password'];
      $image=$_POST['image'];
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
}
      $sql="UPDATE user SET fullname='$firstname',email='$email',phonenumber='$phone', password='$pass',profilephoto='$target_file' where id='$id'";
      $result=mysqli_query($conn,$sql);
      if ($result === TRUE) {
        header("location:message2.php");
      }else{
      echo "updated not  successfully";
  }
  }
    ?>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       $('#submit').on('click',function(e){
        e.preventDefault();
        var form_data = new FormData(document.getElementById("input"));
        console.log(form_data);
        $.ajax({
          type:'POST',
          url:'editprofile.php',
          data:form_data,
          contentType: false,
          cache: false,
          processData:false,
          success:function(data){
            console.log(data);
            swal.fire({
            title:"Thankyou",
            text:"update successfully",
            icon:"success"}).then(function(){
              window.location.href='message2.php';
          })
          },
          error:function(data){
            swal.fire({
            title:"OOps",
            text:"Update not successfully ",
            icon:"error"}).then(function(){
              window.location.href='message2.php';
            })
          }
        })}
      );
    </script>    
</body>
</html>