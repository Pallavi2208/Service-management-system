<?php session_start();?>
<?php 
    include('connection.php');
    $login=false;
    $showerror=false;
    if($_SERVER['REQUEST_METHOD']==='POST'){
    $email=$_POST['email'];
    $password= $_POST['pass'];
    $sql="SELECT * FROM user where email='$email' AND password='$password'";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num==1){
    $row = mysqli_fetch_assoc($result);
      $login=true;
      $_SESSION['loggedin'] = true;
      $_SESSION["email"]=$email;
      $_SESSION["password"]=$password;
      $_SESSION['user_id'] = $row['id'];
      echo "success";
      exit();
    }else{
      $showerror = "Invalid Credentials";
      echo "error";
      exit();
  }
    }
    ?>
<!DOCTYPE html>
<html lang="en">

  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>login</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        .container{
            margin-top: 150px;
            width: 400px;
            height: 350px;
            border-radius: 10px;
        }
        h3{
            text-align: center;
        }
        button{
            margin-left: 150px;
            margin-top: 30px;
            /* width: 150px; */
        }
        p{
            margin-left: 100px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST" id="input">
            <h3>Login</h3>
            <div class="form-group">
                <label for="email"><b>Email</label>
                <input type="email" class="form-control" id="email" name="email"  placeholder="Enter email">
                <span id="email_error" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                <span id="pass_error" style="color:red"></span>
            </div>
            <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Submit</button>    -->
            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
            <p>Not a member?<a href="signup.php">Signup</a></p>
        </form>
    </div>
  
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#submit').on('click',function(e){
        e.preventDefault();
        if (validation()){
          $.ajax({
          type:'POST',
          url:'login.php',
          data: $('#input').serialize(),
          success:function(data){
            console.log(data);
            if (data.trim() == 'success'){
                    swal.fire({
                        title: "Thankyou",
                        text: "Login successfully",
                        icon: "success"
                    }).then(function() {
                        window.location.href = 'message2.php';
                    })
                } else {
                    swal.fire({
                        title: "OOps",
                        text: "Not login",
                        icon: "error"
                    }).then(function() {
                        window.location.href = 'login.php';
                    })
                }
            },
            error: function(data) {
                swal.fire({
                    title: "OOps",
                    text: "Not login 69999",
                    icon: "error"
                }).then(function() {
                    window.location.href = 'login.php';
                })
            }
        })
    }
});
      function validation() {
      var email = document.getElementById("email");
      var password = document.getElementById("pass");
      
      var email_error = document.getElementById("email_error");
      var pass_error = document.getElementById("pass_error");

      var email_check=/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      
      var isValid = true;

      if (email.value === "" || email.value == null|| !email.value.match(email_check)) {
        email_error.innerHTML = "Enter email";
        isValid = false;
      }
      if ( !email.value.match(email_check)) {
        email_error.innerHTML = "Enter valid email";
        isValid = false;
      }
      if (password.value === "" || password.value == null) {
        pass_error.innerHTML = "Password is required";
        isValid = false;
      }
       
      return isValid;
    }

    </script>  
</body>
</html>   