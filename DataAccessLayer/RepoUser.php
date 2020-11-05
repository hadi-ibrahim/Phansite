<?php
include("ConnectionManager.php");
class RepoUser {
  public static function Get($Username)
  {
      $Conn = GetConnection();
      $Stmt = "SELECT * FROM user WHERE username = '" . $Username . "'";
      $Result = mysqli_query($Conn, $Stmt);
      CloseConnection($Conn);
      return $Result;
  }

  public static function Create($FirstName, $LastName, $Email, $Password, $Username, $PicPath, $IsAdmin,$IsVerified)
  {
      $Conn = GetConnection();
      $Stmt = "INSERT INTO user VALUES(NULL, '"
        . $FirstName. "', '"
        . $LastName . "', '"
        . $Email    . "', '"
        . $Password . "', '"
        . $Username . "', "
        . "NULL"    . ", '"
        . $IsAdmin  . "', '"
        . $IsVerified  . "');";

        echo $Stmt;
      if (mysqli_query($Conn, $Stmt)){
        CloseConnection($Conn);
        return true;
      }
      else
        http_response_code(405);
      CloseConnection($Conn);
      return false;
  }

  public static function Login($Username, $Password) {
    $Conn = GetConnection();
    $Stmt = "SELECT * FROM user WHERE username = '".$Username. "' AND password = '". $Password ."'";
    $Result = mysqli_query($Conn, $Stmt);
    CloseConnection($Conn);
    return mysqli_fetch_assoc($Result);
  }

}
?>
