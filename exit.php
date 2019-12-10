 <?php
        session_start();
        // Unset all of the session
        $_SESSION = array();
        session_destroy();
        header('location: http://csp-teama-capstone.com/home.php');
?>

