<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php#logpg");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'registration_db');
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $author_name = $_SESSION['name'];
    $author_email = $_SESSION['user_email'];
    $image = $_FILES['image'];

    // Check and upload image
    if ($image['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $actualMimeType = mime_content_type($image['tmp_name']);

        if (in_array($actualMimeType, $allowedTypes)) {
            $targetDir = "uploads/";
            if (!is_dir($targetDir) && !mkdir($targetDir, 0777, true) && !is_dir($targetDir)) {
                echo "<script>alert(Failed to create upload directory);</script>";
                exit();
            }

            $imageName = uniqid("img_", true) . "_" . basename($image['name']);
            $targetFilePath = $targetDir . $imageName;

            if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                // Insert blog post with image
                $stmt = $conn->prepare("INSERT INTO image_posts (title, image_path, author_name, author_email) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $title, $targetFilePath, $author_name, $author_email);
                if ($stmt->execute()) {
                    header("Location: imageblog.php?status=success");
                    exit();
                } else {
                    // echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
                    echo "<script>alert(Error: " . $stmt->error . ");</script>";
                exit();
                }
                $stmt->close();
            } else {
                // echo "<p style='color: red;'>Error uploading image.</p>";
                echo "<script>alert(Error uploading image.);</script>";
                exit();
            }
        } else {
            // echo "<p style='color: red;'>Invalid file type. Only JPG, PNG, and GIF are allowed.</p>";
            echo "<script>alert(Invalid file type. Only JPG, PNG, and GIF are allowed.);</script>";
            exit();
        }
    } else {
        switch ($image['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "<p style='color: red;'>File size exceeds the limit.</p>";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "<p style='color: red;'>File was only partially uploaded.</p>";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "<p style='color: red;'>No file was uploaded.</p>";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo "<p style='color: red;'>Failed to write file to disk.</p>";
                break;
            case UPLOAD_ERR_EXTENSION:
                echo "<p style='color: red;'>File upload stopped by extension.</p>";
                break;
            default:
                echo "<p style='color: red;'>Unknown error occurred.</p>";
        }
    }
}


$email = $_SESSION['user_email'];
$sql2 = "SELECT * FROM blogregister WHERE email = ?";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
    <style>
            *{
                margin: 0;
                padding: 0;
                cursor: url('gcursor1.png'), auto;
            }
            body{
                display: flex;
                align-items: flex-start;
                justify-content: center;
            }
            .main{
                display: flex;
                flex-direction: column;
                height: auto;
                width: 100%;
                max-width: 1600px;
                min-height: 300px;
                box-shadow: 0 0 10px dimgray;
            }
            .con{
                height: auto;
                background: url('https://images.unsplash.com/photo-1478760329108-5c3ed9d495a0?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8ZGFyayUyMGJhY2tncm91bmR8ZW58MHx8MHx8fDA%3D');
                background-attachment: fixed;
                background-position: top;
                background-repeat: no-repeat;
                background-size: cover;
                direction: rtl;
            }
            .dconr{
                margin: 0 4vw;
                margin-top: 100px;
                position: fixed;
                font-family: Arial, Helvetica, sans-serif;
            }
            .dconi{
                padding: 10px;
                background: white;
                display: none;
                width: 250px;
                box-shadow: 0 0 10px dimgrey;
                border-radius: 5px;
                direction: ltr;
            }
            .dconi p{
                margin: 20px auto;
            }
            .image{
                text-align: center;
            }
            .dconi p img{
                width: 80px;
                background-color: springgreen;
                border-radius: 10px;
                transform: scale(1) !important;
                opacity: 1 !important;
                cursor: url('gpointer.png'), pointer;
            }
            .logout{
                padding: 10px;
                border: none;
                font-size: 20px;
                border-radius: 5px;
                background: rgb(9 194 105 / var(--tw-bg-opacity, 1));
                color: white;
                cursor: url('gpointer.png'), pointer;
            }
            .dshow{
                display: block;
            }
            .dconm{
                direction: ltr;
                font-family: Arial, Helvetica, sans-serif;
                margin: 120px auto;
                margin-bottom: 50px;
                display: flex;
                justify-content: center;
                flex-direction: column;
                overflow-x: hidden;
            }
            .dconm h1, .dconm .edb{
                font-size: 60px;
                color: white;
                text-align: center;
            }
            .dconm .edb{
                color: black;
                font-size: 30px;
                margin: 40px auto;
                padding: 5px 20px;
                background-color: white;
                border-radius: 5px;
                cursor: url('gpointer.png'), pointer;
                /* text-transform: uppercase; */
            }
            .edb:hover{
                background: rgb(9 194 105 / var(--tw-bg-opacity, 1));
                color: white;
            }
            .myblogs{
                padding: 5px 0;
                width: 90%;
                height: 340px;
                background-color: rgba(255, 255, 255, .4);
                /* background: url('https://pix1000.wordpress.com/wp-content/uploads/2015/04/w1.jpg'); */
                background: url('https://img.freepik.com/free-photo/office-table-with-cup-coffee-keyboard-notepad_1220-4617.jpg?semt=ais_hybrid');
                background-attachment: fixed;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: top;
                display: flex;
                margin: 40px auto;
                border-radius: 5px;
                overflow-x: scroll;
                scrollbar-width: thin;
                scrollbar-color: white transparent;

            }
            .myblogs div{
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 0px;
                max-width: 300px;
                height: 300px;
                background: rgba(0, 255, 255, 0.1);
                /* background: url('https://images.smiletemplates.com/uploads/screenshots/724/0000724185/powerpoint-template-450w.jpg'); */
                box-shadow: 0 0 10px white;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: top;
                margin: 20px;
                border-radius: 5px;
                cursor: url('gpointer.png'), pointer;

            }
            .myblogs div .postedimg{
                width: 95%;
                min-height: 50% !important;
                margin: 10px auto;
                border-radius: 5px;
                box-shadow: none;
                background: transparent;
                overflow: hidden;
                background: rgba(255, 255, 255, 0.2);
            }
            .postedimg img{
                width: 100%;
                height: 100% !important;
                border-radius: 5px;
                object-fit: cover;

            }
            .myblogs p{
                padding: 10px;
                width: 90%;
                height: auto;
                min-height: 200px;
                background: url('https://img.freepik.com/free-photo/office-table-with-cup-coffee-keyboard-notepad_1220-4617.jpg?semt=ais_hybrid');
                background: white;
                /* box-shadow: 0 0 10px white; */
                background-repeat: no-repeat;
                background-size: cover;
                background-position: top;
                margin: 20px auto;
                border-radius: 5px;
                cursor: url('gpointer.png'), pointer;
                overflow-y: hidden;
                text-align: center;

            }
            .myblogs h2, .myblogs time{
                padding: 5px;
                width: 100%;
                height: auto;
                background: transparent;
                color: white;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: top;
                margin: 0px auto;
                border-radius: 5px;
                text-align: center;
                /* cursor: url('gpointer.png'), pointer; */

            }
            .myblogs span{
                margin: 10px auto;
                display: flex;
                justify-content: center;
            }
            .myblogs span button{
                margin: 10px;
                padding: 0px;
                /* width:100px; */
                border: none;
                border-radius: 2px;
                font-size: 17px;
                background: transparent;
                color: white;
                cursor: url('gpointer.png'), pointer;
            }
            .myblogs span button:hover{
                color: white;
                /* text-shadow: 0 0 5px white; */
                box-shadow: none;
            }
            .myblogs span .cbtn:hover{
                color: gold;
            }
            .myblogs span .rbtn:hover{
                color: greenyellow;
            }
            .myblogs span .dbtn:hover{
                color: orangered;
            }
            .myblogs span .ebtn:hover{
                color: rgb(74, 121, 191);
            }
            .dblog{
                display: flex;
                justify-content: center;
            }
            #password span{
                letter-spacing: 10px;
                -webkit-text-stroke: 5px black;
                -webkit-text-security: disc;
                opacity: .2;
                transform: scale(1.5);
            }
            #password span:hover{
                letter-spacing: 1px;
                -webkit-text-stroke: 1px;
                -webkit-text-security: none;
                opacity: 1;
                transform: scale(1.5);
            }
            @media (min-width: 1900px){
                .con{
                    height: auto;
                }
            }
            @media (min-width: 3000px){
                .con{
                    height: 100vh !important;
                }
            }
        </style>
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
            input:focus{
                outline: none;
                box-shadow: 0 0 5px rgb(9 194 105 / var(--tw-bg-opacity, 1));
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
                font-size: 30px;
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
            @media (max-width: 700px){
                .myblogs{
                    width: 100%;
                }
                .myblogs p{
                    width: 80%;
                }
                .container{
                    width: 100%;
                }
            }
        </style>
</head>
<body>
    <section class="main" id="gotop">
        <?php include 'header2.html'; ?>
        <section class="con">
            <section class="dconr">
                <section class="dconi">
                    <p class="image"><img src="https://png.pngtree.com/png-vector/20230903/ourmid/pngtree-man-avatar-isolated-png-image_9935819.png" alt=""></p>
                    <hr>
                    <p id='name'>Name: </p>
                    <p id='mail'>Mail Id: </p>
                    <p id='password'>Password: </p>
                    <form action="logout.php" method="GET">
                        <p class="image"><button type='submit' class="logout">Log Out</button></p>
                    </form>
                </section>
            </section>
            <section class="dconm">
                <h1>Dashboard</h1>
                <div id="edb"></div>
                <p class="edb">My Images</p>
                <section class='myblogs'>
                    <?php
                        $sql3 = "SELECT * FROM image_posts WHERE author_email = '$email'";
                        $result2 = $conn->query($sql3);
                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                echo "";
                                echo "<div class='closest' data-post-id='" . $row['id'] . "'>";
                                echo "<h2 class='b_title'>" . htmlspecialchars($row['title']) . "</h2>";
                                echo "<div class='postedimg'>";
                                echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='Post Image' style='max-width:100%;height:auto;'>";
                                echo "</div>";
                                echo "<time>Posted on " . $row['created_at'] . "</time>";
                                echo "<span>
                                    <button class='cbtn' data-action='change' data-id='" . $row['id'] . "'><i class='fa-solid fa-arrows-rotate fa-xl'></i></button>
                                    <button class='rbtn' data-action='save' data-id='" . $row['id'] . "'><i class='fa-solid fa-floppy-disk fa-xl'></i></button>
                                    <button class='dbtn' data-action='delete' data-id='" . $row['id'] . "'><i class='fa-solid fa-trash-can fa-xl'></i></button>
                                    <button class='ebtn' data-action='download' data-id='" . $row['id'] . "'><i class='fa-solid fa-download fa-xl'></i></button>
                                    </span>";
                                echo "</div>";
                                echo "";
                            }
                        } else {
                            echo "<script>alert('Upload your first image!');</script>";
                        }
                    ?>
                </section>
                <script>
                    document.querySelectorAll('.b_title').forEach((e) => {
                            e.onclick = (event) => {
                                const section = event.target.closest('.closest');
                                section.querySelector('.b_title').contentEditable = 'true';
                            };
                        });

                    document.querySelectorAll('.cbtn').forEach((btn) => {
                        btn.addEventListener('click', (event) => {
                            const postId = btn.dataset.id;
                            const fileInput = document.createElement('input');
                            fileInput.type = 'file';
                            fileInput.accept = 'image/*';
                            fileInput.onchange = () => {
                                const formData = new FormData();
                                formData.append('id', postId);
                                formData.append('image', fileInput.files[0]);

                                fetch('changeimage.php', {
                                    method: 'POST',
                                    body: formData,
                                })
                                    .then((response) => response.json())
                                    .then((data) => {
                                        alert(data.message);
                                        if (data.success) location.reload();
                                    });
                            };
                            fileInput.click();
                        });
                    });

                    document.querySelectorAll('.rbtn').forEach((btn) => {
                        btn.addEventListener('click', (event) => {
                            const postId = btn.dataset.id;
                            console.log(postId);
                            const section = event.target.closest('.closest');
                            const title = section.querySelector('.b_title').textContent;
                            // const title = prompt('Enter new title:');
                            if (title) {
                                fetch('saveimage.php', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ id: postId, title }),
                                })
                                    .then((response) => response.json())
                                    .then((data) => {
                                        if (data.success) {
                                            alert('Post updated successfully!');
                                            section.querySelector('.b_title').contentEditable = 'false';
                                        } else {
                                            alert('Failed to update post.');
                                        }
                                    });
                                    window.location.href='postimages.php';
                            }
                        });
                    });

                    document.querySelectorAll('.dbtn').forEach((btn) => {
                        btn.addEventListener('click', () => {
                            const postId = btn.dataset.id;
                            if (confirm('Are you sure you want to delete this image?')) {
                                fetch('deleteimage.php', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ id: postId }),
                                })
                                    .then((response) => response.json())
                                    .then((data) => {
                                        alert(data.message);
                                        if (data.success) location.reload();
                                    });
                            }
                        });
                    });

                    document.querySelectorAll('.ebtn').forEach((btn) => {
                        btn.addEventListener('click', () => {
                            const postId = btn.dataset.id;
                            window.location.href = `downloadimage.php?id=${postId}`;
                        });
                    });


                </script>
                <div id='toolbar'></div>
                <p class="edb">Post Image</p>
                <div class="container">
                    <form class='form' action="" method="POST" enctype="multipart/form-data">
                        <input type="text" name="title" placeholder="Write whats on your mind..." required>
                        <div id="imageDiv" contenteditable="false" data-placeholder="Drop your image here or paste content..."
                            style="
                                border: 1px solid #ccc;
                                border-radius: 4px;
                                padding: 10px;
                                font-family: Arial, sans-serif;
                                color: #555;
                                height: 300px;
                                margin: 20px 0;
                                position: relative;
                                text-align: center;
                                overflow: hidden;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            ">
                            <span id="placeholderText" 
                                style="
                                    position: absolute;
                                    color: #aaa;
                                    font-size: 14px;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                    pointer-events: none;
                                ">
                                Check For The Selected Image
                            </span>
                        </div>                            <label for="image" style="
                                display: block;
                                background-color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
                                color: white;
                                padding: 10px 20px;
                                border-radius: 4px;
                                cursor: pointer;
                                font-family: Arial, sans-serif;
                                text-align: center;
                                transition: background 0.3s;
                            ">
                                Select Any Picture And Upload
                            </label>
                            <input type="file" name="image" id="image" accept="image/*"
                                style="position: absolute; width: 1px; height: 1px; opacity: 0; overflow: hidden;" required>
                            <span id="file-chosen" style="
                                display: block;
                                margin: 10px auto;
                                font-family: Arial, sans-serif;
                                font-size: 14px;
                                color: #555;
                                text-align: center;
                            ">File Selected-None</span>

                        <script>
                            const fileInput = document.getElementById('image');
                            const fileChosen = document.getElementById('file-chosen');
                            const previewContainer = document.getElementById('imageDiv'); // Add this container in your HTML

                            fileInput.addEventListener('change', () => {
                                previewContainer.innerHTML = ''; // Clear any previous image preview

                                if (fileInput.files.length > 0) {
                                    const selectedFile = fileInput.files[0];

                                    // Update file name text
                                    fileChosen.textContent = `File Selected: ${selectedFile.name}`;

                                    // Create an image preview
                                    const reader = new FileReader();
                                    reader.onload = (event) => {
                                        const img = document.createElement('img');
                                        img.src = event.target.result;
                                        img.style.maxWidth = '100%';
                                        img.style.maxHeight = '100%';
                                        img.style.boxShadow = '0 0 5px dimgrey';
                                        img.style.borderRadius = '5px';
                                        previewContainer.appendChild(img);
                                    };

                                    reader.readAsDataURL(selectedFile); // Read the file as a data URL for preview
                                } else {
                                    fileChosen.textContent = `File Selected: None`;
                                }
                            });
                        </script>
                        <button class='button' type="submit" name="submit">Publish</button>
                    </form>
                    <div class="back">
                        <a href="imageblog.php">View All Posts</a>
                    </div>
                </div>
            </section>
        </section>
        <?php include 'footer.html'; ?>
    </section>
    <script>
        document.querySelector('.acc').addEventListener('click', ()=>{
            document.querySelector('.dconi').classList.toggle('dshow');
        });
    </script>
    <script>
        const imageDiv = document.getElementById('imageDiv');
        const placeholderText = document.getElementById('placeholderText');
    
        // Function to update placeholder visibility
        function updatePlaceholder() {
            const hasImage = imageDiv.querySelector('img') !== null;
            placeholderText.style.display = hasImage ? 'none' : 'block';
        }
    
        // Monitor for content changes inside the div
        imageDiv.addEventListener('input', () => {
            updatePlaceholder();
        });
    
        // Initialize placeholder visibility
        updatePlaceholder();
    
        // Optional: Drag-and-drop image handling (if needed)
        // imageDiv.addEventListener('dragover', (event) => {
        //     event.preventDefault();
        //     imageDiv.style.borderColor = '#007BFF'; // Highlight border on drag
        // });
    
        // imageDiv.addEventListener('dragleave', () => {
        //     imageDiv.style.borderColor = '#ccc';
        // });
    
        imageDiv.addEventListener('drop', (event) => {
            event.preventDefault();
            imageDiv.style.borderColor = '#ccc';
    
            const files = event.dataTransfer.files;
            if (files.length > 0 && files[0].type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100%';
                    img.style.maxHeight = '100px';
                    imageDiv.appendChild(img);
                    updatePlaceholder();
                };
                reader.readAsDataURL(files[0]);
            }
        });
    </script>
