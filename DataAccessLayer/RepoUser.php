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

  public static function Create($FirstName, $LastName, $Email, $Password, $Username, $PicPath, $IsAdmin,$IsVerified)
  {
      $Conn = GetConnection();
      $Stmt = "INSERT INTO user VALUES(NULL,";

        if($FirstName == NULL)
          $Stmt .= "NULL,";
        else $Stmt.= "'" .$FirstName . "',";
        if($LastName == NULL)
          $Stmt .= "NULL,";
        else $Stmt.= "'" .$LastName . "',";

        $Stmt.= "'" . $Email    . "', '"
        . $Password . "', '"
        . $Username . "', "
        . "NULL"    . ", '"
        . $IsAdmin  . "', '"
        . $IsVerified  . "');";

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

}
?>
