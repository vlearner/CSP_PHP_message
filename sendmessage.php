<?php

session_start();
    //connect to data base
include('dbconnect.php');


$fromMessage = $_SESSION["id"];
$messageText = filter_input(INPUT_POST, 'message');

    try{

        $messageQuery =
            'INSERT INTO Message (CustomerID, EmployeeId, MessageText) 
                    VALUE (:id, 4, :message)';
        $stmt = $dbConnect->prepare($messageQuery);
        $stmt->bindValue(':id', $fromMessage);
        $stmt->bindValue(':message', $messageText);
        $stmt->execute();
        $stmt->closeCursor();
        header("location: message.php");
//        print_r($_POST);
    }catch (PDOException $e){
        echo sprintf("%s<br>%s", $messageQuery, $e);
    }

?>