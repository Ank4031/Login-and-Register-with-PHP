<?php
session_start();
if((isset($_SESSION['login']))){
    header("Location: index.php");
    exit();
}
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
        .regForm{
            margin-top: 40px;
            padding: 30px;
            background-color: #ffffff73;
            border-radius: 30px;
        }
        h2{
            font-family:Math;
            margin-bottom:30px;
        }
        form{
            display: flex;
        }
        form .b1{
            margin-right:20px;
            margin-left:20px;
        }
        form .b1 label{
            display:inline-block;
            height:35px;
            margin-bottom: 4px;
            font-weight:bold;
            font-family:Math;
            font-size: 1.2rem;
        }
        form .b2{
            width:350px;
            text-align: center;
        }
        form .b2 input{
            height:27px;
            width: 270px;
            padding-left:10px;
            margin-bottom:10px;
            border-radius:10px;
            border:none;
            outline: none;
        }
        form .b2 input:hover{
            box-shadow: 3px 3px 3px 1px black;
        }
        #submit{
            text-align:center;
            width: 80px;
            height: 30px;
            font-family: Math;
            font-weight: bold;
            font-size: 1.1rem;
            margin-right: 100px;
            transition:0.5s;
        }
        #submit:hover{
            box-shadow: 4px 4px 3px 2px black;
        }
        .regForm h2{
            text-align:center;
        }
        .message{
            color:red;
        }
    </style>
</head>
<body>
    <nav>
        <a href="index.php">Home page</a><a href="registerPage.php">Register page</a><a href="loginPage.php">Login page</a>
        <?php if((isset($_SESSION['login']))):?>
            <a href="logout.php">Logout</a>
        <?php endif;?>
    </nav>
    <div class="regForm">
        <h2>REGISTER FORM...</h2>
        <form action="" method="post">
            <div class='b1'>
                <label>Name:</label><br>
                <label>Username:</label><br>
                <label>Email:</label><br>
                <label>Password:</label><br>
                <label>Confirm:</label>
            </div>
            <div class='b2'>
                <input type="text" name='name' placeholder='Name' required><br>
                <input type="text" name='uname' placeholder='Username' required><br>
                <input type="text" name='email' placeholder='Email' required><br>
                <input type="password" name='passwd' placeholder='password' required><br>
                <input type="text" name='confirmPasswd' placeholder='confirm Password' required><br>
                <input type="hidden" name="task" value="reg"><br>
                <input id='submit' type="submit" Value='Submit'>
            </div>
        </form>
    </div>
    
    <div class="message">

    </div>
</body>
<script>
    document.querySelector('form').addEventListener("submit",function(e){
        e.preventDefault();
        const formData = new FormData(this);
        fetch("checks.php",{
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(data=>{
            console.log(data);
            
            if (data == "registered"){
                document.querySelector(".message").innerHTML = `<h2>logged in</h2>`;
            }else if (data == "invalidUname"){
                document.querySelector(".message").innerHTML = `<h2>Username should only have alphabets and numbers</h2>`;
            }else if (data == "usedUname"){
                document.querySelector(".message").innerHTML = `<h2>Username already in use!!</h2>`;
            }else if (data == "usedEmail"){
                document.querySelector(".message").innerHTML = `<h2>Email already in use!!</h2>`;
            }else if (data == "passwdMissMatched"){
                document.querySelector(".message").innerHTML = `<h2>Password didn't match !!</h2>`;
            }else if (data == "emptyFeild"){
                document.querySelector(".message").innerHTML = `<h2>Empty feilds are not Accepted !!</h2>`;
            }
        })
    })
</script>
</html>