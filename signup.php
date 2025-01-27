<?php
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
                background: url('https://static.vecteezy.com/system/resources/previews/019/523/927/non_2x/abstract-digital-fingerprint-login-concept-identity-verification-illustration-with-digital-hand-wireframe-security-protection-on-a-futuristic-modern-background-vector.jpg');
                background-attachment: fixed;
                background-position: top;
                background-repeat: no-repeat;
                background-size: cover;
                direction: ltr;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .con h1{
                font-family: Arial, Helvetica, sans-serif;
                color: white;
                font-size: 50px;
                margin-top: 120px;
            }
            #signpg{
                margin-top: 100px;
            }
            .signcon{
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 50px auto;
                padding: 5px;
                box-shadow: 0 0 10px white;
                border-radius: 20px;
            }
            .signcon section{
                padding: 20px;
                width: 400px;
                height: 400px;
                background-color: rgba(255, 255, 255, .2);
                margin: 40px;
                border-radius: 10px;
                display: flex;
                justify-content: center;
                flex-direction: column;
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
                width: 95%;
                background-color: white;
                box-shadow: none;
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
            .signimage img{
                width: 100%;
                border-radius: 50%;
                box-shadow: 0 0 10px white;
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
                color: springgreen;
                cursor: url('gpointer.png');
            }
            .new2b a:hover{
                color: yellow;
            }
            .error {
                font-family: Arial, Helvetica, sans-serif;
                color: white;
                font-size: 0.9em;
            }
            .valid {
                font-family: Arial, Helvetica, sans-serif;
                color: springgreen;
                font-size: 0.9em;
            }
            @media (min-width: 1800px){
                .con{
                    height: 100vh;
                }
            }
            @media (max-width: 1100px){
                .signcon{
                    transform: scale(.85);
                    width: 90%;
                }
                .signcon section{
                    margin: 20px;
                }
            }
            @media (max-width: 700px){
                .signcon{
                    transform: scale(.85);
                    width: 90%;
                }
                .signcon section{
                    margin: 5px;
                }
            }
            @media (max-width: 600px){
                .signcon{
                    transform: scale(.85);
                    width: 95%;
                    border-radius: 5px;
                    flex-direction: column;
                }
                .signcon section{
                    background-color: transparent;
                    margin: 0px;
                    border-radius: 0;
                }
                .signimage img{
                    width: 70%;
                }
            }
            @media (max-width: 500px){
                .signcon{
                    transform: scale(1);
                    width: 90%;
                    box-shadow: none;
                    border-radius: 5px;
                    flex-direction: column;
                }
                .signcon section{
                    width: 100%;
                    height: auto;
                    margin: 0px;
                    border-radius: 0;
                }
                .signimage img{
                    width: 70%;
                }
            }
        </style>
    </head>
    <body>
        <section class="main"  id="gotop">
            <?php include 'header.html' ?>
            <section class="con">
                <div id='signpg'>&nbsp</div>
                <h1 class="reghd">Sign In</h1>
                <section class="signcon">
                    <section class="signimage">
                        <img src="https://png.pngtree.com/png-vector/20230903/ourmid/pngtree-man-avatar-isolated-png-image_9935819.png" alt="">
                    </section>
                    <section class="signform">
                        <form action="" method='GET' id="registerForm">
                            <input type="text" name='fullname' placeholder="Full Name" required>
                            <input type="email" name='email' id='email' placeholder="Mail Address" required>
                            <p id="emailFeedback" class="error"></p>
                            <input type="password" name='password' placeholder="Set Password" title="Password must contain atleast 8 characters" pattern="[A-Za-z\d@$!%*?&]{8,10}" required>
                            <input type="password" name='cpassword' placeholder="Confirm Password" required>
                            <input type="submit" value="Sign In" required>
                        </form>
                    </section>
                </section>
                <p class="new2b">Already have an account? &nbsp<a href="login.php#logpg">Log In</a></p>
            </section>
            <?php include 'footer.html' ?>
        </section>
        <script>
            const newURL = window.location.protocol + "//" + window.location.host + "/php_files/blogsystem/signup.php#signpg";
            window.history.pushState({ path: newURL }, '', newURL);
        </script>
        <!-- <script>
            document.getElementById('registerForm').addEventListener('submit', async function (event) {
                event.preventDefault();  // Prevent the form from submitting immediately

                const email = document.getElementById('email').value;
                const feedback = document.getElementById('emailFeedback');

                // Only validate email if it's not empty
                if (email.trim() === "") {
                    feedback.textContent = "Please enter an email!";
                    feedback.className = 'error';
                    return;
                }

                // ZeroBounce API Key (Replace with your actual key)
                const apiKey = '400732453a874cf6b34dc7d1f96bb005';  // Replace with your ZeroBounce API key
                const apiUrl = `https://api.zerobounce.net/v2/validate?api_key=${apiKey}&email=${encodeURIComponent(email)}`;

                try {
                    // Make the API request
                    const response = await fetch(apiUrl);
                    const data = await response.json();

                    // Check the email validation result
                    if (data.status === 'valid') {
                        // Show valid feedback
                        feedback.textContent = "Valid email!";
                        feedback.className = 'valid';

                        // Submit the form after validation
                        document.getElementById('registerForm').submit();
                    } else {
                        // Show invalid feedback and alert
                        feedback.textContent = "Invalid email!";
                        feedback.className = 'error';
                        alert("Please enter a valid email before submitting!");
                    }
                } catch (error) {
                    console.error("Error validating email:", error);
                    feedback.textContent = "Error validating email!";
                    feedback.className = 'error';
                    alert("There was an error validating the email!");
                }
            });
        </script> -->
        <script>
            document.getElementById('email').addEventListener('input', function () {
                const email = this.value;
                const feedback = document.getElementById('emailFeedback');

                // Regular expression for validating email format
                const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

                // Validate basic email format
                if (!emailRegex.test(email)) {
                    feedback.textContent = "Invalid email format!";
                    feedback.className = 'error';
                    return;
                }

                // Extract the subdomain (local part before @)
                const subdomain = email.split('@')[0];
                const subdomainRegex = /^(?!.*\.\.)(?!.*__)[a-zA-Z0-9]+(?:[._]?[a-zA-Z0-9]+)*$/;

                // Validate subdomain rules
                if (!subdomainRegex.test(subdomain)) {
                    feedback.textContent = "Subdomain must be alphanumeric, may include '_' or '.', but not consecutively!";
                    feedback.className = 'error';
                    return;
                }

                // Extract domain part (after @)
                const domain = email.split('@')[1];
                const allowedDomains = [
                    "gmail.com", "yahoo.com", "outlook.com", "hotmail.com", "icloud.com", "aol.com", 
                    "protonmail.com", "zoho.com", "mail.com", "gmx.com", "yandex.com", "fastmail.com", 
                    "msn.com", "live.com", "rediffmail.com", "qq.com", "126.com", "163.com", "tutanota.com", 
                    "hushmail.com", "inbox.com", "lycos.com", "me.com", "optonline.net", "comcast.net", 
                    "verizon.net", "att.net", "charter.net", "shaw.ca", "btinternet.com", "sky.com", 
                    "virginmedia.com", "cox.net", "sympatico.ca", "sbcglobal.net", "bellsouth.net", 
                    "earthlink.net", "rogers.com", "frontier.com", "netscape.net", "aim.com", "wanadoo.fr", 
                    "orange.fr", "sfr.fr", "free.fr", "laposte.net", "alice.it", "libero.it", "virgilio.it", 
                    "tiscali.it", "tin.it", "email.it", "poste.it", "teletu.it", "web.de", "t-online.de", 
                    "freenet.de", "gmx.de", "arcor.de", "bluewin.ch", "swissmail.ch", "seznam.cz", 
                    "centrum.cz", "volny.cz", "mail.ru", "bk.ru", "list.ru", "inbox.ru", "rambler.ru", 
                    "ya.ru", "tut.by", "ukr.net", "i.ua", "bigmir.net", "meta.ua", "onet.pl", "o2.pl", 
                    "wp.pl", "interia.pl", "neostrada.pl", "home.pl", "gazeta.pl", "tlen.pl", "op.pl", 
                    "abv.bg", "mail.bg", "dir.bg", "eurodir.bg", "hotmail.co.uk", "yahoo.co.uk", 
                    "live.co.uk", "btconnect.com", "talk21.com", "virgin.net", "ukgateway.net", 
                    "eircom.net", "eir.ie", "hotmail.ca", "yahoo.ca", "sympatico.ca", "rogers.ca", 
                    "bell.net", "videotron.ca", "telus.net", "primus.ca", "shaw.ca", "hotmail.com.au", 
                    "yahoo.com.au", "bigpond.com", "optusnet.com.au", "iinet.net.au", "dodo.com.au", 
                    "internode.on.net", "tpg.com.au", "live.com.au", "aapt.net.au", "westnet.com.au", 
                    "hotmail.co.nz", "yahoo.co.nz", "xtra.co.nz", "ihug.co.nz", "clear.net.nz", 
                    "paradise.net.nz", "vodafone.net.nz", "orcon.net.nz", "slingshot.co.nz", 
                    "hotmail.co.in", "yahoo.co.in", "rediffmail.com", "sify.com", "indiatimes.com", 
                    "airtelmail.in", "vsnl.net", "broadbandindia.com", "reliancemail.com", 
                    "tatateleservices.com", "china.com", "sina.com", "sina.cn", "qq.com", "vip.qq.com", 
                    "foxmail.com", "126.com", "163.com", "yeah.net", "sohu.com", "21cn.com", 
                    "tom.com", "aliyun.com", "aliyun.cn", "sogou.com", "yahoo.com.cn", 
                    "yahoo.com.hk", "yahoo.co.jp", "hotmail.jp", "outlook.jp", "docomo.ne.jp", 
                    "ezweb.ne.jp", "auone.jp", "biglobe.ne.jp", "nifty.com", "ocn.ne.jp", 
                    "ybb.ne.jp", "plala.or.jp", "hotmail.co.kr", "yahoo.co.kr", "naver.com", 
                    "daum.net", "hanmail.net", "korea.com", "dreamwiz.com", "empas.com", 
                    "lycos.co.kr", "live.co.kr", "hotmail.com.mx", "yahoo.com.mx", "prodigy.net.mx", 
                    "live.com.mx", "hotmail.com.ar", "yahoo.com.ar", "fibertel.com.ar", 
                    "ciudad.com.ar", "arnet.com.ar", "hotmail.com.br", "yahoo.com.br", 
                    "bol.com.br", "terra.com.br", "uol.com.br", "ig.com.br", "itelefonica.com.br", 
                    "r7.com", "globo.com", "globomail.com", "oi.com.br", "hotmail.co.za", 
                    "yahoo.co.za", "vodamail.co.za", "mweb.co.za", "telkomsa.net", 
                    "hotmail.com.tr", "yahoo.com.tr", "superonline.com", "ttmail.com", 
                    "turk.net", "posta.net", "hotmail.ru", "yandex.ru", "mail.ru", "bk.ru", 
                    "inbox.ru", "list.ru", "rambler.ru", "land.ru", "pochta.ru", "hotmail.gr", 
                    "yahoo.gr", "otenet.gr", "forthnet.gr", "cytanet.com.cy", "spidernet.com.cy", 
                    "cablenet.com.cy", "primetel.com.cy", "hotmail.ie", "yahoo.ie", "eircom.net", 
                    "oceanfree.net", "indigo.ie", "iol.ie", "hotmail.sg", "yahoo.com.sg", 
                    "pacific.net.sg", "singnet.com.sg", "starhub.net.sg", "m1.com.sg", 
                    "hotmail.my", "yahoo.com.my", "tm.net.my", "jaring.my", "time.net.my", 
                    "hotmail.ph", "yahoo.com.ph", "live.com.ph", "pldt.com", "gmail.ph", 
                    "skydsl.net.ph", "dostmail.com", "hotmail.vn", "yahoo.com.vn", "vnn.vn", 
                    "hcm.fpt.vn", "hcm.vnn.vn", "hanoi.fpt.vn", "saigonnet.vn", "hn.vnn.vn", 
                    "hotmail.id", "yahoo.co.id", "indosat.net.id", "cbn.net.id", 
                    "plasa.com", "telkom.net.id", "biz.net.id", "rad.net.id", 
                    "usatoday.com", "consultant.com", "engineer.com", "accountant.com", 
                    "scientist.com", "teacher.com", "musician.org", "usa.net", 
                    "europe.com", "asia.com", "iname.com", "iname.net", "keemail.me"
                ];

                // Validate against allowed domains
                if (!allowedDomains.includes(domain)) {
                    feedback.textContent = `Domain '${domain}' is not allowed!`;
                    feedback.className = 'error';
                    return;
                }

                // If all checks pass
                feedback.textContent = "Valid email!";
                feedback.className = 'valid';
            });

            // Prevent submission if email is invalid
            document.getElementById('registerForm').addEventListener('submit', function (event) {
                const feedback = document.getElementById('emailFeedback');
                if (feedback.textContent !== "Valid email!") {
                    alert("Please enter a valid email before submitting!");
                    event.preventDefault();
                }
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    </body>
</html>
<?php
    $conn=new mysqli("localhost", "root", "", "registration_db");
    if ($conn->connect_error){
        die("Connection Error". conn->connect_error);
    }

    if (isset($_GET['fullname'], $_GET['email'], $_GET['password'], $_GET['cpassword'])) {
        $name = $_GET['fullname'];
        $email = $_GET['email'];
        $password = $_GET['password'];
        $cpassword = $_GET['cpassword'];
        $activation_token = bin2hex(random_bytes(16));
        if ($password !== $cpassword){
            echo "<script>alert('Password Unmatched');</script>";
        }
        else{
            $hpassword = password_hash($_GET['password'], PASSWORD_BCRYPT);

            $sql = "INSERT INTO blogregister (fullname, email, password, cpassword, activation_token) VALUES ('$name', '$email', '$hpassword', '$cpassword', '$activation_token')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Account Registered');</script>";
                $activation_link = "http://localhost/php_files/blogsystem/signup.php?token=" . $activation_token;
                echo "<script>
                    emailjs.init('DyZSiX4vJBakraM-t');
                    const templateParams = {
                        to_name: '$name',
                        to_email: '$email',
                        activation_link: '$activation_link'
                    };
                    emailjs.send('service_tyufxhq', 'template_asmfr8f', templateParams)
                        .then(response => {
                            console.log('SUCCESS!', response.status, response.text);
                            alert('Activation mail sent successfully to $email!');
                        })
                        .catch(error => {
                            console.error('FAILED...', error);
                            alert('Failed to send welcome email.'+ JSON.stringify(error));
                        });
                </script>";
            } else {
                echo "<script>Error:  . $sql . <br> . $conn->error</script>";
            }
        }
    }
?>
<?php
$conn=new mysqli("localhost", "root", "", "registration_db");
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database
    $sql = "SELECT * FROM blogregister WHERE activation_token = '$token'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Activate the user (e.g., mark as active)
        $sql = "UPDATE blogregister SET activation_token = 'activated' WHERE activation_token = '$token'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Activation Confirmed');</script>";
            echo "<script>window.location.href='login.php#logpg';</script>";
        } else {
            echo "<script>alert('Error in Activation');</script>";
        }
    } else {
        echo "Invalid or expired activation token.";
    }
}
?>