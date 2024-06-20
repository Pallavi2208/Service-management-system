<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Hello, world!</title>
    <style>
        #create_service .container{
        width: 30%;
        height: 500px;
        margin-left: 700px;
        position: absolute;
        top: 0;
        float: right;
        margin-top: 160px;
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
    include("dashboard.php");
    if($_SERVER['REQUEST_METHOD']==='POST'){
    $small_desc=$_POST['small_desc'];
    $price=$_POST['price'];
    $description=$_POST['large_desc'];
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
        $sql="INSERT INTO services (small_desc,price,large_desc,photo) VALUES ('$small_desc','$price','$description','$target_file')";
        $result=mysqli_query($conn,$sql);
     }
?>

    <div class="container">
        <form action="create_service.php" method="POST" id="input" enctype="multipart/form-data" name="myform" onsubmit="return validation()">
            <div class="form-group">
                <label for="small_desc"><b>Service</label>
                <input type="text" class="form-control" id="small_desc" name="small_desc">
                <span id="service_error" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price">
                <span id="price_error" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="large_desc">Description</label>
                <textarea class="form-control" id="large_desc" name="large_desc" rows="6"></textarea>
                <span id="desc_error" style="color:red"></span>
            </div>
            <div class="form-group">
                <label for="image">Upload image</label>
                <input type="file"  id="image" name="image">
                <span id="image_error" style="color:red"></span>
            </div>
            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>  
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      $('#submit').on('click',function(e){
        e.preventDefault();
var form_data = new FormData(document.getElementById("input"));
console.log(form_data);
if (validation()){
        $.ajax({
          type:'POST',
          url:'create_service.php',
          data:form_data,
          contentType: false,
          cache: false,
          processData:false,
          success:function(data){
            console.log(data);
            swal.fire({
            title:"Thankyou",
            text:"product add successfully",
            icon:"success"}).then(function(){
              window.location.href='create_service.php';
          })
          },
          error:function(data){
            swal.fire({
            title:"OOps",
            text:"services not added",
            icon:"error"}).then(function(){
              window.location.href='create_service.php';
            })
          }
        })}
      });
      function validation() {
      var service = document.getElementById("small_desc");
      var price = document.getElementById("price");
      var desc = document.getElementById("large_desc");
      var image = document.getElementById("image");
      var service_error = document.getElementById("service_error");
      var price_error = document.getElementById("price_error");
      var desc_error = document.getElementById("desc_error");
      var image_error = document.getElementById("image_error");
      var img_ext=["jpg","jpeg","avif","webp","png"];
      let filename=image.value;
      var extension=filename.split('.');
      var isValid = true;
      if (service.value === "" || service.value == null) {
        service_error.innerHTML = "Service name is required";
        isValid = false;
      }
      if (service.value.length>10) {
        service_error.innerHTML = "Service name must be in 10 character";
        isValid = false;
      }
      if (price.value === "" || price.value == null) {
        price_error.innerHTML = "Price is required";
        isValid = false;
      }
      if (price.value.length>6){
        price_error.innerHTML = "Price must be  6 digit";
        isValid = false;
      }
      if(isNaN(price.value)){
        price_error.innerHTML="Price must be in number";
        isValid=false;
      }
      if (desc.value === "" || desc.value == null){
        desc_error.innerHTML = "Description is required";
        isValid = false;
      }
      if (desc.value.length>800){
        desc_error.innerHTML = "Description length is greater then 500 character";
        isValid = false;
      }
      if (filename === "" || filename == null) {
        image_error.innerHTML = "Please select the image";
        isValid = false;
      }
      if(!img_ext.includes(extension[1])){
        image_error.innerHTML="Not a valid image";
        isvalid=false;
      }
      return isValid;
    }
    </script>
  </body>
</html>