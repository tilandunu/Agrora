<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    $activeUserEmail = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fName = $_POST['firstName'];
        $lName = $_POST['lastName'];
        $mNumber = $_POST['phoneNumber'];
        $pAddress = $_POST['postalAddress'];


        $conn = new mysqli('localhost', 'root', '', 'agrora');

        if ($conn->connect_error) {
            die('Connection Failed : ' . $conn->connect_error);
        } else {

            $stmt = $conn->prepare("UPDATE user SET `firstName` = ?, `lastName` = ?, `phoneNumber` = ?, `postalAddress` = ? WHERE `emailAddress` = ?");
            $stmt->bind_param("sssss", $fName, $lName, $mNumber, $pAddress, $activeUserEmail);


            if ($stmt->execute()) {
                echo '<script>alert("Updated successfully!");</script>';
                echo '<script> window.location.href = "user.php"; </script>';

            } else {
                echo '<script>alert("Error in update.");</script>';
            }

            $stmt->close();
            $conn->close();
        }
    } else {
        echo "This page should only be accessed via a POST request.";
    }
} else {
    echo "User is not logged in. Please log in first.";
}
?>