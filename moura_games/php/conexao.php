<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) 
  {
    echo "<br>";
    echo ("Falha na conexão: " . $conn->connect_error);
  }
else
  {
    //conectado com sucesso !
  }
?>