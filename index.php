<?php  session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Gallery</title>
</head>
<body>
<form action="php/login.php" method="POST">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="password">
    <input type="submit" name="submitLogin" value="Login">
</form>
</body>
</html>
