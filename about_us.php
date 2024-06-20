<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>electronic items</title>
    <style>
        *{
            margin:0px;
            padding:0px;
        }
        body{
            width:100%;
            height:100vh;
            background-image: url("/images/about_us\ background.avif");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            /* overflow: scroll; */
        }
        .container{
            width:300px;
            margin-left: 20px;
            position: absolute;
            margin-top: 70px;
            color: white;
        }
        .container .about {
            margin-left: 20px;
            text-align: justify;
               
        }
        .container .about h2{
            margin-left: 6px; 
            font-size: 30px;  
        }
        .container .about p{
            font-size: 15px;
            width: 50%;
        }
        .container .policy{
            margin-left: 20px;
            font-size: 15px;
           
        }
        .container .policy h2{
            margin-left: 6px; 
            font-size: 30px;
        }
        .container .policy p{
            font-size: 15px;
            width: 50%;    
        }
        .container .services{
            margin-left: 20px;
            font-size: 15px;
            
        }
        .container .services h2{
            margin-left: 6px; 
            font-size: 30px;
        }
        .container .services p{
            font-size: 15px;
            width: 50%;   
        }
        .gartner{
            display: flex;
            margin-left: 50%;
            margin-top: 10%;
            position: absolute;
            width: 45%;
            color: white;
        }
        .gartner .billion{
            margin-right: 145px;
        }
        .gartner .billion p{
            text-align: justify;
            width:150px;
        }
        .gartner .country{
            margin-right: 50px;
        }
        .gartner .country p{
            margin-right: 50px;
            width: 150px;
        }
        .container2{
            position: absolute;
            display: flex;
            margin-left: 50%; 
            margin-top: 20%;
            width: 45%;
            color: white;
        }
        .container2 .offices{
            margin-right:100px;
        }
        .container2 .offices p{
            width: 200px;
        }
        .container2 .experience{
            margin-right: 50px;
        }
        .container2 .experience p{
            width: 150px;
        }

    </style>
    
</head>
<body>
    <?php
    include("navbar.php");
    ?>
    <div class="container">
    <div class="about">
        <h2>About us</h2>
        <p><b>welcome to "www.electronitmes.com"</b></p>
        <p>We are one of the most trusted online store in India for all kinds of Electronic components. We offer wide range of quality products for Hobbyist, Robotic engineers, Students (to build inovative projects) & all other electronic service groups. We believe in making a hassle free shoping to the versitile electronist for all kinds of electronic components.</p>
    </div>
    <div class="policy">
        <h2>Our Policy</h2>
        <p>Offering quality products to the electronists with the best price at your door step (where ever & when ever you need it).</p>
    </div>
    <div class="services">
        <h2>Our Services</h2>
        <p>We focus on availing easy & personlized service for out customers. Your order is processed in a minimal time with atmost care. We have tie-up with major courier suppliers (Fedex, DHL, etc.) to deliver at any part of the world.</p>
    </div>
    </div>
    <div class="gartner">
        <div class="billion">
            <h2>$5B+</h2>
            <p>We are a $5.5 billioncompany and member of the S&P 500.</p>
        </div>
        <div class="country">
            <h2>~90</h2>
            <p>We work with bussiness in nearly 90 countries.</p>
        </div>
    </div>
    <div class="container2">
        <div class="offices">
            <h2>~19,500</h2>
            <p>We have over 19,500 associates in 85 offices globally</p>
        </div>
        <div class="experience">
            <h2>40+</h2>
            <p>Over 40 years providing insight and expert guidance to clients enterprises worldwide</p>
        </div>
    </div>
    </div>
</body>
</html>