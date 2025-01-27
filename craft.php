<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php#logpg");
    exit();
}
// Set response header for JSON
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON input
    $input = json_decode(file_get_contents("php://input"), true);

    if (isset($input['image'])) {
        // Decode base64 image
        $imgData = $input['image'];
        $imgData = str_replace('data:image/png;base64,', '', $imgData);
        $imgData = str_replace(' ', '+', $imgData);
        $decodedImg = base64_decode($imgData);

        $conn = new mysqli("localhost", "root", "", "registration_db");
            $author_name = $_SESSION['name'];
            $author_email = $_SESSION['user_email'];

            if ($conn->connect_error) {
                echo json_encode(["success" => false, "message" => "Database connection failed!"]);
                exit;
            }

        // Define image path and file name
        $folderPath = $author_email."_uploadblog/";
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true); // Create the folder if it doesn't exist
        }

        $fileName = uniqid("image_", true) . ".png"; // Unique image name
        $filePath = $folderPath . $fileName;

        // Save the image to the folder
        if (file_put_contents($filePath, $decodedImg)) {
            // Connect to database
            

            // Save the image path to the database
            $stmt = $conn->prepare("INSERT INTO blogcraft (image_path, author_email, author_name) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $filePath, $author_email, $author_name);

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Image saved to database!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to save image to database!"]);
            }

            $stmt->close();
            $conn->close();
        } else {
            echo json_encode(["success" => false, "message" => "Failed to save image file!"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "No image data received!"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method!"]);
}
?>
