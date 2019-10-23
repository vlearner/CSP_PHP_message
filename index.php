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
        <link rel="stylesheet" href="">
        <?php 
        
        ?>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php 

       
        if(isset){

            try
                {
                    include('dbconnect.php');
                    $sqlQuery = "INSERT INTO ChatApp.User (userName, UserEmail)
                                    VALUES ('Test4', 'abq@abc.com')";

                    $dbConnect->exec($sqlQuery);
                    echo "New record created successfully";
                }
            catch(PDOException $e)
                {   
                    echo $sqlQuery . "<br>" . $e->getMessage();
                }

            }

        ?>

        
        <form action="index.php" method="post" >
		<div>
			<label for="email">Name</label>
			<input type="text" name="user" value="user" id="user" required="required">
        </div>
        <div>
			<label for="email">Email</label>
			<input type="text" name="user" value="user" id="user" required="required">
		</div>
		<!-- <div>
			<label for="femail">Password</label>
			<input type="password" name="pass" value="pass" id="pass" required="required">
		</div> -->
		<div>
			<input type="submit" value="submit" >
		</div>
</form>

    </body>
</html>