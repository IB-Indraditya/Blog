<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'root', '', 'registration_db');

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

$postId = $data['post_id'];
$authorName = $conn->real_escape_string($data['author_name']);
$content = $conn->real_escape_string($data['content']);

$sql = "INSERT INTO comments3 (post_id, author_name, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $postId, $authorName, $content);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'author_name' => $authorName, 'content' => $content]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to add comment.']);
}

$stmt->close();
$conn->close();
?>
