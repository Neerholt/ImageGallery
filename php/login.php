<?php

if(isset($_POST['submitLogin'])){

    //require 'php/dbConn.php'; I cant include this dbconn and make my stmt init work, sad

    //php server config
    $serNam = "localhost";
    $dbUsrNam = "root";
    $dbPas = "";
    $dbNam = "imagesgallery";


    //Connection string
    $conn = mysqli_connect($serNam,$dbUsrNam,$dbPas,$dbNam);

    //If there happens a error, print error
    if(!$conn){
        die("Connection failed". mysqli_connect_error());
    }



    $username = $_POST['username'];
    $password = $_POST['password'];


    if(empty($username) || empty($password)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE username=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "s",$username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $passCheck = password_verify($password, $row['password']);
                if($passCheck == false){
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }else if ($passCheck == true){
                    session_start();
                    $_SESSION['userSessionID'] = $row['id'];
                    $_SESSION['username'] = $row['username'];

                    header("Location: ../adminpanel.php?login=success");
                    exit();

                }else{
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
            }else{
                header("Location: ../index.php?error=noUserMatch");
                exit();
            }
        }
    }
}else{
    header("Location: ../index.php");
    exit();
}