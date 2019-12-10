<!DOCTYPE html>
<html>
    <head>
        <title>Thank you</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        
    <?php
        session_start();
        // Unset all of the session
        $_SESSION = array();
        session_destroy();
        header('location: http://csp-teama-capstone.com/home.php');
    ?>

    <div style="text-align: center;">
        <h4>Thank you for connecting with us</h4>
        <p>This window will close automatically within 
        <span id="counter">5</span> second(s).</p>

    </div>


    <script type="text/javascript" src="mscript.js" ></script>
    </body>
</html>
