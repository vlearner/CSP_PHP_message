
<?php
include_once ('style.html');
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


$getMessageByUser = "Select * from Message
 where CustomerID = $UserId 
 ORDER BY MessageTime DESC LIMIT 15";
$messages = $dbConnect->query($getMessageByUser);

?>

<div class="container-fluid">
<div class="page-header">
    <h1>Hi, <?php echo htmlspecialchars($_SESSION["username"] ); ?></h1>
</div>

<div class="row">
    <div class="col-3">
        <div>
            <!-- display a list of chat users -->
            <ul class="list-group">
                <h4 class="list-group-item">Customer</h4>
                <?php foreach ($chatUser as $user) : ?>
                    <li class="list-group-item list-group-item-action">
                        <a href="?UserID=<?php echo $user['CustomerId']; ?>">
                            <?php echo $user['FirstName']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!--  Close window to kill session  -->
            <!--    send to home page-->
            <div class="closeChatButton">
                <!--    send to home page-->
                <a href="exit.php" class="btn btn-danger btn-block">Log out</a>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div id="content">
                <a class="btn btn-primary" href="adminMessageForm.php">
                    Send message to Customer
                </a>
            <h4><?php echo "Customer Name: $stmt_name,\tCustomer ID: $stmt_id"; ?></h4>
            <table class="table">
                <tr>
                    <th scope="col">Messages</th>
                    <th scope="col">Time</th>
                </tr>
                <?php foreach ($messages as $message) : ?>
                    <tr scope="row">
                        <td><?php echo $message['MessageText']; ?></td>
                        <?php $time = strtotime($message['MessageTime']);?>
                        <td><?php  echo date('H:i:s d/M/y', $time) ; ?></td>
                    </tr>
                <?php
                endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php include_once ('script.html');?>
