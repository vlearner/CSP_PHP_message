
<?php
    // DB variables
    $dbHost = 'localhost';
    $dbName = 'ChatApp';
    $dbUser = 'root';
    $dbPassword = 'root';


			try{
				$dbConnect = new PDO('mysql:$dbHost, $dbName, $dbUser, $dbPassword');
				echo "Database Connected!";
				
			}
			catch (PDOException $e){
				echo "There is some problem in connection: " . $e->getMessage();
			}
		

?>


