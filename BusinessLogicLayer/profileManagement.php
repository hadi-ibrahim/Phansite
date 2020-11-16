<?php
session_start();

include(dirname(__DIR__) . "\DataAccessLayer\RepoUser.php");

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
