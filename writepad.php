<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_email'])) {
        header("Location: login.php#logpg");
        exit();
    }

    // Check if name is set in the session
    

    $conn = new mysqli('localhost', 'root', '', 'registration_db');
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }

    if (isset($_GET['title'], $_GET['content'])) {
        $title = $conn->real_escape_string($_GET['title']);
        $content = $conn->real_escape_string($_GET['content']);
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
    // $conn->close();
?>
<?php
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Add New Blog Post">
    <meta name="keywords" content="PHP Blog, Add Post, Blogging System">
    <meta name="author" content="Your Name">
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
                height: 400px;
                background-color: rgba(255, 255, 255, .4);
                /* background: url('https://pix1000.wordpress.com/wp-content/uploads/2015/04/w1.jpg'); */
                background: url('https://img.freepik.com/free-photo/office-table-with-cup-coffee-keyboard-notepad_1220-4617.jpg?semt=ais_hybrid');
                background-attachment: fixed;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: top;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                margin: 40px auto;
                border-radius: 5px;
                overflow-y: scroll;
                scrollbar-width: thin;
                scrollbar-color: white transparent;

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
                margin: 20px;
                border-radius: 5px;
                cursor: url('gpointer.png'), pointer;
                overflow-y: hidden;

            }
            .myblogs h2, .myblogs time{
                padding: 5px;
                width: 90%;
                height: auto;
                background: url('https://img.freepik.com/free-photo/office-table-with-cup-coffee-keyboard-notepad_1220-4617.jpg?semt=ais_hybrid');
                background: transparent;
                color: white;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: top;
                margin: 10px;
                border-radius: 5px;
                /* cursor: url('gpointer.png'), pointer; */

            }
            .myblogs span{
                margin: 10px auto;
            }
            .myblogs span button{
                margin: 0 20px;
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
            .myblogs span .ebtn:hover{
                color: gold;
            }
            .myblogs span .sbtn:hover{
                color: greenyellow;
            }
            .myblogs span .dbtn:hover{
                color: orangered;
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
        <section class="main"  id="gotop">
            <?php include 'header2.html' ?>
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
                    <p class="edb">My Content</p>
                    
                    <?php
                        $sql3 = "SELECT * FROM posts WHERE author_email = '$email'";
                        $result2 = $conn->query($sql3);
                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                echo "<section class='myblogs' data-post-id='" . $row['id'] . "'>";
                                echo "<h2 class='b_title'>" . htmlspecialchars($row['title']) . "</h2>";
                                echo "<p class='b_content'>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
                                echo "<time>Posted on " . $row['created_at'] . "</time>";
                                echo "<span>
                                        <button class='ebtn'><i class='fa-regular fa-pen-to-square fa-2xl'></i></button>
                                        <button class='sbtn'><i class='fa-solid fa-floppy-disk fa-2xl'></i></button>
                                        <button class='dbtn'><i class='fa-solid fa-trash-can fa-2xl'></i></button>
                                    </span>";
                                echo "</section>";
                            }
                        } else {
                            echo "<script>alert('Write your first content !');</script>";
                        }
                        $conn->close();
                        ?>

                    <script>
                        document.querySelectorAll('.ebtn').forEach((e) => {
                            e.onclick = (event) => {
                                const section = event.target.closest('.myblogs');
                                section.querySelector('.b_title').contentEditable = 'true';
                                section.querySelector('.b_content').contentEditable = 'true';
                            };
                        });

                        document.querySelectorAll('.sbtn').forEach((e) => {
                            e.onclick = (event) => {
                                const section = event.target.closest('.myblogs');
                                const postId = section.dataset.postId;
                                const updatedTitle = section.querySelector('.b_title').textContent;
                                const updatedContent = section.querySelector('.b_content').textContent;

                                // AJAX request to update the post
                                fetch('updatepost.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        id: postId,
                                        title: updatedTitle,
                                        content: updatedContent,
                                    }),
                                })
                                .then((response) => response.json())
                                .then((data) => {
                                    if (data.success) {
                                        alert('Post updated successfully!');
                                        section.querySelector('.b_title').contentEditable = 'false';
                                        section.querySelector('.b_content').contentEditable = 'false';
                                    } else {
                                        alert('Failed to update post.');
                                    }
                                })
                                .catch((error) => console.error('Error:', error));
                            };
                        });
                        document.querySelectorAll('.dbtn').forEach((e) => {
                            e.onclick = (event) => {
                                const section = event.target.closest('.myblogs');
                                const postId = section.dataset.postId;

                                if (confirm('Are you sure you want to delete this post?')) {
                                    // AJAX request to delete the post
                                    fetch('deletepost.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify({ id: postId }),
                                    })
                                    .then((response) => response.json())
                                    .then((data) => {
                                        if (data.success) {
                                            alert('Post deleted successfully!');
                                            section.remove(); // Remove the post from the DOM
                                        } else {
                                            alert('Failed to delete post.');
                                        }
                                    })
                                    .catch((error) => console.error('Error:', error));
                                }
                            };
                        });


                    </script>
                    <div id='toolbar'></div>
                    <p class="edb">Create Content</p>
                    <div class="container">
                        <form class='form' action="" method="GET">
                            <input type="text" name="title" placeholder="Title" required>
                            <textarea name="content" rows="10" placeholder="Content" required></textarea>
                            <button class='button' type="submit" name="submit">Publish</button>
                        </form>
                        <div class="back">
                            <a href="blog.php">View All Posts</a>
                        </div>
                    </div>
                </section>
            </section>
            <?php include 'footer.html' ?>
        </section>
        <script>
            document.querySelector('.acc').addEventListener('click', ()=>{
                document.querySelector('.dconi').classList.toggle('dshow');
            });
        </script>
    </body>
</html>
<?php
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo "<script>document.getElementById('name').innerHTML='Name- ".$user['fullname']."';</script>";
        echo "<script>document.getElementById('mail').innerHTML='Email- ".$user['email']."';</script>";
        echo "<script>document.getElementById('password').innerHTML='Password- <span>".$user['cpassword']."</span>';</script>";
        if (!isset($_SESSION['name'])) {
            $_SESSION['name'] = $user['fullname']; // Temporary fallback, handle appropriately
        }
    } else {
        echo "<script> alert(User details not found.);</script>";
    }
?>
<?php
    //     $sql3 = "SELECT * FROM posts WHERE author_email = '$email'";
    //     $result2 = $conn->query($sql3);
    // if ($result2->num_rows > 0) {
    //     $user2 = $result2->fetch_assoc();
    //     while ($row = $result2->fetch_assoc()) {
    //         echo "<div class=''>";
    //         echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
    //         echo "<h4>" . htmlspecialchars($row['fullname']) . "</h4>";
    //         echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
    //         echo "<time>Posted on " . $row['created_at'] . "</time>";
    //         echo "</div>";
    //     }
    //     if (!isset($_SESSION['name'])) {
    //         $_SESSION['name'] = $user2['author_name']; // Temporary fallback, handle appropriately
    //     }
    // } else {
    //     echo "<script> alert(User details not found.);</script>";
    // }
    // $conn->close();
?> 


