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
            background-image: url("/images/contactform.avif");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 800px;
            position: relative;
            width: 100%;
        }
        .content h3{
            margin-top: 20px;
            margin-left: 200px;
        }
        .content .container{
            width: 30%;
            /* background-color: blueviolet; */
            margin-left: 100px;
        }
        .content .container button{
            margin-left: 100px;
        }
        footer{
            margin-top: 90px;
        }
    </style>
</head>
<body>
    <?php 
    include("navbar.php");
    include("connection.php");
    if($_SERVER['REQUEST_METHOD']==='POST'){
    $product=$_POST['product'];
    $name=$_POST['fullname'];
    $email=$_POST['email'];
    $phone=$_POST['phoneno'];
    $message=$_POST['msg'];
    $sql = "INSERT INTO contactus (fullname, email, phonenumber,msg_details,product ) VALUES ('$name','$email','$phone','$message','$product')";
    $result=mysqli_query($conn,$sql);
    if($result){
      $insert=true;
    }
  }
    ?>
    <div class="content">
      <h3>Contact us</h3>
      <form  class="container" action="contactus.php" method="POST" id="input" name="Form1" onsubmit="return validationForm()">
        <div class="form-group">
          <label for="product">Select Product</label>
          <select class="form-control" id="product" name="product">
            <option>options</option>
            <option>Laptop</option>
            <option>Tab</option>
            <option>Smart watch</option>
            <option>iPhone</option>
            <option>Headphone</option>
            <option>Speaker</option>
          </select>
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="fullname"  placeholder="Enter name">
          <p></p>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="phoneno">Phoneno.</label>
          <input type="text" class="form-control" id="phoneno" name="phoneno" placeholder="Enter phoneno.">
        </div>
        <div class="form-group">
          <label for="msg">Message</label>
          <textarea class="form-control" id="msg" name="msg" rows="3"></textarea>
        </div>
        <button type="submit"  id="send" class="btn btn-primary">Send Message</button>
      </form>
    </div>
    <footer>
      <?php
      include("footer.php");
      ?>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      $('#send').on('click',function(e){
        e.preventDefault();
        if (validationForm()){
        $.ajax({
          type:'post',
          url:'contactus.php',
          data:$('#input').serialize(),
          success:function(data){
            swal.fire({title:"Thankyou",text:"message send successfully",icon:"success"}).then(function(){
              window.location.href='contactus.php';
          })
          },
          error:function(data){
            swal.fire({title:"OOps",text:"message not send",icon:"error"}).then(function(){
              window.location.href='contactus.php';
            })
          }
        })}
      });

      function validationForm(){
        let product=document.forms["Form1"]["product"].value;
        let name=document.forms["Form1"]["fullname"].value;
        let email=document.forms["Form1"]["email"].value;
        let phone=document.forms["Form1"]["phoneno"].value;
        let message=document.forms["Form1"]["msg"].value;
        if(product==""){
          alert("select product");
          return false;
        }else if(name==""){
          alert("enter name");
          return false;
        }else if(email==""){
          alert("enter email");
          return false;
        }else if(phone==""||phone.length<10){
          alert("enter correct phone number");
          return false;
        }else if(message==""){
          alert("enter message");
          return false;
        }
        return true;
      }
    </script>
</body>
</html>




<!-- <script>
        $('#service').on('click',function(e){
            e.preventDefault();
            $.ajax({
                type:'post',
                url:'services.php',
                data:$('#input').serialize(),
                success:function(data){
                    window.location.href='services.php';
                }
            })
        })
    </script> -->