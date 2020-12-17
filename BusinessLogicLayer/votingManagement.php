<?php
require_once(dirname(__DIR__) . "\DataAccessLayer\ConnectionManager.php");
require_once(dirname(__DIR__) . "\DataAccessLayer\RepoVotingPoll.php");
require_once(dirname(__DIR__) . "\DataAccessLayer\RepoVote.php");
require_once(dirname(__DIR__) . "\DataAccessLayer\RepoUSer.php");


function GetVotingPolls() {
  $result = RepoVotingPoll::GetVotingPolls();

  return json_encode($result);
}

function GetVoteInfo($user, $topic) {
  $poll= RepoVotingPoll::GetVotingPollByTopic($topic);

    if($user['isVerified'] == "0"){
      $voteInfo['isEligible'] = "0";
      $voteInfo['voted'] ="0";
      return $voteInfo;
    }
    else {
      if(RepoVote::UserVotedToPoll($user, $poll)!= NULL){
        $voteInfo['isEligible']= "0";
        $voteInfo['voted'] ="1";
        return $voteInfo;
      }
      else {
        $voteInfo['isEligible']= "1";
        $voteInfo['voted'] ="0";

        return $voteInfo;
        }
    }
}

function Vote($vote) {
  $poll = RepoVotingPoll::GetVotingPollByTopic($vote->topic);
  $vote->idVotingPoll = $poll['id'];
  RepoVote::Create($vote);
  return $poll;
}

function GetVotingPollVoteCount($pollArray, $option) {
  $poll =(object)[];
  $poll->id = $pollArray['id'];
  return RepoVote::GetVoteCount($poll, $option);
}
