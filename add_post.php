<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if user is not logged in
// if (!isset($_SESSION['user_email'])) {
//     header("Location: login.php");
//     exit();
// }

// Check if name is set in the session
if (!isset($_SESSION['name'])) {
    $_SESSION['name'] = 'Default Name'; // Temporary fallback, handle appropriately
}

$conn = new mysqli('localhost', 'root', '', 'registration_db');
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $author_name = $_SESSION['name'];
    $author_email = $_SESSION['user_email'];

    // Insert blog post
    $sql = "INSERT INTO posts (title, content, author_name, author_email) VALUES ('$title', '$content', '$author_name', '$author_email')";
    if ($conn->query($sql) === TRUE) {
        header("Location: blog.php?status=success");
        exit();
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Add New Blog Post">
    <meta name="keywords" content="PHP Blog, Add Post, Blogging System">
    <meta name="author" content="Your Name">
    <title>Add New Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
        }
        .container {
            width: 90%;
            margin: 20px auto;
        }
        .form {
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        input, textarea, .button {
            
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form .button {
            background: rgb(9 194 105 / var(--tw-bg-opacity, 1));
            color: white;
            cursor: pointer;
        }
        form .button:hover {
            background: white;
            color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
            border: solid 1px rgb(9 194 105 / var(--tw-bg-opacity, 1));
        }
        .back {
            text-align: center;
            margin-top: 20px;
        }
        .back a {
            text-decoration: none;
            background: rgb(9 194 105 / var(--tw-bg-opacity, 1));
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .back a:hover {
            background: white;
            color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
            border: solid 1px rgb(9 194 105 / var(--tw-bg-opacity, 1));
        }
    </style>
</head>
<body>
    <div class="container">
        <form class='form' action="" method="POST">
            <input type="text" name="title" placeholder="Post Title" required>
            <textarea name="content" rows="10" placeholder="Post Content" required></textarea>
            <button class='button' type="submit" name="submit">Submit</button>
        </form>
        <div class="back">
            <a href="blog.php">View All Posts</a>
        </div>
    </div>
</body>
</html>
