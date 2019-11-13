<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
       
        <!-- link to stylesheet -->
        <link rel="stylesheet" href="style.css">
    </head>
    <body style="text-align: center;">
        <?php 
            session_start();

            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                header("location: login.php");
                exit;
            }
        
        ?> 
        <script type="text/javascript">

            $(document).ready(function(){
                    

                $('form').submit(function(event) {
                    // Stop the browser from submitting the form.
                    event.preventDefault();
                    var insertMessage = {
                        'message' : $('input[message=message]').val()
                    }

                    // var insertMessage = 'message='+message;
                    $.ajax({
                        method: 'POST',
                        url: 'sendmessage.php',
                        data: insertMessage,
                        dataType    : 'json', // what type of data do we expect back from the server
                        encode          : true
                    })
                    .done(function(data) {

                        // log data to the console so we can see
                        console.log(data + "hi"); 

                        // here we will handle errors and validation messages
                    });
                });
            });


            jQuery(document).ready(function(){
                 jQuery('.scrollbar-inner').scrollbar();
            });

            
      </script>
        <div class="page-header">
           <h1>Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1> 
        </div>

        <!-- Show chat message -->
        <div style="
        width: 250px;
        height: 150px;
        overflow: auto;"
        id="showMessage">
        </div>

        <!--  Close chat to kill session  -->
        <div class="closeChatButton">
        <a href="exit.php" class="btn btn-info">Close Chat</a>
         </div>

        
         <div class="input-group">
        <h4 class="alert-heading">Message:</h4><wbr>
        <!-- <form method="post" action="sendmessage.php" name="formMessage"> -->
          <form enctype="application/x-www-form-urlencoded" method="POST">
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