<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        .signup .container{
        width: 30%;
        height: 550px;
        margin-left: 550px;
        position: absolute;
        float: right;
        margin-top:120px;
        /* background-color: #B79DA9; */
        border-radius: 20px;
        }
        h3{
            text-align: center;
        }
        .container button{
        margin-left: 165px;
        }
        p{
            margin-left: 120px;
            margin-top: 10px;
        }
    </style>
  </head>
  <body>
    <div class="signup">
    <?php
    include("connection.php");
    if($_SERVER['REQUEST_METHOD']==='POST'){
      $name=$_POST['name'];
      $email=$_POST['email'];
      $phone=$_POST['phonenumber'];
      $pass=$_POST['password'];
      $image=$_POST['image'];
      $role=$_POST['role'];
      $target_dir = "images/";
      $target_file = $target_dir . basename($_FILES['image']['name']);
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
      $sql="INSERT INTO user (fullname,email,role_id,phonenumber,password,profilephoto) VALUES('$name','$email','$role','$phone','$pass','$target_file')";
      $result=mysqli_query($conn,$sql);
      if($result){
        $insert=true;
        echo "inserted";
      }
    }
    ?>
    <div class="container">
    <form action="signup.php" method="POST" id="input" enctype="multipart/form-data">
        <h3>Signup</h3>
      <div class="form-group">
        <label for="name"><b>Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
        <span id="name_error" style="color:red"></span>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        <span id="email_error" style="color:red"></span>
      </div>
      <div class="form-group">
      <label for="role">Role</label>
        <select name="role" id="role">
          <option value="admin">Admin</option>
          <option value="publisher">Publisher</option>
          <option value="author">Author</option>
        </select>
        <span id="role_error" style="color:red"></span>
      </div>
      <div class="form-group">
        <label for="phonenumber">Phonenumber</label>
        <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Enter phonenumber">
        <span id="phone_error" style="color:red"></span>
      </div>
      <div class="form-group">
        <label for="password">Passsword</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
        <span id="pass_error" style="color:red"></span>
      </div>
      <div class="form-group">
        <label for="image">Profile Photo</label>
        <input type="file" class="form-control" id="image" name="image" >
        <span id="image_error" style="color:red"></span>
      </div>
      <a href=""><button class="btn btn-primary" id="submit">Submit</button></a>
      <p>Already signup?<a href="login.php">Login</a></p>
    </form>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      $('#submit').on('click',function(e){
        e.preventDefault(e);
        var form_data = new FormData(document.getElementById("input"));
        console.log(form_data);
        if(validation()){
        $.ajax({
          type:'post',
          url:'signup.php',
          data:form_data,
          contentType: false,
          cache: false,
          processData:false,
          success:function(data){
            swal.fire({title:"Thankyou",text:"Register successfully",icon:"success"}).then(function(){
              window.location.href='login.php';
              
            })
          },
          error:function(data){
            swal.fire({title:'Sorry',text:'Registration is not done',icon:'error'}).then(function(){
              window.location.href='signup.php';
            })
          }
        })
      }});
      function validation(){
      var name = document.getElementById("name");
      var email = document.getElementById("email");
      var role=document.getElementById("role");
      var phonenumber = document.getElementById("phonenumber");
      var password = document.getElementById("password");
      var image = document.getElementById("image");
      var name_error = document.getElementById("name_error");
      var email_error = document.getElementById("email_error");
      var role_error=document.getElementById("role_error");
      var phone_error = document.getElementById("phone_error");
      var pass_error = document.getElementById("pass_error");
      var image_error = document.getElementById("image_error");
      var email_check=/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      var isValid = true;

      if (name.value === "" || name.value == null) {
        name_error.innerHTML = "Name is required";
        isValid = false;
      }
      if (email.value === "" || email.value == null|| !email.value.match(email_check)) {
        email_error.innerHTML = "Enter valid email";
        isValid = false;
      }
      if (role.value === "" || email.value == null) {
        role_error.innerHTML = "Please Choose role";
        isValid = false;
      }
      if (phonenumber.value === "" || phonenumber.value == null) {
        phone_error.innerHTML = "Phone number is required";
        isValid = false;
      }
      if (password.value === "" || password.value == null) {
        pass_error.innerHTML = "Password is required";
        isValid = false;
      }
      if (image.value === "" || image.value == null) {
        image_error.innerHTML = "Please select the image";
        isValid = false;
      }
      return isValid;
    }
    </script>
  </body>
</html>