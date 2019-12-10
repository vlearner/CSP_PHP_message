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

//$getMessage = "SELECT *
//                FROM Message2
//                ORDER BY MessageTime DESC limit 15;";


$chat = $dbConnect->prepare($getMessage);
$chat->execute();
$chatInfo = $chat->fetchAll();

//$chatInfo = $chat->fetchAll(PDO::FETCH_OBJ);
//print_r($chatInfo);
//foreach ($chatInfo as $row){
//    if($row['CustomerID'] == $fromMessage){
//         echo ( $row['MessageText'] . '<br>') ;
//    }
//}

//$chatInfo = $chat->fetchAll(PDO::FETCH_OBJ);
//$chatInfo = $chat->fetchAll();

    if(!empty($chatInfo)){
        foreach ($chatInfo as $chatDetail) {
            echo $chatDetail['MessageText'] . '<br>';
 }
    }





?>