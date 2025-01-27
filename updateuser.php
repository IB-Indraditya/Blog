<?php
$con = new mysqli('localhost', 'root', '', 'registration_db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $data['id'];
    $fullname = $con->real_escape_string($data['fullname']);
    $email = $con->real_escape_string($data['email']);
    $cpassword = $con->real_escape_string($data['cpassword']);
    $token = $con->real_escape_string($data['activation_token']);

    $sql = "UPDATE blogregister SET fullname = '$fullname', email = '$email', cpassword = '$cpassword', activation_token='$token' WHERE id = $id";

    if ($con->query($sql)) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user: " . $con->error;
    }
}

$con->close();
?>
