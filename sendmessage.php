<?php

session_start();
    //connect to data base
include('dbconnect.php');

//$sendToMessage = filter_input(INPUT_POST, 'SenderId');
//$fromMessage = $_SESSION["id"];
$messageText = filter_input(INPUT_POST, 'message');

    try{
//        $messageQuery =
//            'INSERT INTO Message2 (SenderId, RecieverId, MessageText)
//                    VALUE (:id, 4, :message)';
        $messageQuery =
            'INSERT INTO Message2 (CustomerID, EmployeeId, MessageText) 
                    VALUE (1, 4, :message)';
        $stmt = $dbConnect->prepare($messageQuery);
//        $stmt->bindValue(':id', $fromMessage);
        $stmt->bindValue(':message', $messageText);
        $stmt->execute();
        $stmt->closeCursor();
        header("location: message.php");
//        print_r($_POST);
    }catch (PDOException $e){
        echo sprintf("%s<br>%s", $messageQuery, $e);
    }

?>