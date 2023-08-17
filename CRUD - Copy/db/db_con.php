<?php

    $server = "localhost";
    $name = "root";
    $password = "1003669.tsd";
    $db_name = "my_db";

    $con = mysqli_connect($server, $name, $password, $db_name);

    if(!$con){
        echo mysqli_connect_error();
    }else{
        // echo "connected!";
    }


?>