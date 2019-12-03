<!DOCTYPE html>
<head>
    <!-- link to stylesheet -->
    <link rel="stylesheet"  type="text/css" href="style.css" />
</head>
<body style="">
<?php
session_start();
include('dbconnect.php');

//session_start();

$adminId = $_SESSION['id'];

$getUser = "SELECT * FROM ChatApp3.User WHERE UserId != :id ";
$stmt = $dbConnect->prepare($getUser);
$stmt->bindValue(':id', $adminId);
$stmt->execute();
$result= $stmt->fetchAll(PDO::FETCH_ASSOC);
//print_r($result);

print "<table wdith=\"100%\">\n";
print "<tr>\n";
// add the table headers
foreach ($result[0] as $key => $useless){
    print "<th>$key</th>";
}
print "</tr>";
// display data
foreach ($result as $row){
    print "<tr>";
    foreach ($row as $key => $val){
        print "<td>$val</td>";

    }
    print "</tr>\n";
}
// close the table
print "</table>\n";



function fetch_user_chat_history($from_user_id, $to_user_id, $dbConnect)
{
//    $query = "
//	SELECT MessageText, SenderId FROM ChatApp3.Message
//	WHERE (SenderId = '" . $from_user_id . "'
//	AND RecieverId = '" . $to_user_id . "')
//	OR (RecieverId = '" . $to_user_id . "'
//	AND SenderId = '" . $from_user_id . "')
//	ORDER BY MessageTime DESC
//	";

    $query = "
	SELECT MessageText, SenderId FROM ChatApp3.Message 
	WHERE (SenderId = '" . $from_user_id . "')  
	ORDER BY MessageTime DESC
	";
    $statement = $dbConnect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    print_r($result);
//    print "<table wdith=\"100%\">\n";
//    print "<tr>\n";
//// add the table headers
//    foreach ($result[0] as $key => $useless){
//        print "<th>$key</th>";
//    }
//    print "</tr>";
//    foreach ($result as $row){
//        print "<tr>";
//        foreach ($row as $key => $val){
//            print "<td>$val</td>";
//        }
//        print "</tr>\n";
//    }
//    // close the table
//    print "</table>\n";
}

echo fetch_user_chat_history(2,5,$dbConnect);

$getUser = "Select * From ChatApp3.User ORDER BY UserId;";
$chatUser = $dbConnect->query($getUser);



?>
<!--<div class="page-header">-->
<!--    <h1>Hi, --><?php //echo htmlspecialchars($_SESSION["id"] ); ?><!--</h1>-->
<!--</div>-->


<!-- Show chat message -->
<!--<div style="-->
<!--        width: 250px;-->
<!--        height: 150px;-->
<!--        overflow: auto;"-->
<!--     id="showMessage">-->
<!--</div>-->

<?php
foreach ($result as $row => $link) {
    echo  '<a href="'.  $link['UserId'].'">' . $link['UserName']. '</a></br>';
}


?>

<div id="sidebar">
    <!-- display a list of chat users -->
    <h2>Chat User</h2>
    <ul class="nav">
        <?php foreach ($chatUser as $user) : ?>
            <li>
                <a href="?category_id=<?php echo $user['UserId']; ?>">
                    <?php echo $user['UserName']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php //include('adminsendmessage.php') ?>
<!--  Close chat to kill session  -->
<div class="closeChatButton">
    <a href="exit.php" class="btn btn-info">Close Chat</a>
</div>


<div class="input-group">
    <h4 class="alert-heading">Message:</h4><wbr>


    <?php include ('admimessageForm.php'); ?>



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