<!DOCTYPE html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <!-- link to stylesheet -->
<!--        <link rel="stylesheet" href="style.css">-->
    </head>
    <body">
        <?php 
            session_start();

            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                header("location: login.php");
                exit;
            }

        ?>
        <div class="container-fluid">
            <div class="jumbotron jumbotron-fluid">
                <h3 class="display-6 text-center" >Hello, <?php echo htmlspecialchars($_SESSION["username"] ); ?></h3>
            </div>





        <!-- Show chat message -->
        <div class="d-flex p-2 bd-highlight" style="
        width: auto;
        height: 260px;
        overflow: auto;"
        id="showMessage">
        </div>



<!--        -->
<!--         <div class="input-group">-->
<!--        <h4 class="alert-heading">Message</h4><wbr>-->
<!---->
<!--         </div>-->

            <?php include ('messageForm.php'); ?>
             <!--  Close chat to kill session  -->
             <div class="closeChatButton">
                 <a href="exit.php" class="btn btn-danger btn-lg btn-block">Close Chat</a>
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
    </div>
</html>