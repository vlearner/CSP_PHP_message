<?php
    //connect to data base
include('dbconnect.php');

$messageText = filter_input(INPUT_POST, 'message');



    try{
        $messageQuery =
            'INSERT INTO ChatApp65.Message (MessageText) 
                    VALUE (:message)';
        $stmt = $dbConnect->prepare($messageQuery);
        $stmt->bindValue(':message', $messageText);
        $stmt->execute();
        $stmt->closeCursor();
        header("location: message.php");
//        print_r($_POST);
    }catch (PDOException $e){
        echo sprintf("%s<br>%s", $messageQuery, $e);
    }

?>