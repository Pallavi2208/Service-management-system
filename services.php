<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <style>
        .service .container{
            width:70%;
            margin-left:400px;   
        }
    </style>
</head>
<body>
    <div class="service">
        <?php
        include("connection.php");
        include("dashboard.php");
        
        $sql="SELECT * FROM services";
        $result=mysqli_query($conn,$sql);
        if($result->num_rows>0){
        ?>
        <!-- <form action="" method="post" id="form"> -->
            <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while($row = $result->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row['id']?></td>
                        <td><img src="<?= $row['photo']?>" width="150px" height="150px"></td>
                        <td><?php echo $row['small_desc']?></td>
                        <td><?php echo $row['price']?></td>
                        <td><?php echo $row['large_desc']?></td>
                        <td><a href="edit_service.php?id=<?=$row['id']?>"><button class="btn btn-primary" style="margin-bottom:10px">Edit</button></a>
                        <form action="delete_service.php" method="get" id="delete">
                        <input type="hidden" name="id" value="<?=$row['id']?>">
                        <button type="submit"  class="btn btn-danger" id="deletedata">Delete</button>
                        </form>
                        </td>
                        <?php
                        }
                        ?>
                    </tr>
            </tbody>
            </table>
        </div>
    </div>
    <?php
    }
    ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $("#deletedata").on('click',function(e) {
      e.preventDefault();
      Swal.fire({
      title: "Are you sure?",
      text: "You will not be able to recover this data again!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel",
         })
        .then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              type: 'GET',
              url: 'delete_service.php',
              data: $('#delete').serialize(),
              success: function(data) {
              Swal.fire({
                title: "Deleted",
                text: "Your file has been deleted",
                icon: "success",
              }).then(function(){
                location.reload();
              })
              
            },
          error: function(data) {
            Swal.fire({
              title: "Error",
              text: "An error occurred while deleting the data",
              icon: "error",
            });
          }
        });
      }
    });
  });
;
</script> 
    
    
</body>
</html>