</body>
</html>
<?php
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "<script>document.getElementById('name').innerHTML='Name- " . $user['fullname'] . "';</script>";
    echo "<script>document.getElementById('mail').innerHTML='Email- " . $user['email'] . "';</script>";
    echo "<script>document.getElementById('password').innerHTML='Password- <span>" . $user['cpassword'] . "</span>';</script>";
    if (!isset($_SESSION['name'])) {
        $_SESSION['name'] = $user['fullname'];
    }
} else {
    echo "<script> alert(User details not found.);</script>";
}
?>
<?php
function getFileNamesFromFolderAndDatabase($folderPath, $conn, $tableName = 'image_posts', $column = 'image_path') {
    // Ensure the folder path ends with a slash
    if (substr($folderPath, -1) !== '/') {
        $folderPath .= '/';
    }

    // Array to hold file names from the folder
    $folderFiles = [];

    // Check if the folder exists
    if (is_dir($folderPath)) {
        // Open the directory
        $dir = opendir($folderPath);
        if ($dir) {
            while (($file = readdir($dir)) !== false) {
                // Skip `.` and `..` entries
                if ($file !== '.' && $file !== '..') {
                    $folderFiles[] = $file;
                }
            }
            closedir($dir);
        }
    } else {
        echo "Error: Folder not found at $folderPath.";
        return false;
    }

    // Array to hold file names from the database
    $dbFiles = [];

    // Fetch file paths from the database
    $sql = "SELECT $column FROM $tableName";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Extract the file name from the full path
            $dbFiles[] = basename($row[$column]);
        }
    } else {
        echo "No files found in the database.";
    }

    // Return both arrays
    return [
        'folderFiles' => $folderFiles,
        'dbFiles' => $dbFiles
    ];
}

// Example usage
// Assume $conn is your database connection
$folderPath = 'uploads';
$result = getFileNamesFromFolderAndDatabase($folderPath, $conn);

if ($result !== false) {
    $folderFiles = $result['folderFiles']; // Files in the folder
    $dbFiles = $result['dbFiles'];         // Files in the database

    // Find files only in the folder (not in database)
    $folderOnlyFiles = array_diff($folderFiles, $dbFiles);

    // Delete files only in the folder
    $folderPath = "uploads/"; // Path to the folder
    foreach ($folderOnlyFiles as $file) {
        $filePath = $folderPath . $file;
        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                echo "<script>console.log('Deleted file: " . $file . "');</script>";
            } else {
                echo "<script>console.log('Failed to delete file: " . $file . "');</script>";
            }
        }
    }

    // Output results
    echo "<script>console.log('Files kept (common): " . json_encode(array_intersect($folderFiles, $dbFiles)) . "');</script>";
    echo "<script>console.log('Files deleted from folder: " . json_encode($folderOnlyFiles) . "');</script>";
}

?>


