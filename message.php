<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
     

        <?php 
        include('dbconnect.php');
                if(isset($_POST['sendMessage'])){
                    $messageText = $_POST['message'];
                    try
                    {
                        // include('dbconnect.php');
                        $messageQuery = "INSERT INTO ChatApp.Message (MessageText)
                                    VALUES ('$messageText')";

                         $dbConnect->exec($messageQuery);
                         echo "New message recorded!";
                
                    }
                    catch(PDOException $e)
                    {   
                        echo $messageQuery . "<br>" . $e->getMessage();
                    }
            }

            //select query!!
            // $getMessage = "SELECT MessageTEXT FROM ChatApp.Message ORDER BY MessageId DESC";
            // $statement = $dbConnect->prepare($getMessage);
            // $statement->execute();
            // $articles = $statement->fetchAll();
            // // $statement->closeCursor();
            // foreach(new tableRows (new RecursiveArrayIterator($statement->fetchAll()))
            //         as $k=>$v){
            //             echo $v;
            //         }

            // $conn =$dbConnect;
            // $getMessage = "SELECT MessageTEXT FROM ChatApp.Message ORDER BY MessageId DESC";
            // $rs=mysqli_query($conn, $getMessage);
            // $count = mysqli_num_rows($rs);
            // if($count > 0){
            //     while($row){
            //         while($row = mysqli_fetch_array($rs)){
            //             echo $row['message'] . "<br>";
            //         }
            //     }
            // }
            

            // $result = $dbConnect->prepare("SELECT MessageTEXT FROM ChatApp.Message ORDER BY MessageId DESC"); 
            // $result->execute();
            // $row_count =var_dump($result->fetchAll());
            // echo var_dump($row_count);
        

                $getMessage = "SELECT * FROM ChatApp.Message ORDER BY MessageId DESC";
                $chat = $dbConnect->prepare($getMessage);
                $chat->execute();
             // $chat = $dbConnect->execute($getMessage);
                $chatInfo = $chat->fetchAll();
                // $chat = $chat->fetchALL();
        
        ?>


           
           
          <script src="" async defer>
            function sendmessage(){
                var message =  formMessage.message.value;
                var xmlHttp = new XMLHttpRequest();

                xmlHttp.onreadystatechange = function(){
                    if(xmlHttp.readyState == 4 && xmlHttp.status == 200){
                        document.getElementsByClassName('showMessage').innerHTML = xmlHttp.responseText;
                
                    }
                }

                
                xmlHttp.open('GET', 'insert.php?message='+message, true);
                xmlHttp.send();
            }
        </script>


          <div>
             <form method="post" action="message.php" name="formMessage">
                <div class="message">
                    Message: <input type="text" name="message"><br>
                    <input name="sendMessage" type="submit">
                </div>
            </form>
        </div>
        <h4>Note</h4>
    
            <tbody>
        <?php
        if(!empty($chatInfo)){
            foreach ($chatInfo as $chatDetail) { ?>
            <tr class="table-row">
                <td>
                       <?php echo $chatDetail['MessageText']; ?> <br>
                </td>
            </tr>
                   
            <?php } 
                } 
                ?>
        </tbody>
    
        
        <script src="" async defer>
            function sendmessage(){
                var message =  formMessage.message.value;
                var xmlHttp = new XMLHttpRequest();

                xmlHttp.onreadystatechange = function(){
                    if(xmlHttp.readyState == 4 && xmlHttp.status == 200){
                        document.getElementsByClassName('showMessage').innerHTML = xmlHttp.responseText;
                
                    }
                }

                
                xmlHttp.open('GET', 'insert.php?message='+message, true);
                xmlHttp.send();
            }
        </script>
    </body>
</html>