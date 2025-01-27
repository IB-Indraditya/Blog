<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'root', '', 'registration_db');

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$postId = $data['id'];
$title = $conn->real_escape_string($data['title']);
$content = $conn->real_escape_string($data['content']);

$sql = "UPDATE posts SET title = '$title', content = '$content' WHERE id = $postId";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update post.']);
}

$conn->close();
?>
