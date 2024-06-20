<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true||!isset($_SESSION['user_id'])){
    header("location: login.php");
    exit;
}
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic items </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        *{
            margin: 0px;
            padding: 0px;
        }
        body{
            width: 100%;
            height: 100%;
        }
        .sidebar{
            top: 0;
            width: 20%;
            height: 100vh;
            background-color:#927582 ;
            position: fixed;
        }
        .sidebar ul{
            margin-top: 50px;
        }
        .sidebar ul li{
            margin-top: 50px;
            font-size: 20px;
            margin-left: 78px;
            list-style: none;
            text-decoration: none;   
        }
        .sidebar ul li a{
            text-decoration: none;
            color: white;
        }
        .sidebar ul li a button{
            background-color: #927582;
            padding:10px 10px 10px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .bar{
            top: 0;
            float: right;
            width: 80%;
            height: 90px;
            display: flex; 
            justify-content: center; 
            align-items: center;
            margin-top: 20px;
        }
        .bar ul{
            display:flex;
            margin-left: 900px;
        }
        .bar li{
            list-style: none;  
            margin-right: 20px; 
        } 
    </style>
    <!-- #A0959A
#927582 -->
</head>
<body>
    <?php
    $user_id= $_SESSION['user_id'];
    $navigation="SELECT role_id FROM user WHERE id=$user_id";
    $nav_result=mysqli_query($conn,$navigation);
    if($nav_result->num_rows>0){
        $row = $nav_result->fetch_assoc();
        $role=$row['role_id'];
    
    $sql="SELECT permission FROM roles WHERE id = $role";
    $result = $conn->query($sql);
    if($result){
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            //CONVERT JSON INTO ARRAY:
            $permissions= json_decode($row['permission']) ;
            // print_r($permissions);
            // die();
    ?>
    <div class="sidebar">
        <?php
        foreach ($permissions as $value) {
            $nav_table ="SELECT * FROM navigation where id= $value";
            $navigation_result = $conn->query($nav_table);
            if ($navigation_result->num_rows > 0) {
        ?>
        <ul>
            <?php
            while ($nav_row = $navigation_result->fetch_assoc()){
            ?>
            <li><a href="<?=$nav_row['link']?>.php"><?=$nav_row['name']?></a></li>
            <?php
            }}}
            ?>
            <li><a href="editprofile.php?id=<?php echo $_SESSION['user_id'];?>">Edit Profile</a></li>
            <li><a href="logout.php"><button>Logout</button></a></li>
        </ul>
    </div>
    <?php
    }
}
}

    ?>
    <?php
    $user_id=$_SESSION['user_id'];
    $sql = "SELECT * FROM user WHERE id=$user_id";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

    <div class="bar">
        <nav>
            <ul>
                <li><img src="<?php echo $row['profilephoto']?>" width="90px" height="90px"></li>
                <li><h3><?php echo $row['fullname']?></h3></li>
            </ul>
        </nav>
    </div> 
    <?php
    } else {
        echo "No user found with ID: $user_id";
    }
?>
</body>
</html>