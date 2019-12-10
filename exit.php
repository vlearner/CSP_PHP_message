 <?php
        session_start();
        // Unset all of the session
        $_SESSION = array();
        session_destroy();
//      !!!!!!!!!  Remove below code
        header('location: http://csp-teama-capstone.com/home.php');
//      !!!!!!!!!  Remove above code

// ##### Comment out below code
//        header('location: home.php');
 // ######## Comment out above code
?>

