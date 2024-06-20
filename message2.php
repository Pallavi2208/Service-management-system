<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>dashoboard</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        .container{
            width: 80%;
            margin-top:px;
        }
        .table{
            width: 70%;
            margin-top:0px; 
            margin-left: 160px;
            padding: 5px;
            height: 300px;
            
        }
        .table th{
            width: 20px;
            padding: 5px;
            font-size: 13px;
            text-align: center;
            padding: 20px;
            background-color:#927582;
            
        }
        .table td{
            text-align: center;
            padding: 1px; 
            font-size: 13px;
            font-weight: normal;
            border:1px solid white ;
            background-color: #E0C9D4;
        }
        .delete-button {
            text-align: center;
            margin-top: 10px;
            margin-left: 900px;
            margin-bottom: 0%; 
        }
        .delete-button button {
            margin: 2px;
            padding: 8px 8px;
            border: none;
            border-radius: 5px;
            background-color: #927582;
            color: white;
            cursor: pointer;   
        }
        .delete-button button:hover {
            background-color: #6d576d;
        }
        .paging {
            top: 0;
            display: flex;
            justify-content: center;
            margin-left: 150px;
    }
    .paging a {
        display: inline-block;
        padding: 5px 10px;
        margin: 0 10px;
        margin-bottom:10px;
        background-color: #927582;
        color: white;
        text-decoration: none;
        border-radius: 3px;
    }
    .paging a:hover {
        background-color: #6d576d;
    }
    .filter{
        display: flex;
        margin-left: 350px;
    }
    </style>

</head>
<body>
    <?php
    include("dashboard.php");
    include("connection.php");
    $total_record_per_page=5;
    if(isset($_GET["page_no"]) && $_GET["page_no"] != "") {
        $page_no=$_GET["page_no"];
    }else{
        $page_no=1;
    }
    $offset = ($page_no-1) * $total_record_per_page;
    $result=mysqli_query($conn,"SELECT * FROM contactus LIMIT $offset, $total_record_per_page");
    if ($result->num_rows > 0){
    ?>
    <form action="" method="GET">
        <div class="filter">
            <div class="form-group">
            <label for="">From</label>
            <input type="date" name="from_date" id="from_date" class="from-control">
            </div>
            <div class="form-group">
            <label for="">To</label>
            <input type="date" name="to_date" id="to_date" class="from-control" value="<?php if(isset($_GET['from_date'])){echo isset($_GET['from_date']);}?>">
            </div>
            <div class="form-group">
                <label for=""></label>
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
    <form action="" method="POST" id="deleteform">
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Message</th>
                    <th>Product</th>
                    <th>Date</th>
                    <th><button type="submit" id="delete" type="button" name="delete" style="border-radius:5px; padding:2px 2px 2px 2px;cursor:pointer;">Delete</button></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_GET['from_date'])&& isset($_GET['to_date']))
                {
                    if(strtotime($_GET['from_date'])<strtotime($_GET['to_date'])){
                    $from_date=$_GET['from_date'];
                    $to_date=$_GET['to_date'];
                    $sql="SELECT * FROM contactus WHERE date BETWEEN '$from_date' AND '$to_date'";
                    $result=mysqli_query($conn,$sql);
                    if($result->num_rows>0){
                        foreach($result as $row){
                            ?>
                            <tr>
                                <td><?php echo $row['id']?></td>
                                <td><?php echo $row['fullname']?></td>
                                <td><?php echo $row['email']?></td>
                                <td><?php echo $row['phonenumber']?></td>
                                <td><?php echo $row['msg_details']?></td>
                                <td><?php echo $row['product']?></td>
                                <td><?php echo $row['date']?></td>
                                <td><input type="checkbox" name="delete_data[]" class="checkbox" id="delete" value="<?php echo $row['id'] ?>"></td>
                            </tr>
                            <?php
                        }
                    }
                    else{
                        echo "Not found";
                    }
                }
                else{
                    echo "<p style='color:red; margin-left:170px'>" ."From date is grater then to date .Please enter correct date"."</p>";
                    
                }
            }
                ?>
                <?php
                while($row = $result->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row['id']?></td>
                        <td><?php echo $row['fullname']?></td>
                        <td><?php echo $row['email']?></td>
                        <td><?php echo $row['phonenumber']?></td>
                        <td><?php echo $row['msg_details']?></td>
                        <td><?php echo $row['product']?></td>
                        <td><?php echo $row['date']?></td>
                        <td><input type="checkbox" name="delete_data[]" class="checkbox" id="delete" value="<?php echo $row['id'] ?>"></td>
                        <?php
                        }
                        ?>
                    </tr>
            </tbody>
        </table>
        <div class="delete-button">
                <button type="button" id="clear">Clear All</button> 
                <button type="button" id="select">Select all</button> 
            </div>
        </div>
    </form>
    <?php
    }
    ?>
    <?php
    if(isset($_POST['delete_data']) && !empty($_POST['delete_data'])){
        foreach($_POST['delete_data'] as $id){
            $sql ="DELETE FROM contactus where id='$id'";
            $result = mysqli_query($conn,$sql);
        }
    }
    ?>
    <div class="paging">
    <?php
    $sql="SELECT COUNT(id) AS total_record FROM contactus";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_record = $row['total_record'];
    $total_no_of_pages = ceil($total_record / $total_record_per_page);
    echo "<div style='padding: 30px 650px 0px;margin-left:180px;display:flex;'>";
    for($i = 1; $i <= $total_no_of_pages; $i++){
        echo "<b> <a  href='message2.php?page_no=".$i."'> ".$i."</a></b>";
    }
    echo "</div>";
    ?>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script> 
        $(document).on('click',' #select', function () {
            var checkboxes = document.querySelectorAll('.checkbox');
            checkboxes.forEach(function(checkbox){
            checkbox.checked = true;
            });
        });
        $(document).on('click',' #clear', function () {
            var checkboxes = document.querySelectorAll('.checkbox');
            checkboxes.forEach(function(checkbox){
            checkbox.checked = false;
            });
        });
    </script>
    <script>
    $("#delete").on('click',function(e) {
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
                    type: 'POST',
                    url: 'message2.php',
                    data: $('#deleteform').serialize(),
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
    });;
    </script>    
</body>
</html>