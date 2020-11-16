<?php
include("ConnectionManager.php");
class RepoUser {
  public static function Get($Username)
  {
      $Conn = GetConnection();
      $Stmt = "SELECT * FROM user WHERE username = '" . $Username . "'";
      $Result = mysqli_query($Conn, $Stmt);
      CloseConnection($Conn);
      return mysqli_fetch_assoc($Result);
  }

  public static function Create($Username, $Password)
  {
      $Conn = GetConnection();
      $Stmt = "INSERT INTO user(username, password) VALUES('"
        . $Username . "', '"
        . $Password . "');";

        echo $Stmt;
        $Result =mysqli_query($Conn, $Stmt);
      if (isset($Result)){
        CloseConnection($Conn);
        return self::Get($Username);
      }
      else
        http_response_code(405);
      CloseConnection($Conn);
      return NULL;
  }

  public static function Update($user)
  {
      $Conn = GetConnection();
      $Stmt = "UPDATE user SET picPath = '"
        . $user['picPath']
        . "', isVerified='"
        . $user['isVerified']
        . "', isAdmin='"
        . $user['isAdmin']
        . "', username='"
        . $user['username']
        . "' WHERE id= " . $user['id'];

        echo $Stmt;
        $Result =mysqli_query($Conn, $Stmt);
      if (isset($Result)){
        CloseConnection($Conn);
        return self::Get($user['username']);
      }
      else
        http_response_code(405);
      CloseConnection($Conn);
      return NULL;
  }

}
?>
