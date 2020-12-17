<?php
class RepoVotingPoll {

  public static function GetVotingPollByTopic($topic) {

    $Conn = GetConnection();
    $Stmt = "SELECT * FROM votingpoll WHERE topic = '" . $topic . "'";
    $Result = mysqli_query($Conn, $Stmt);
    CloseConnection($Conn);
    return mysqli_fetch_assoc($Result);
  }

  public static function GetVotingPolls()
  {
      $votingPolls = array();

      $Conn = GetConnection();
      $Stmt = "SELECT id, topic FROM votingpoll" ;
      $Result = mysqli_query($Conn, $Stmt);
      CloseConnection($Conn);
      while ($row = $Result->fetch_object()){
          $row->supporters = RepoVote::GetVoteCount($row,1);
          $row->opposed = RepoVote::GetVoteCount($row,0);
          $votingPolls[] = $row;
        }
      $Result-> free();
      return $votingPolls;
  }

  public static function Create($topic)
  {
      $Conn = GetConnection();
      $Stmt = "INSERT INTO verification(topic) VALUES('" . $topic . "')";
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
