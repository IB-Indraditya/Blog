<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'registration_db');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

// Parse JSON input
$data = json_decode(file_get_contents('php://input'), true);
$postId = intval($data['post_id'] ?? 0);
$userEmail = $data['user_email'] ?? '';

if ($postId && !empty($userEmail)) {
    $checkSql = "SELECT * FROM post_likes WHERE post_id = ? AND user_email = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param('is', $postId, $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User already liked the post, remove the like
        $deleteSql = "DELETE FROM post_likes WHERE post_id = ? AND user_email = ?";
        $stmt = $conn->prepare($deleteSql);
        $stmt->bind_param('is', $postId, $userEmail);
        if ($stmt->execute()) {
            $countSql = "SELECT COUNT(*) AS like_count FROM post_likes WHERE post_id = ?";
            $stmt = $conn->prepare($countSql);
            $stmt->bind_param('i', $postId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            echo json_encode(['success' => true, 'likes' => $row['like_count'], 'liked' => false]);
        }
    } else {
        // Add the like
        $insertSql = "INSERT INTO post_likes (post_id, user_email) VALUES (?, ?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param('is', $postId, $userEmail);
        if ($stmt->execute()) {
            $countSql = "SELECT COUNT(*) AS like_count FROM post_likes WHERE post_id = ?";
            $stmt = $conn->prepare($countSql);
            $stmt->bind_param('i', $postId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            echo json_encode(['success' => true, 'likes' => $row['like_count'], 'liked' => true]);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
}

$conn->close();
?>
