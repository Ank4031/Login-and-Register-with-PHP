<?php
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = new mysqli("localhost", "root", "", "testdb");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * from registeredusers where username = '$username' and password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name']; 
        header("Location: homePage.html?message=sucess&name=$name");
        exit();
    } else {
        header("Location: loginPage.html?message=error");
        exit();
    }

    $conn->close();
?>