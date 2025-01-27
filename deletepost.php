<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'root', '', 'registration_db');

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$postId = $data['id'];

$sql = "DELETE FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $postId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete post.']);
}

$stmt->close();
$conn->close();
?>
