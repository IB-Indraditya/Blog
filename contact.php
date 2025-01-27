<?php
    if (isset($_GET['name'], $_GET['contact'], $_GET['mail'], $_GET['message'])){
        $name=$_GET['name'];
        $contact=$_GET['contact'];
        $mail=$_GET['mail'];
        $message=$_GET['message'];
        $con=new mysqli("localhost", "root", "", "registration_db");
        
        $sql="INSERT INTO blogcontact (name, contact, mail, message) VALUES (?, ?, ?, ?)";
        $stmt=$con->prepare($sql);
        $stmt->bind_param('ssss', $name, $contact, $mail, $message);
        if ($stmt->execute()){
            echo "<script>alert('Message Sent to Admin');</script>";
           header('Location: index.php#contactsec');
        }
        else{
            echo "<script>alert('Something went wrong !');</script>";
        }
    }
?>
