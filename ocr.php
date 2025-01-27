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
                direction: ltr;
            }
            .con{
                height: auto;
                background: url('https://undsgn.com/wp-content/uploads/2018/04/ltotbngnzzu.jpg'), darkslategrey;
                background-attachment: fixed;
                background-position: top;
                background-repeat: no-repeat;
                background-size: cover;
                direction: rtl;
                display: flex;
                /* justify-content: center;
                align-items: center; */
                flex-direction: column;
            }
            .con h1{
                font-family: Arial, Helvetica, sans-serif;
                color: white;
                font-size: 50px;
                margin-top: 250px;
                text-align: center;
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
                background-color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
                border-radius: 5px;
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
            @media (min-width: 1800px) {
                .con{
                    height: 100vh;
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
                <h1 class="reghd">Optical Character Recognizer</h1>
                <?php include 'artspace.html' ?>
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
