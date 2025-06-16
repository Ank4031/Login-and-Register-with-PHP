<?php

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql0 = "SELECT * from registeredusers where username = '$username'";
$result = $conn->query($sql0);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username']; 
    header("Location: registerPage.html?message=taken&username=$username");
    exit();
} else {
    $sql = "INSERT INTO registeredusers (name, username, email, password)
        VALUES ('$name','$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: loginPage.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>