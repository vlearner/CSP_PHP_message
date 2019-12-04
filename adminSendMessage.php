<?php

if (!isset($_SESSION)) { session_start();}

$UserId = $_POST['UserID'];
$fromMessage = $_SESSION['id'];
$messageText = $_POST['message'];

try{
    require_once('dbconnect.php');
    $messageQuery =
        "INSERT INTO ChatApp3.Message (SenderId, RecieverId, MessageText)
                    VALUE(:id, :UserID, :message)";
    $stmt = $dbConnect->prepare($messageQuery);
    $stmt->bindValue(':id', $fromMessage);
    $stmt->bindValue(':UserID', $UserId);
    $stmt->bindValue(':message', $messageText);
    $stmt->execute();
    echo "Message send";
        print_r($_POST);
}catch (PDOException $e){
    echo sprintf("%s<br>%s", $messageQuery, $e);
}

?>