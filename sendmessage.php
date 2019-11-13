<?php

include('dbconnect.php');

if(isset($_POST['sendMessage'])){
    // include('dbconnect.php');
    $messageText = $_POST['message'];
    try
    {  
         include('dbconnect.php');
        $messageQuery = "INSERT INTO ChatApp.Message 
                                ( MessageText )
                                VALUES 
                                ( '$messageText')";
        $dbConnect->exec($messageQuery);
        echo "Form Submitted Succesfully";
    }
    catch(PDOException $e)
    {   
        echo $messageQuery . "<br>" . $e->getMessage();
    }
}



?>