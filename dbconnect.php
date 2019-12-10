
<?php
    // databse variables
    $dbHost = 'mysql::host=localhost;dbname=OLGSTORE';
    $dbUser = 'root';
//    PASSWORD NEED TO CHANGE
    $dbPassword = '';

	try
	{
		$dbConnect = new PDO($dbHost, $dbUser, $dbPassword);
		$dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// echo "Database Connected!";
	}
	catch (PDOException $e)
	{
		echo "There is some problem in connection: " . $e->getMessage();
	}
		

?>


