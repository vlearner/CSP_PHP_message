<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>
<body>
    <?php 

        require('dbconnect.php');

        $getMessage = "SELECT * FROM ChatApp65.Message WHERE senderID ";

        $getMessage = "SELECT * FROM ChatApp65.Message ORDER BY MessageId DESC LIMIT 15";
        $chat = $dbConnect->prepare($getMessage);
        $chat->execute();
        $chatInfo = $chat->fetchAll();
    ?>
</body>
</html>