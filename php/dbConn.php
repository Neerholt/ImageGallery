<?php

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


