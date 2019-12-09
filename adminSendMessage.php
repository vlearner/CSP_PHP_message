<?php

if (!isset($_SESSION)) { session_start();}
//Remove unwanted Notice error
error_reporting( error_reporting() & ~E_NOTICE );


require('dbconnect.php');

//Get data
//$fromMessage = $_SESSION['id'];
$UserId = $_POST['user_ID'];
$messageText = $_POST['message'];

//avoid saving empty data in to database
if(empty($messageText)){
    include_once ('adminMessageForm.php');
}else {

//    Save message into databse
    if (isset($_POST['sendMessage'])) {

        try {

            $messageQuery =
                "INSERT INTO Message2 (EmployeeId, CustomerID, MessageText)
                    VALUE(4, :user_ID, :message)";
            $stmt = $dbConnect->prepare($messageQuery);
//            $stmt->bindValue(':id', $fromMessage);
            $stmt->bindValue(':user_ID', $UserId);
            $stmt->bindValue(':message', $messageText);
            $stmt->execute();
            header("location: adminMessageForm.php");
//            echo "Message send";
//            print_r($_POST)

        } catch (PDOException $e) {
            echo sprintf("%s<br>%s", $messageQuery, $e);

        }
    }

}


?>





