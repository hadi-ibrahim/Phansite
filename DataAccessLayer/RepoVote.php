<?php
class RepoVote {
  public static function GetVotes($poll)
  {
      $votes = array();

      $Conn = GetConnection();
      $Stmt = "SELECT * FROM vote WHERE idVotingPoll = " . $poll->id ;
      $Result = mysqli_query($Conn, $Stmt);
      CloseConnection($Conn);
      while ($row = $Result->fetch_object())
          $votes[] = $row;
      $Result-> free();
      return $votes;
  }

  public static function GetVoteCount($poll, $option)
  {

      $Conn = GetConnection();
      $Stmt = "SELECT count(*) as votes FROM vote WHERE idVotingPoll = " . $poll->id . " AND vote = " .$option ;
      $Result = mysqli_query($Conn, $Stmt);
      $count = $Result->fetch_object();
      $Result-> free();
      return $count->votes;
  }

  public static function Create($vote)
  {
      $Conn = GetConnection();

      $Stmt = "INSERT INTO vote (idUser, idVotingPoll, vote) VALUES(" . $vote['idUser']
        . ", " . $vote['idVotingPoll'] . "," . $vote['vote'] .  " )";
      $Result =mysqli_query($Conn, $Stmt);
      if (isset($Result)){
        CloseConnection($Conn);
        return True;
      }
      else
        http_response_code(405);
      CloseConnection($Conn);
      return False;
  }

}
?>
