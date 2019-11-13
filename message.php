<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php 
            session_start();

            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                header("location: login.php");
                exit;
            }

            // include('dbconnect.php');
            // if(isset($_POST['sendMessage'])){
            //     $messageText = $_POST['message'];
            //     try
            //     {   // include('dbconnect.php');
            //         $messageQuery = "INSERT INTO ChatApp.Message 
            //                                 ( MessageText )
            //                                 VALUES 
            //                                 ( '$messageText')";
            //         $dbConnect->exec($messageQuery);
            //     }
            //     catch(PDOException $e)
            //     {   
            //         echo $messageQuery .  . $e->getMessage();
            //     }
            // }
        
        ?> 
        <script type="text/javascript">

            $(document).ready(function(){
                $("#sendMessage").click(function () {
                    var message=$("#message").val();
                    $.ajax({
                        url: 'sendmessage.php',
                        method: 'POST',
                        data: {message:message,
                        success: function (data) {
                        alert(data);
                        }
                    });
                });
            });
      </script>
        <div class="page-header">
           <h1>Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1> 
        </div>

        <div id="showMessage"></div>
        <div class="closeChatButton">
        <a href="exit.php" class="btn btn-info">Close Chat</a>
         </div>

        <div class="input-group">
        <h4 class="alert-heading">Message:</h4><wbr>
        <!-- <form method="post" action="sendmessage.php" name="formMessage"> -->
          <form>
            <div class="message1">       
            <input class="form-control" type="message" name="message" id="message"> 
            <div class="input-group-append" id="button-addon4">
            <input class="btn btn-outline-secondary" name="submit" id="sendMessage" type="submit" value="Submit">
        </form>
        </div>
        </div>
    
        <script type="text/javascript">
   
                // get messages form database
// ONLY WORKS ON CHROME! NEED TO WORK ON FIREFOX AND SAFARI!
                $(document).ready(function(){
                    // event.preventDefault();
                    setInterval(function(){
                        $('#showMessage').load('messagedata.php')
                    }, 1000);
                });

        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>