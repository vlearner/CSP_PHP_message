<!DOCTYPE html>
<html>
<head>

</head>
<body>
<?php
if (!isset($_SESSION)) { session_start();}
error_reporting(E_ALL);
ini_set('display_errors', 1);



require('dbconnect.php');


if(!isset($UserId)) {
//    $userId = 1;
    $UserId = $_GET['UserID'];
    if (!isset($UserId)) {
        $UserId = 1;
    }
}

//Get List of user except admin
$getUser = "Select * From User WHERE UserId != 5 ORDER BY UserId;";
$chatUser = $dbConnect->query($getUser);


$query = "Select * From ChatApp3.User where UserId = $UserId";
$stmt = $dbConnect->query($query);
$stmt = $stmt->fetch();
$stmt_name = $stmt['UserName'];
$stmt_id = $stmt['UserId'];
$fromMessage = $_SESSION["id"];


//Get message from admina and user
$getMessageByUser = "SELECT * FROM ChatApp3.Message
                WHERE SenderID = $fromMessage
                and RecieverId = $UserId
                OR SenderID = $UserId
                and RecieverId = $fromMessage
                ORDER BY MessageTime DESC;";
$messages = $dbConnect->query($getMessageByUser);
//$messages->execute();
//$messages->fetchAll();



?>


<h3><a href="adminPage.php">Admin Home</a></h3>

<div id="sidebar">
<form  action="adminSendMessage.php" method="POST" >
<label>User</label>
<select name="user_ID">
    <?php foreach ($chatUser as $user) : ?>
        <option value="<?php echo $user['UserId']; ?>">
            <?php echo $user['UserName']; ?>
        </option>
    <?php endforeach; ?>
</select><br />

    <input class="form-control" id="message" name="message" type="input">
    <div class="input-group-append" id="button-addon4">
        <input class="btn btn-outline-secondary" name="sendMessage" id="sendMessage" type="submit" value="Submit">
    </div>
</form>

</div>

<div id="content">
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
</body>

</html>