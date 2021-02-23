<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
if(isset($_SESSION['userSessionID'])){
    echo '<p>Im the header and your logged in as '.$_SESSION["username"].'</p>';
}else{
    echo '<p>Im the header and your not logged in</p>';
}
?>
</body>
</html>
