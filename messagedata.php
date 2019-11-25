<?php 
include_once'dbconnect.php';
//SELECT * FROM Message WHERE SenderID = 1 and RecieverId = 5 OR SenderID = 5 and RecieverId = 1 ORDER BY MessageTime DESC;

$getMessage = "SELECT * 
                FROM ChatApp3.Message 
                WHERE SenderID = 1 
                and RecieverId = 5 
                OR SenderID = 5 
                and RecieverId = 1 
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