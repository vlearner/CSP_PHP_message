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
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <?php 

        require('dbconnect.php');

        $getMessage = "SELECT * FROM ChatApp.Message ORDER BY MessageId DESC LIMIT 15";
        $chat = $dbConnect->prepare($getMessage);
        $chat->execute();
        $chatInfo = $chat->fetchAll();
    ?>
</body>
</html>