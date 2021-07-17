<?php

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "users";

    // create a connection
    $conn = mysqli_connect($server, $username, $password, $database);

        //die ifconnection was not successful
        if (!$conn){
            die("Sorry we failed to connect:  ". mysqli_connect_error());

        // }else {
            
            // echo "Connection was successfull!<br>";
        }

    
?>