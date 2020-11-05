<?php
$number_of_connections=0;

function GetConnection() {
  $dbhost = "localhost";
  $dbuser = "rooronoa";
  $dbpass = "0411";
  $dbname = "phansite";

  $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname)  or die("Unable to connect:\n" . $connection->error);
  $conn -> autocommit(TRUE);

  return $conn;
}

function CloseConnection ($conn) {
  $conn->close();
}
?>
