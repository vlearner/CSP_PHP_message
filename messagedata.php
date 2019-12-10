<?php
session_start();
include_once'dbconnect.php';

$fromMessage = $_SESSION["id"];
$getMessage = "SELECT *
                FROM Message
                WHERE CustomerID = $fromMessage
                and EmployeeId = 4
                OR EmployeeId = 4
                AND CustomerID = $fromMessage
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