<?php
$con = new mysqli('localhost', 'root', '', 'registration_db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = $data['id'];

    $sql = "DELETE FROM blogregister WHERE id = $id";

    if ($con->query($sql)) {
        echo "User deleted successfully!";
    } else {
        echo "Error deleting user: " . $con->error;
    }
}

$con->close();
?>
