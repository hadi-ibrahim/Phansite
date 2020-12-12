<?php
class RepoUser {
  public static function GetByUsername($Username)
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

        $Result =mysqli_query($Conn, $Stmt);
      if (isset($Result)){
        CloseConnection($Conn);
        return self::GetByUsername($Username);
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

        $Result =mysqli_query($Conn, $Stmt);
      if (isset($Result)){
        CloseConnection($Conn);
        return self::GetByUsername($user['username']);
      }
      else
        http_response_code(405);
      CloseConnection($Conn);
      return NULL;
  }

}
?>
