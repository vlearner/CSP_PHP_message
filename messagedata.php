<?php 
include_once'dbconnect.php';

$getMessage = "SELECT * FROM ChatApp.Message ORDER BY MessageId DESC LIMIT 10";
$chat = $dbConnect->prepare($getMessage);
$chat->execute();
$chatInfo = $chat->fetchAll();

    if(!empty($chatInfo)){
        foreach ($chatInfo as $chatDetail) { 
        echo $chatDetail['MessageText'] . '<br>'; 
 } 
    } 


?>