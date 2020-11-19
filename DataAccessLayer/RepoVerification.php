<?php
class RepoVerification {
  public static function Get($User)
  {
      $Conn = GetConnection();
      $Stmt = "SELECT * FROM verification WHERE idUser = " . $User["id"] ;
      $Result = mysqli_query($Conn, $Stmt);
      CloseConnection($Conn);
      return mysqli_fetch_assoc($Result);
  }

  public static function Create($User, $Path)
  {
      $Conn = GetConnection();
      $Stmt = "INSERT INTO verification(idUser, imgPath) VALUES("
        . $User['id'] . ", '"
        . $Path . "');";

        echo $Stmt;
        $Result =mysqli_query($Conn, $Stmt);
      if (isset($Result)){
        CloseConnection($Conn);
        return self::Get($User);
      }
      else
        http_response_code(405);
      CloseConnection($Conn);
      return NULL;
  }

}
?>
