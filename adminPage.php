<!DOCTYPE html>
<head>
    <!-- link to stylesheet -->
    <link rel="stylesheet"  type="text/css" href="style.css" />
</head>
<body style="">
<?php
//    $userId = 1;
if (!isset($_SESSION)) { session_start();}
//Remove unwanted Notice error
error_reporting( error_reporting() & ~E_NOTICE );


include('dbconnect.php');


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
$query = "SELECT * From Person
          INNER JOIN Customer
          ON Customer.PersonId = Person.PersonId
           WHERE Customer.CustomerId =$UserId";
$stmt = $dbConnect->query($query);
$stmt = $stmt->fetch();
$stmt_name = $stmt['FirstName'];
$stmt_id = $stmt['CustomerId'];


$getUser = "SELECT * From Person, Customer WHERE Customer.PersonId = Person.PersonId";
$chatUser = $dbConnect->query($getUser);


$getMessageByUser = "Select * from Message2
 where CustomerID = $UserId 
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
                <a href="?UserID=<?php echo $user['CustomerId']; ?>">
                    <?php echo $user['FirstName']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!--  Close chat to kill session  -->
    <div class="closeChatButton">
        <a href="exit.php" class="btn btn-info">Close Chat to Kill session</a>
    </div>
</div>

<div id="content">


    <h3>
        <a href="adminMessageForm.php">
         Send message to User
        </a>
    </h3>
    <!-- display a table of products -->
    <h2><?php echo "User Name: $stmt_name,\tCustomer ID: $stmt_id"; ?></h2>
    <table>
        <tr>

<!--            <th>Customer ID</th>-->
            <th>Message</th>
            <th>Time</th>
            <th>&nbsp;</th>
        </tr>
<!--        --><?php //$blank = '';?>
        <?php foreach ($messages as $message) : ?>
            <tr>
<!--                --><?php // if ($blank == $message['EmployeeId']){
//                    echo '<td>&nbsp;</td>';
//                } else {?>
<!--                <td>--><?php //echo $message['EmployeeId']; ?><!--</td>-->
<!--             --><?php // }?>
                <td><?php echo $message['MessageText']; ?></td>
                <td><?php echo $message['MessageTime']; ?></td>

        <?php
//        $blank = $message['EmployeeId'];
        endforeach; ?>
    </table>
</div>



    <script type="text/javascript">

        // get messages form database
        // ONLY WORKS ON CHROME! NEED TO WORK ON FIREFOX AND SAFARI!
        $(document).ready(function(){
            // event.preventDefault();
            setInterval(function(){
                $('#showMessage').load('adminPage.php')
            }, 1000);
        });

    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>