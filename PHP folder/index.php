<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 98vh;
            background: repeating-linear-gradient(45deg, #ffffff00, #ffffff33 40px, transparent 80px), radial-gradient(circle at bottom right, #000563 50%, white);
            min-width: 400px;
            min-height: 400px;
        }
        nav{
            margin-top:40px;
            display:flex;
            justify-content: space-evenly;
            width:50%;
        }
        nav a{
            display:inline-block;
            font-family:Math;
            font-size: 1.5rem;
            color: white;
            text-decoration:none;
            transition:1s;
        }
        nav a:hover{
            text-decoration:underline;
        }
        h1{
            margin-top:70px;
            color:white;
            font-family:
        }
    </style>
</head>
<body>
    <nav>
        <a href="index.php">Home page</a>
        <?php if(!(isset($_SESSION['login']))):?>
            <a href="registerPage.php">Register page</a>
        <?php endif;?>
        <?php if(!(isset($_SESSION['login']))):?>
            <a href="loginPage.php">Login page</a>
        <?php endif;?>
        <?php if((isset($_SESSION['login']))):?>
            <a href="logout.php">Logout</a>
        <?php endif;?>
    </nav>
    <h1>hello <?php if((isset($_SESSION['login']))){echo $_SESSION['name'].'!!';}else{echo "world!!";}?></h1>
</body>
</html>