<?php
if (!isset($_SESSION)) { session_start();}

//Remove unwanted Notice error
error_reporting( error_reporting() & ~E_NOTICE );
//error_reporting(E_ALL);
//ini_set('display_errors', 1);



require('dbconnect.php');


if(!isset($UserId)) {
//    $userId = 1;
    $UserId = $_GET['UserID'];
    if (!isset($UserId)) {
        $UserId = 1;
    }
}

//Get List of user except admin
//$getUser = "Select * From User WHERE UserId != 5 ORDER BY UserId;";
$getUser = "SELECT * From Person, Customer WHERE Customer.PersonId = Person.PersonId";
$chatUser = $dbConnect->query($getUser);



//$query = "Select * From ChatApp3.User where UserId = $UserId";
$query = "SELECT * From Person
          INNER JOIN Customer
          ON Customer.PersonId = Person.PersonId
           WHERE Customer.CustomerId =$UserId";
$stmt = $dbConnect->query($query);
$stmt = $stmt->fetch();
$stmt_name = $stmt['FirstName'];
$stmt_id = $stmt['CustomerId'];
$fromMessage = $_SESSION["id"];


//Get message from admina and user
$getMessageByUser = "SELECT * FROM Message
                WHERE EmployeeId = 4
                and CustomerID = $UserId
                OR CustomerID = $UserId
                and EmployeeId = 4
                ORDER BY MessageTime DESC;";
$messages = $dbConnect->query($getMessageByUser);
//$messages->execute();
//$messages->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="radioStyle.css" >
</head>
<body>
<div class="container-fluid">
    <h4><?php echo "User Name: $stmt_name\t Person ID: $stmt_id"; ?></h4>
    <div class="d-flex p-2 bd-highlight" style="
            width: auto;
            height: 400px;
            overflow: auto;">
    <div id="content" class="scrollBar" >
        <table class="table">
            <tr>
                <th scope="col">Customer ID</th>
                <th scope="col">Message</th>
                <th scope="col">Time</th>
            </tr>
            <?php $blank = '';?>
            <?php foreach ($messages as $message) : ?>
            <tr>
                <?php  if ($blank == $message['EmployeeId']){
                    echo '<td>&nbsp;</td>';
                } else {?>
                    <td><?php echo $message['EmployeeId']; ?></td>
                <?php  }?>

                <td><?php echo $message['MessageText']; ?></td>
                <?php $time = strtotime($message['MessageTime']);?>
                <td><?php  echo date('H:i:s d/M/y', $time) ; ?></td>
                <?php
                $blank = $message['EmployeeId'];
                endforeach; ?>
        </table>
    </div>
    </div>

    <div id="sidebar">
    <form  action="adminSendMessage.php" method="POST" >
        <div class="radio-toolbar">

            <?php foreach ($chatUser as $user) : ?>
                <input name="user_ID"
                       type="radio"
                       id="<?php echo $user['FirstName']; ?>"
                       value="<?php echo $user['CustomerId']; ?>">
                <label  for="<?php echo $user['FirstName']; ?>" >
                    <?php echo $user['FirstName']; ?>
                </label>
            <?php endforeach; ?> </div>
      <br>
        <div class="input-group">
            <input class="form-control" id="message" name="message" type="text">
                <input class="btn btn-success btn-block" name="sendMessage" id="sendMessage" type="submit" value="Send Message">
            </div>
        </div>

    </form>
        <br><br><br>

        <a class="btn btn-primary" href="adminPage.php">List of Customer</a>

    </div>

<?php include_once ('script.html');?>
