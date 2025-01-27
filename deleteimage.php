<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include database connection
    $conn = new mysqli('localhost', 'root', '', 'registration_db');
        if ($conn->connect_error) {
            die('Database connection failed: ' . $conn->connect_error);
        }
    // Check for valid input
    // $postId = isset($_POST['id']) ? intval($_POST['id']) : null;
    // global $postId;
    $data = json_decode(file_get_contents('php://input'), true);
    $postId = $data['id'];
    if ($postId) {
        // Retrieve the image file path from the database
        $stmt = $conn->prepare("SELECT image_path FROM image_posts WHERE id = ?");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imagePath = $row['image_path'];

            // Begin transaction
            $conn->begin_transaction();

            try {
                // Delete the database entry
                $deleteStmt = $conn->prepare("DELETE FROM image_posts WHERE id = ?");
                $deleteStmt->bind_param("i", $postId);

                if ($deleteStmt->execute()) {
                    // Check if the image file exists and delete it
                    if (file_exists($imagePath)) {
                        if (unlink($imagePath)) {
                            // Commit the transaction if both operations succeed
                            $conn->commit();
                            echo json_encode(['success' => true, 'message' => 'Image deleted successfully.']);
                        } else {
                            // Rollback if file deletion fails
                            $conn->rollback();
                            echo json_encode(['success' => false, 'message' => 'Failed to delete the image file.']);
                        }
                    } else {
                        // If the file doesn't exist, still commit the DB deletion
                        $conn->commit();
                        echo json_encode(['success' => true, 'message' => 'Image record deleted, but file not found.']);
                    }
                } else {
                    // Rollback if DB deletion fails
                    $conn->rollback();
                    echo json_encode(['success' => false, 'message' => 'Failed to delete the database record.']);
                }

                $deleteStmt->close();
            } catch (Exception $e) {
                $conn->rollback();
                echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Image not found in the database.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
