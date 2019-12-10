<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .radio-toolbar {
            margin: 10px;
        }

        .radio-toolbar input[type="radio"] {
            opacity: 0;
            position: fixed;
            width: 0;
        }

        .radio-toolbar label {
            display: inline-block;
            background-color: #ddd;
            padding: 10px 20px;
            font-family: sans-serif, Arial;
            font-size: 2vh;
            border: 2px solid #444;
            border-radius: 4px;
        }

        .radio-toolbar label:hover {
            background-color: #dfd;
        }

        .radio-toolbar input[type="radio"]:focus + label {
            border: 2px dashed #444;
        }

        .radio-toolbar input[type="radio"]:checked + label {
            background-color: #bfb;
            border-color: #4c4;
        }
    </style>
</head>
<body>
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
$getMessageByUser = "SELECT * FROM Message2
                WHERE EmployeeId = 4
                and CustomerID = $UserId
                OR CustomerID = $UserId
                and EmployeeId = 4
                ORDER BY MessageTime DESC;";
$messages = $dbConnect->query($getMessageByUser);
//$messages->execute();
//$messages->fetchAll();
?>


<h3><a href="adminPage.php">Admin Home</a></h3>

<div id="content" class="scrollBar">
    <h2><?php echo "User Name: $stmt_name\tUser ID: $stmt_id"; ?></h2>
    <table>
        <tr>

            <th>Customer ID</th>
            <th>Message</th>
            <th>Time</th>
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
            <td><?php echo $message['MessageTime']; ?></td>

            <?php
            $blank = $message['EmployeeId'];
            endforeach; ?>
    </table>
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
    <input class="form-control" id="message" name="message" type="input">
    <div class="input-group-append" id="button-addon4">
        <input class="btn btn-outline-secondary" name="sendMessage" id="sendMessage" type="submit" value="Submit">
    </div>
</form>

</div>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>