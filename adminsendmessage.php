<?php


//connect to data base
include('dbconnect.php');
session_start();

//$sendToMessage = filter_input(INPUT_POST, 'SenderId');
$fromMessage = $_SESSION["id"];
$messageText = filter_input(INPUT_POST, 'message');



try{
    $messageQuery =
        'INSERT INTO ChatApp3.Message (SenderId, RecieverId, MessageText) 
                    VALUE (5, 1, :message)';
    $stmt = $dbConnect->prepare($messageQuery);
//    $stmt->bindValue(':id', $fromMessage);
    $stmt->bindValue(':message', $messageText);
    $stmt->execute();
    $stmt->closeCursor();
    header("location: message.php");
//        print_r($_POST);
}catch (PDOException $e){
    echo sprintf("%s<br>%s", $messageQuery, $e);
}

?>