<?php
require_once(dirname(__DIR__) . "\DataAccessLayer\ConnectionManager.php");
require_once(dirname(__DIR__) . "\DataAccessLayer\RepoVotingPoll.php");
require_once(dirname(__DIR__) . "\DataAccessLayer\RepoVote.php");


function GetVotingPolls() {
  $result = RepoVotingPoll::GetVotingPolls();

  return json_encode($result);
}
