<?php
    $servername = "localhost";
    $database = "boutique";
    $username = "root";
    $password = "";
    // Create connection
    $conn = @mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
?>