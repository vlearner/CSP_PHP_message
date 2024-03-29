
<?php
include_once ('style.html');
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: adminPage.php");
    exit;
}

require_once "dbconnect.php";

$userName  = $userEmail = "";
$userNameError  = $userEmailError = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["user"]))){
        $userNameError = "Please enter Name";
    }
    else {
        $userName = trim($_POST["user"]);
    }

    if(empty(trim($_POST["email"]))){
        $userEmaiError = "Please enter Email";
    }
    else {
        $userEmail = trim($_POST["email"]);
    }

    if(empty($userNameError) && empty($userEmaiError)){
//        $selectQuery = "SELECT UserId, UserName, UserEmail
//                                        FROM ChatApp3.User
//                                        WHERE UserName = :user";

        $selectQuery = "SELECT Person.PersonId, Person.FirstName, ContactInfo.EmailAddress
                        FROM Person
                        INNER JOIN ContactInfo ON ContactInfo.ContactInfoId = Person.ContactInfoId
                        LEFT JOIN Employee ON Employee.PersonId = Person.PersonId
                        WHERE Person.FirstName = :user";

        if($stmt = $dbConnect->prepare($selectQuery)){
            $stmt->bindParam(":user", $pUser, PDO::PARAM_STR);

            $pUser = trim($_POST["user"]);

            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["PersonId"];
                        $userName = $row["FirstName"];
                        $userEmail = $row["EmailAddress"];

                        session_start();

                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $userName;
                        header("location: adminPage.php");
                    }
                }
            }
        }
        unset($stmt);

    }
    unset($dbConnect);
}

?>
<div  class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <form class="logInForm" action="
                <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                <div class="
                    <?php echo (!empty($username_err)) ? 'has-error' : '';
                ?>">
                    <input
                        type="text"
                        name="user"
                        id="user"
                        value="<?php echo $userName; ?>"
                        required="required"
                        placeholder="Name"
                        class="form-control <?php echo (!empty($userNameError)) ? 'has-error' : ''; ?>">
                    <br>
                    <span
                        class="help-block"><?php echo $userNameError; ?>
                            </span>
                </div>
                <div class="<?php echo (!empty($userEmailError)) ? 'has-error' : ''; ?>">
                    <input
                        type="email"
                        value="<?php echo $userEmail; ?>"
                        name="email"
                        id="email"
                        required="required"
                        placeholder="Email"
                        class="form-control">
                    <br>

                </div>
                <input
                    class="btn btn-lg btn-primary btn-block"
                    type="submit"
                    name="submit"
                    value="Enter"
                    style="none">
                <br>
<!--   $$$$$$$$$$$$ Remove this code before deployment -->
                <p>
                    User: Test2
                    Email: admin2@admin.com
                </p>
 <!--  $$$$$$$$$$$ Remove this code before deployment -->
            </form>
        </div>
    </div>
</div>


<?php include_once ('script.html');?>