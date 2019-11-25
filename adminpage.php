<!DOCTYPE html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- link to stylesheet -->
    <link rel="stylesheet" href="style.css">
</head>
<body style="text-align: center;">
<?php
include_once'dbconnect.php';
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//    header("location: login.php");
//    exit;
//}
//$selectQuery = "SELECT UserId, UserName, UserEmail
//                                        FROM ChatApp3.User
//                                        WHERE UserId = '5'";
//$res = $dbConnect->query($selectQuery);
//
//if($res->num_rows > 0){
//    echo "<table>
//<tr>
//    <th>User ID</th>
//    <th>name</th>
//    <th>Email</th>
//</tr>
//    ";
//    while ($row = $res->fetchAll()){
//        echo "<tr><td>".$row['UserId']."</td><td>".$row['UserName']."</td><td>".$row['UserEmail']."</td></tr>";
//    }
//    echo "</table>";
//}else{
//    echo "No user found";
//}


$stmt = $dbConnect->prepare("SELECT UserId, UserName, UserEmail 
                                     FROM ChatApp3.User 
                                        WHERE UserId = '5'");
$stmt->execute();
$res = $stmt->setFetchMode(\PDO::FETCH_ASSOC);
print_r($res);


?>
<!--<div class="page-header">-->
<!--    <h1>Hi, --><?php //echo htmlspecialchars($_SESSION["id"] ); ?><!--</h1>-->
<!--</div>-->


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


    <?php include ('messageForm.php'); ?>

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