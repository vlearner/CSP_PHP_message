<?php
session_start();


include_once'dbconnect.php';


$fromMessage = $_SESSION["id"];
//$getMessage = "SELECT *
//                FROM Message2
//                WHERE SenderID = $fromMessage
//                and RecieverId = 5
//                OR SenderID = 5
//                and RecieverId = $fromMessage
//                ORDER BY MessageTime DESC;";

$getMessage = "SELECT * 
                FROM Message2 
                WHERE CustomerID = 1 
                and EmployeeId = 4 
                OR EmployeeId = 4 
                and CustomerID = 1 
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