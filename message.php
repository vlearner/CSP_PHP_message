 <?php
            include('style.html');

            session_start();

            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                header("location: login.php");
                exit;
            }
?>
        <body>
        <div class="container-fluid">
            <div class="jumbotron jumbotron-fluid">
                <h3 class="display-6 text-center" >Hello, <?php echo htmlspecialchars($_SESSION["username"] ); ?></h3>
            </div>
            <!-- Show chat message -->
            <div class="d-flex p-2 bd-highlight" style="
        width: auto;
        height: 290px;
        overflow: auto;"
                 id="showMessage">
            </div>
            <?php include ('messageForm.php'); ?><br><br>
            <!--  Close chat to kill session  -->
            <div class="closeChatButton">
                <a href="exit.php" class="btn btn-danger btn-lg btn-block">Close Chat</a>
            </div>
        </div>
  <?php include_once('script.html');?>