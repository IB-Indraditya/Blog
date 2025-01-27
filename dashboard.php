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

    // $stmt->close();
    // $conn->close();
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fetch_images'])) {
        // Directory containing the images
        $directory = $email."_uploadblog/";
    
        // Get all image files in the directory
        $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    
        // Convert file paths to URLs
        $imageUrls = array_map(function ($file) {
            return $file; // Relative path to the image
        }, $images);
    
        // Return the list of images as JSON
        header("Content-Type: application/json");
        echo json_encode($imageUrls);
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
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
                background: url('https://www.hdwallpapers.in/download/street_during_nighttime_hd_dark_aesthetic-1600x900.jpg'), rgb(0, 18, 18);
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
                z-index: 1000;
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
            .dconm .headings{
                font-size: 40px;
                color: white;
                margin: 40px auto;
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
                width: 90%;
                height: 400px;
                background-color: rgba(255, 255, 255, .4);
                background: url('https://images8.alphacoders.com/134/1347723.png');
                background-attachment: fixed;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: top;
                display: flex;
                align-items: center;
                /* justify-content: center; */
                margin: 40px auto;
                border-radius: 5px;
                overflow-x: scroll;
                scrollbar-width: thin;
                scrollbar-color: white transparent;

            }
            .myblogs div{
                padding: 10px;
                min-width: 250px;
                max-width: 250px;
                height: 350px;
                /* background: url('https://images.smiletemplates.com/uploads/screenshots/724/0000724185/powerpoint-template-450w.jpg'); */
                box-shadow: 0 0 10px white;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: top;
                margin: 0 20px;
                border-radius: 5px;
                cursor: url('gpointer.png'), pointer;
                display: flex;
                align-items: center;
                flex-direction: column;
            }
            .image-box img{
                width: 100%;
                height: 100%;
                border-radius: 5px;
            }
            d{
                opacity: 0;
                font-size: 0px;
                color: transparent;

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
                #toolbar{
                    width: 800px !important;
                    bottom: 50px !important;
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
                        <form action="logout.php" method="POST">
                            <p class="image"><button type='submit' class="logout">Log Out</button></p>
                        </form>
                    </section>
                </section>
                <section class="dconm">
                    <h1>Dashboard</h1>
                    <p class="headings" id="edb">My Blogs</p>
                    
                    <?php include 'txtar.php' ?>
                    <a href='craftblog.php' class='edb'>View All Blogs</a>
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
    } else {
        echo "User details not found.";
    }

?>
