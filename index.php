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
            *{
                margin: 0;
                padding: 0;
                cursor: url('gcursor1.png'), auto;
                /* scroll-behavior: smooth; */
            }
            body{
                display: flex;
                align-items: flex-start;
                justify-content: center;
                overflow-x: hidden;
            }
            .main{
                display: flex;
                flex-direction: column;
                height: auto;
                width: 100%;
                max-width: 1600px;
                min-width: 240px;
                /* box-shadow: 0 0 5px grey; */
                
            }
            
        </style>
    </head>

    <body>
        <section class="main"  id="gotop">
            <?php
                include "header.html"
            ?>
            
            <?php include "body.html" ?>

            <?php
                include "footer.html"
            ?>

        </section>

    </body>
</html>
