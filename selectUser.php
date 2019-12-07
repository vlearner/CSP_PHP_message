<?php

require('dbconnect.php');

$getUser = "Select * From User WHERE UserId != 5 ORDER BY UserId;";
$chatUser = $dbConnect->query($getUser);
?>

<label>User</label>
<select name="user_ID">
    <?php foreach ($chatUser as $user) : ?>
        <option value="<?php echo $user['UserId']; ?>">
            <?php echo $user['UserName']; ?>
        </option>
    <?php endforeach; ?>
</select><br />
