<!DOCTYPE html>
<html>
    <head>
        <title>Thank you</title>
    </head>
    <body style="text-align:center">
    <?php
        session_start();
        // Unset all of the session variables
        $_SESSION = array();
        session_destroy();
        // exit;
    ?>
    <h4>Thank you for connecting with us</h4>
    <p>Please select a seller to process the report.<br/>This window will close automatically within <span id="counter">5</span> second(s).</p>
    <script type="text/javascript">
        function countdown() {
            var i = document.getElementById('counter');
            i.innerHTML = parseInt(i.innerHTML)-1;
            if (parseInt(i.innerHTML)<=0) {
                window.close();
            }
        }
        setInterval(function(){ countdown(); },500);
    </script>
    </body>
</html>
