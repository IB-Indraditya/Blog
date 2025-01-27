<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['user_email'])) {
        header("Location: login.php#logpg"); // Redirect to login page
        exit();
    }

    // Use the session email to fetch user details
    $conn = new mysqli("localhost", "root", "", "registration_db");

    if ($conn->connect_error) {
        die("Connection Error: " . $conn->connect_error);
    }

    $email = $_SESSION['user_email'];
    $sql = "SELECT * FROM blogregister WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simple Blog System">
    <meta name="keywords" content="PHP Blog, Simple Blog, Blogging System">
    <meta name="author" content="Your Name">
    <title>Simple Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
        }
        .main{
            display: flex;
            flex-direction: column;
            height: auto;
            width: 100%;
            max-width: 1600px;
            min-height: 300px;
            background: url('https://static.vecteezy.com/system/resources/previews/007/278/150/non_2x/dark-background-abstract-with-light-effect-vector.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;
            box-shadow: 0 0 10px dimgray;
        }
        .container {
            width: 95%;
            margin: 20px auto;
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
            /* text-transform: uppercase; */
        }
        .image{
            text-align: center;
        }
        .dconi p img{
            width: 80px;
            background-color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
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
        h1 {
            text-align: center;
            color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
            margin: 150px 0;
            margin-bottom: 100px;
            font-size: 50px;
        }
        h4{
            color: grey;
        }
        .post {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            direction: ltr;
            text-align: center;
        }
        .post h2 {
            margin: 0;
            color: rgb(9 194 105 / var(--tw-bg-opacity, 1))
;
        }
        .post p {
            line-height: 1.6;
        }
        .post time {
            display: block;
            margin-top: 10px;
            color: #999;
        }
        .add-post {
            text-align: center;
            margin-top: 50px;
            font-size: 30px;
        }
        .add-post a {
            text-decoration: none;
            background: rgb(9 194 105 / var(--tw-bg-opacity, 1));
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .add-post a:hover {
            background: white;
            color: black;
            border: solid 1px rgb(9 194 105 / var(--tw-bg-opacity, 1));
        }
        .b_img{
            width: 500px;
            height: 500px;
            padding: 5px;
            box-shadow: 0 0 5px darkslategrey;
            margin: 20px auto;
            border-radius: 5px;
            overflow: hidden;
            display: flex;
            align-items: center;
            /* overflow: scroll; */
            scrollbar-width: thin;
            scrollbar-color: darkslateblue transparent;
        }
        .b_img img{
            width: 100%;
            height: auto;
            border-radius: 5px;

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
        .lcs{
            display: flex;
            justify-content: center;
            align-items: center;
            color: darkslategrey;
        }
        .lcs span{
            display: flex;
            flex-direction: row;
            background-color: white;
            padding: 0 15px;
            margin: 10px auto;
        }
        .comment-section{
            box-shadow: 0 0 5px darkslategrey;
            border-radius: 15px;
            border-bottom-left-radius: 0px;
        }
        .like-section{
            display: flex;
        }
        .like-count{
            font-size: 20px;
        }
        .like-section button{
            border: none;
            background: white;
        }
        .lcs span button{
            color: darkslategray;
        }
        .comment-box{
            width: 200px;
            height:40px;
            padding: 10px;
            background-color: transparent;
            border: none;
            color: black;
            text-align: left;
            resize: none;
            scrollbar-color: white transparent;
            scrollbar-width: thin;
            font-size: 17px;
            font-family: cambria;
        }
        .comment-box::placeholder{
            color: grey;
        }
        .comment-btn{
            border: none;
            margin: 0px;
            padding: 0px 10px;
            background: transparent;
            color: darkslategray;
            border-radius: 5px;
            cursor: pointer;
        }
        .comment-box:focus{
            outline: none;
        }
        .comments{
            max-height: 240px;
            overflow-y: scroll;
            background: lavender;
            align-items: center;
            /* justify-content: center; */
            flex-direction: column;
            display: flex;
            scrollbar-color: white transparent;
            scrollbar-width: thin;
            text-align: left;

        }
        .comment{
            border-radius: 5px;
            padding: 5px;
            background: rgba(255,255,255,.8);
            color: darkslategrey;
            width: 90%;
        }
        .recentcomment{
            background: white;
            width: 90%;
            border-radius: 5px;
            padding: 5px;
        }
        @media (min-width: 4000px){
            .container{
                height: auto !important;
            }
        }
        @media (max-width: 700px){
            .container{
                width: 100%;
            }
            .lcs{
                transform: scale(.7);
            }
            .lcs span{
                margin: 0 10px;
            }
            .comment-box{
                font-size: 25px;
            }
        }
        @media (max-width: 400px){
            .lcs{
                transform: scale(.5, .6);
            }
            .lcs span{
                margin: 0 10px;
            }
        }
    </style>
</head>
<body>
    <section class='main' id="gotop">
        <?php include('header2.html') ?>
        <div class="container">
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
                <?php
                    if ($result->num_rows > 0) {
                        $user = $result->fetch_assoc();
                        $name = $user['fullname'];
                        echo "<script>document.getElementById('name').innerHTML='Name- ".$user['fullname']."';</script>";
                        echo "<script>document.getElementById('mail').innerHTML='Email- ".$user['email']."';</script>";
                        echo "<script>document.getElementById('password').innerHTML='Password- <span>".$user['cpassword']."</span>';</script>";
                    } else {
                        echo "User details not found.";
                    }
                ?>
            </section>
            <!-- <div id='toolbar'></div> -->
            <h1>Pictures Feed</h1>
            <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'registration_db');

                if ($conn->connect_error) {
                    die('Database connection failed: ' . $conn->connect_error);
                }

                // Simulate logged-in user's email (replace with actual session user data)
                $userEmail = '<?php echo $email; ?>';

                // Fetch blog posts with like counts and user-like status
                $sql = "SELECT image_posts.*, 
                            blogregister.fullname, 
                            (SELECT COUNT(*) FROM picture_likes WHERE picture_likes.post_id = image_posts.id) AS like_count,
                            (SELECT COUNT(*) FROM picture_likes WHERE picture_likes.post_id = image_posts.id AND picture_likes.user_email = ?) AS user_liked
                        FROM blogregister
                        INNER JOIN image_posts ON image_posts.author_email = blogregister.email
                        ORDER BY image_posts.created_at DESC";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $userEmail);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $postId = $row['id'];
                        $likeCount = $row['like_count'];
                        $userLiked = $row['user_liked'];

                        echo "<div class='post' data-post-id='" . $postId . "'>";
                        echo "<h2>" . htmlspecialchars($row['fullname']) . "</h2>";
                        echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
                        echo "<div class='b_img'>";
                        echo "<img src= '" . $row['image_path'] . "'>";
                        echo "</div>";
                        echo "<time>Posted on " . $row['created_at'] . "</time>";

                        // Display comments for this post
                        $commentSql = "SELECT * FROM comments2 WHERE post_id = $postId ORDER BY created_at ASC";
                        $commentResult = $conn->query($commentSql);
                        echo "<h4>Comments</h4>";
                        echo "<div class='comments'>";
                        if ($commentResult->num_rows > 0) {
                            while ($comment = $commentResult->fetch_assoc()) {
                                echo "<p class='comment'><i class='fa-regular fa-user'></i>    <strong>" . htmlspecialchars($comment['author_name']) . ":</strong> " . htmlspecialchars($comment['content']) . "</p>";
                            }
                        } else {
                            echo "<p class='comment nocomments'>Be the first commentator!</p>";
                        }
                        echo "</div>";

                        // Like button and comment input box
                        echo "<p class='lcs'>
                                <span class='like-section'>
                                    <span class='like-count'>" . $likeCount . "</span>
                                    <button class='like-btn'>" . ($userLiked ? '<i class="fa-solid fa-thumbs-up fa-2xl"></i> Liked' : '<i class="fa-regular fa-thumbs-up fa-2xl"></i>') . "</button>
                                </span>
                                <span class='comment-section'>
                                    <textarea type='text' class='comment-box' placeholder='Write a comment...'></textarea>
                                    <button class='comment-btn'><i class='fa-regular fa-paper-plane fa-rotate-by fa-2xl' style='--fa-rotate-angle: 55deg;'></i></button>
                                </span>
                                <span><i class='fa-solid fa-share-from-square fa-2xl'></i></span>
                            </p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No blog posts yet. Be the first to write one!</p>";
                }

                $conn->close();
                ?>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        document.querySelectorAll('.like-btn').forEach((button) => {
                            button.addEventListener('click', () => {
                                const postDiv = button.closest('.post');
                                const postId = postDiv.getAttribute('data-post-id');
                                const userEmail = '<?php echo $email; ?>'; // Replace with the actual logged-in user's email

                                fetch('imagelikes.php', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ post_id: postId, user_email: userEmail }),
                                })
                                    .then((response) => response.json())
                                    .then((data) => {
                                        if (data.success) {
                                            const likeCountSpan = postDiv.querySelector('.like-count');
                                            likeCountSpan.textContent = data.likes; // Update like count
                                            button.innerHTML = data.liked
                                                ? '<i class="fa-solid fa-thumbs-up fa-2xl"></i>'
                                                : '<i class="fa-regular fa-thumbs-up fa-2xl"></i>'; // Update button state
                                        } else {
                                            alert('Error: ' + data.message);
                                        }
                                    })
                                    .catch((error) => {
                                        console.error('Error:', error);
                                        alert('Failed to update like.');
                                    });
                            });
                        });
                    });

                </script>
                <script>
                    document.querySelectorAll('.comment-btn').forEach((button) => {
                    button.onclick = (event) => {
                        const postDiv = event.target.closest('.post');
                        const postId = postDiv.dataset.postId;
                        const commentBox = postDiv.querySelector('.comment-box');
                        const commentContent = commentBox.value;

                        if (commentContent.trim() === '') {
                            alert('Comment cannot be empty!');
                            return;
                        }

                        fetch('addimagecomment.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                post_id: postId,
                                author_name: '<?php echo $name; ?>', // Replace with logged-in user's name
                                content: commentContent
                            }),
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                // Add the new comment to the comment list
                                const commentsDiv = postDiv.querySelector('.comments');
                                const newComment = document.createElement('p');
                                newComment.classList.add('recentcomment');
                                newComment.innerHTML = `<strong>${data.author_name}:</strong> ${data.content}`;
                                commentsDiv.appendChild(newComment);

                                // Clear the input box
                                commentBox.value = '';
                            } else {
                                alert('Error: ' + data.message);
                            }
                        });
                    };
                });

                </script>

            <div class="add-post" id='toolbar'>
                <a href="postimages.php">Add New Post</a>
            </div>
        </div>
        <?php include('footer.html') ?>
    </section>
    <script>
        document.querySelector('.acc').addEventListener('click', ()=>{
            document.querySelector('.dconi').classList.toggle('dshow');
        });
    </script>
</body>
</html>

