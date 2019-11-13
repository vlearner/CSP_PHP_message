<?php
// include('dbconnect.php');

// // if(isset($_POST['sendMessage'])){
//     // include('dbconnect.php');
//     $messageText = $_POST['message'];
//    //  include('dbconnect.php');
//         $messageQuery = "INSERT INTO ChatApp65.Message 
//                                 ( MessageText )
//                                 VALUES 
//                                 ( '$messageText')";
//         if($dbConnect->exec($messageText) === TRUE){
//             echo "Form Submitted Succesfully";
//         }else{
//             echo "failed";
//         }

        
        // $dbConnect->exec($messageQuery);
      

   
  include('dbconnect.php');
            // if(isset($_POST['sendMessage'])){
                $messageText = isset($_POST['message']);
                try
                {   
                    // include('dbconnect.php');
                    $messageQuery = "INSERT INTO ChatApp65.Message 
                                            ( MessageText )
                                            VALUE
                                            ('$messageText')";
                    $dbConnect->exec($messageQuery);
                    echo json_encode("json " . $messageQuery);
                    print_r($_POST);
                    
                }
                catch(PDOException $e)
                {   
                    echo $messageQuery . "</br>" . $e->getMessage();
                }

                
            // }



?>