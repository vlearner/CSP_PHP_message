<?php
session_start();


include_once'dbconnect.php';


$fromMessage = $_SESSION["id"];
$getMessage = "SELECT * 
                FROM ChatApp3.Message 
                WHERE SenderID = $fromMessage 
                and RecieverId = 5 
                OR SenderID = 5 
                and RecieverId = $fromMessage 
                ORDER BY MessageTime DESC;";
$chat = $dbConnect->prepare($getMessage);
$chat->execute();
$chatInfo = $chat->fetchAll();

    if(!empty($chatInfo)){
        foreach ($chatInfo as $chatDetail) { 
        echo $chatDetail['MessageText'] . '<br>'; 
 } 
    }



?>