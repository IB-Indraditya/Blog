<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $conn = new mysqli('localhost', 'root', '', 'registration_db');
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT image_path FROM image_posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $file = $row['image_path'];
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        echo 'File not found.';
    }
}
?>
