<?php

if(isset($_POST['signupSubmit'])){
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


    $username = $_POST['u'];
    $password = $_POST['p'];


    var_dump($username);

    if(empty($username) || empty($password)) {
        header("Location: ../index.php?error=1");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE username=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=2");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "s",$password );
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../index.php?error=usernametakeen");
                exit();
            }else{
                $sql = "INSERT INTO users (username, password) VALUES (?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                }else{

                    $hashPass = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ss",$username, $hashPass );
                    mysqli_stmt_execute($stmt);
                    header("Location: ../index.php?signup=succes");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($conn);
    mysqli_close($conn);
}else{
    header("Location: ../index.php?error=badgateway");
    exit();
}
