<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_FILES['image']['name']) && isset($_POST['id'])) {
        $id = $_POST['id'];

        // File upload logic
        $targetDir = "uploads/";
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $conn = new mysqli('localhost', 'root', '', 'registration_db');
            if ($conn->connect_error) {
                die('Database connection failed: ' . $conn->connect_error);
            }

            $stmt = $conn->prepare("UPDATE image_posts SET image_path = ? WHERE id = ?");
            $stmt->bind_param("si", $targetFilePath, $id);
            $stmt->execute();

            echo json_encode(['success' => true, 'message' => 'Image updated successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload the image.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
    }
}
?>
