<?php
require_once(dirname(__DIR__) . "\DataAccessLayer\ConnectionManager.php");
require_once(dirname(__DIR__) . "\DataAccessLayer\RepoUser.php");
require_once(dirname(__DIR__) . "\DataAccessLayer\RepoVerification.php");

function RequestVerification($user, $path) {
  RepoVerification::Create($user, $path);
}

function SetProfilePicture($user, $path) {
  $user['picPath']= $path;
  $user = RepoUser::Update($user);
  $_SESSION['user'] =$user;
}

function Verify($user) {
  $user['isVerified'] =1;
  $user = RepoUser::Update($user);
  $_SESSION['user'] =$user;
}
