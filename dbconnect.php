
<?php
    // DB variables
    $dbHost = 'localhost';
    $dbName = 'ChatApp';
    $dbUser = 'root';
    $dbPassword = '';


			try{
				$dbConnect = new PDO("mysql:host=$dbHost;$dbName", $dbUser, $dbPassword);
				$dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				echo "Database Connected!";
				
			}
			catch (PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
		

?>


