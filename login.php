<?php
    session_start(); // Start session for user authentication
    // Database connection
    $conn = new mysqli("localhost", "root", "", "registration_db");

    // Check connection
    if ($conn->connect_error) {
        die("Connection Error: " . $conn->connect_error);
    }

    // Handle login request
    if (isset($_GET['email'], $_GET['password'])) {
        $email = $_GET['email'];
        $password = $_GET['password'];

        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM blogregister WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the hashed password
            if (password_verify($password, $user['password']) && $user['activation_token']==='activated') {
                // Store user email in session
                $_SESSION['user_email'] = $user['email'];

                // Redirect to writepad.php
                header("Location: writepad.php");
                exit();
            } else {
                echo "<script>alert('Invalid Credentials');</script>";
            }
        } else {
            echo "<script>alert('User Not Found!');</script>";
        }

        $stmt->close(); // Close the prepared statement
    }

    $conn->close(); // Close the database connection
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
                background: url('https://i.pinimg.com/originals/d2/aa/87/d2aa87ced1d4706a758c661b7fff1ca3.jpg');
                background-attachment: fixed;
                background-position: top;
                background-repeat: no-repeat;
                background-size: cover;
                direction: ltr;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }
            .con h1{
                font-family: Arial, Helvetica, sans-serif;
                color: white;
                font-size: 50px;
                margin-top: 120px;
            }
            .con #logpg{
                margin-top: 100px;
            }
            .logcon{
                margin: 50px auto;
                margin-bottom: 50px;
                border-radius: 10px;
                padding: 10px;
                width: 450px;
                height: 450px;
                background-color: rgba(255, 255, 255, .4);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            input{
                padding: 10px;
                width: 90%;
                font-size: 20px;
                margin: 20px auto;
                border-radius: 5px;
                background: rgba(255, 255, 255, .85);
                border: none;
                box-shadow: 0 0 10px white;
            }
            input[type='submit']{
                background-color: white;
                box-shadow: none;
                width: 95%;
            }
            input[type='submit']:hover{
                background-color: rgb(9 194 105 / var(--tw-bg-opacity, 1));
                color: white;
                cursor: url('gpointer.png'), pointer !important;
            }
            input:focus{
                outline: none;
                background: white;
            }
            form{
              display: flex;
              align-items: center;
              justify-content: center;
              flex-direction: column;
            }
            .logcon img{
                margin: 0 auto;
                width: 40%;
                border-radius: 50%;
                box-shadow: 0 0 10px white;
                margin-bottom: 20px;
            }
            .new2b{
                font-family: Arial, Helvetica, sans-serif;
                font-size: 20px;
                color: white;
                margin-bottom: 50px;
                font-style: normal;
            }
            .new2b a{
                text-decoration: none;
                color: yellow;
                cursor: url('gpointer.png');
            }
            .new2b a:hover{
                color: lightgreen;
            }
            @media (min-width: 1900px){
                .con{
                    height: 100vh;
                }
            }
            @media (max-width: 700px){
                .logcon{
                    transform: scale(.85);
                    margin: 10px;
                    padding: 5px;
                }
                input{
                    width: 95%;
                }
                input[type='submit']{
                    width: 100%;

                }
                .footex{
                    display: block !important;
                }
            }
            @media (max-width: 500px){
                .logcon{
                    transform: scale(.8);
                    margin: 10px;
                }
            }
            @media (max-width: 400px){
                .logcon{
                    width: 100%;
                    height: auto;
                    transform: scale(.8);
                    margin: 10px;
                    padding: 20px;
                }
            }
        </style>
    </head>
    <body>
        <section class="main"  id="gotop">
            <?php include 'header.html' ?>
            <section class="con">
            <div id='logpg'>&nbsp</div>
                <h1 class="reghd">Log In</h1>
                <section class="logcon">
                    <form action="" method='GET'>
                        <img src="https://png.pngtree.com/png-vector/20230903/ourmid/pngtree-man-avatar-isolated-png-image_9935819.png" alt="">
                        <p class="imgl"></p>
                        <input type="email" name='email' placeholder="Email Id" required>
                        <input type="password" name='password' placeholder="Password" required>
                        <input type="submit" value="Log In">
                    </form>
                </section>
                <p class="new2b">No account yet? &nbsp<a href="signup.php#signpg">Create Account</a></p>
            </section>
            <?php include 'footer.html' ?>
        </section>
        <script>
            // document.querySelector('.acc').addEventListener('click', ()=>{
            //     document.querySelector('.dconi').classList.toggle('dshow');
            // });
            const newURL = window.location.protocol + "//" + window.location.host + "/php_files/blogsystem/login.php#logpg";
            window.history.pushState({ path: newURL }, '', newURL);
        </script>
    </body>
</html>


