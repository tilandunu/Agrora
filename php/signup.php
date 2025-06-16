<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $mNumber = $_POST['phoneNumber'];
    $pAddress = $_POST['postalAddress'];
    $email = $_POST['emailAddress'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $accessPermission = $_POST['accessPermission'];

    if ($password !== $confirmPassword) {
        echo '<script> alert("Password and Confirm password do not match!"); </script>';
        echo '<script> window.location.href = "../signuppagewithEmail.html"; </script>';
    } else {
        $conn = new mysqli('localhost', 'root', '', 'agrora');

        if ($conn->connect_error) {
            die('Connection Failed : ' . $conn->connect_error);
        } else {
            $checkStmt = $conn->prepare("SELECT * FROM user WHERE `emailAddress` = ?");
            $checkStmt->bind_param("s", $email);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                echo '<script> alert("Email address is already in use!"); </script>';
                echo '<script> window.location.href = "../signuppagewithEmail.html"; </script>';
                exit();
            }

            $stmt = $conn->prepare("INSERT INTO user (`firstName`, `lastName`, `phoneNumber`, `postalAddress`, `emailAddress`, `password`, `accessPermission`) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $fName, $lName, $mNumber, $pAddress, $email, $password, $accessPermission);

            if ($stmt->execute()) {
                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $email;

                if ($accessPermission === 'customer') {
                    echo '<script> alert("Registered as a Customer successfully!"); </script>';
                    echo '<script> window.location.href = "../index.php"; </script>';
                } elseif ($accessPermission === 'supplier') {
                    echo '<script> alert("Registered as a Supplier successfully!"); </script>';
                    echo '<script> window.location.href = "../addtoStock.html"; </script>';
                }

                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
    }
}
