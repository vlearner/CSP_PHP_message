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
                if(isset($_POST['sendMessage'])){
                    $messageText = $_POST['massage'];
                    try
                    {
                        include('dbconnect.php');
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
        
        
        ?>


          <div>
             <form method="post" action="message.php">
                <div class="message">
                    Message: <input type="text" name="massage"><br>
                    <input name="sendMessage" type="submit">
                </div>
            </form>
        </div>
        <h4>Note</h4>
        <h5>Change database structure</h5>


        <div>
            <input type="area" class="showMessage" disabled placeholder="Message Loading...">
        </div>
        
        <script src="" async defer></script>
    </body>
</html>