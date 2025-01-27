<?php
$conn = new mysqli('localhost', 'root', '', 'registration_db');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = isset($_POST['query']) ? $_POST['query'] : '';

    // Secure the input
    $query = $conn->real_escape_string($query);

    // Search for matching names
    $sql = "SELECT fullname FROM blogregister WHERE fullname LIKE '%$query%'";
    $sql2 = "SELECT COUNT(*) AS total_count FROM blogregister";
    
    $res = $conn->query($sql);
    $countResult = $conn->query($sql2);

    if ($countResult && $row = $countResult->fetch_assoc()) {
        $totalCount = $row['total_count'];
    }

    if ($res->num_rows > 0) {
        while ($data = $res->fetch_assoc()) {
            echo '<p>' . htmlspecialchars($data['fullname']) . '</p>';
        }
    } else {
        echo '<p>No results found</p>';
    }
}

$conn->close();
?>
