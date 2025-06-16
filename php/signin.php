<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['emailAddress'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'agrora');

    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT * FROM user WHERE `emailAddress` = ? AND `password` = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $email;

            if ($email == 'admin@gmail.com') {
                echo '<script> window.location.href = "../admin.php"; </script>';
            } else if ($user['accessPermission'] === 'customer') {
                echo '<script> alert("Logged in as a Customer successfully!"); </script>';
                echo '<script> window.location.href = "../index.php"; </script>';
            } elseif ($user['accessPermission'] === 'supplier') {
                echo '<script> alert("Logged in as a Supplier successfully!"); </script>';
                echo '<script> window.location.href = "../addtoStock.html"; </script>';
            }
            exit();
        } else {
            echo '<script> alert("Invalid email or password!"); </script>';
            echo '<script> window.location.href = "../signinpagewithEmail.html"; </script>';
        }

        $stmt->close();
        $conn->close();
    }
}
