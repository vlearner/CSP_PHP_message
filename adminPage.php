<!DOCTYPE html>
<head>
    <!-- link to stylesheet -->
    <link rel="stylesheet"  type="text/css" href="style.css" />
</head>
<body style="">
<?php
//    $userId = 1;
if (!isset($_SESSION)) { session_start();}


include('dbconnect.php');
//$adminId = $_SESSION['id'];

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: adminLogIn.php");
    exit;
}

$adminId = $_SESSION['id'];


if(!isset($UserId)) {
//    $userId = 1;
    $UserId = $_GET['UserID'];
    if (!isset($UserId)) {
        $UserId = 1;
    }
}

//get user by name
$query = "Select * From ChatApp3.User where UserId = $UserId";
$stmt = $dbConnect->query($query);
$stmt = $stmt->fetch();
$stmt_name = $stmt['UserName'];
$stmt_id = $stmt['UserId'];

$getUser = "Select * From ChatApp3.User WHERE UserId != 5 ORDER BY UserId;";
$chatUser = $dbConnect->query($getUser);

$getMessageByUser = "Select * from Message
 where SenderId = $UserId 
 ORDER BY MessageTime DESC";
$messages = $dbConnect->query($getMessageByUser);
?>
<div class="page-header">
    <h1>Hi, <?php echo htmlspecialchars($_SESSION["username"] ); ?></h1>
</div>

<div id="sidebar">
    <!-- display a list of chat users -->
    <h2>Chat User</h2>
    <ul class="nav">
        <?php foreach ($chatUser as $user) : ?>
            <li>
                <a href="?UserID=<?php echo $user['UserId']; ?>">
                    <?php echo $user['UserName']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div id="content">


    <h3>
        <a href="adminMessageForm.php">
         Send message to User
        </a>
    </h3>
    <!-- display a table of products -->
    <h2><?php echo "User Name: $stmt_name\tUser ID: $stmt_id"; ?></h2>
    <table>
        <tr>

            <th>User ID</th>
            <th>Message</th>
            <th>Time</th>
            <th>&nbsp;</th>
        </tr>
        <?php $blank = '';?>
        <?php foreach ($messages as $message) : ?>
            <tr>
                <?php  if ($blank == $message['SenderId']){
                    echo '<td>&nbsp;</td>';
                } else {?>
                <td><?php echo $message['SenderId']; ?></td>
             <?php  }?>
                <td><?php echo $message['MessageText']; ?></td>
                <td><?php echo $message['MessageTime']; ?></td>

        <?php
        $blank = $message['SenderId'];
        endforeach; ?>
    </table>
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