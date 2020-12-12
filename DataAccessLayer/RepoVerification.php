<?php
class RepoVerification {
  public static function GetUserVerificationRequests($Username)
  {
      $verificationResults = array();

      $Conn = GetConnection();
      $user = RepoUser::GetByUsername($Username);
      $Stmt = "SELECT imgPath, username FROM verification INNER JOIN user ON verification.idUser= user.id
        WHERE idUser = ". $user['id'] ;
      $Result = mysqli_query($Conn, $Stmt);
      CloseConnection($Conn);
      while ($row = $Result->fetch_object())
          $verificationResults[] = $row;
      $Result-> free();
      return $verificationResults;  }

  public static function GetUsersForVerification()
  {
      $verificationResults = array();
      $Conn = GetConnection();
      $Stmt = "SELECT * FROM verification GROUP BY IdUser";
      $Result = mysqli_query($Conn, $Stmt);
      CloseConnection($Conn);
      while ($row = $Result->fetch_object())
          $verificationResults[] = $row;
        $Result-> free();
      return $verificationResults;
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
