<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <?php 
        
        ?>
    </head>
    <body class="text-center">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an 
                <strong>outdated</strong> browser. Please <a href="#">
                    upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php 
        session_start();

            // if(isset($_POST['submit'])){
            //     $user = $_POST['user'];
            //     $email = $_POST['email'];
            // try
            //     {
            //         include('dbconnect.php');
            //         $sqlQuery = "INSERT INTO ChatApp.User (userName, UserEmail)
            //                         VALUES ('$user', '$email')";

            //         $dbConnect->exec($sqlQuery);
            //         echo "New record created successfully";
            //         header('Location:message.php');
                
            //     }
            // catch(PDOException $e)
            //     {   
            //         echo $sqlQuery . "<br>" . $e->getMessage();
            //     }
            // }
        
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                header("location: message.php");
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
                    $selectQuery = "SELECT UserId, UserName, UserEmail 
                                        FROM ChatApp65.User 
                                        WHERE UserName = :user";

                    if($stmt = $dbConnect->prepare($selectQuery)){
                        $stmt->bindParam(":user", $pUser, PDO::PARAM_STR);

                            $pUser = trim($_POST["user"]);

                            if($stmt->execute()){
                                if($stmt->rowCount() == 1){
                                    if($row = $stmt->fetch()){
                                        $id = $row["UserId"];
                                        $userName = $row["UserName"];
                                        $userEmail = $row["UserEmail"];
                                    
                                        session_start();

                                        $_SESSION["loggedin"] = true;
                                        $_SESSION["id"] = $id;
                                        $_SESSION["username"] = $userName;                
                                        header("location: message.php");            
                                    }
                                }
                            }
                    }
                    unset($stmt);

                }
                unset($dbConnect);
            }

        ?>

        <div class="container">
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
                            value="<?php echo $confirm_password; ?>"
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
                </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
        </script>


    </body>
</html>