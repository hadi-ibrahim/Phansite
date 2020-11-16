<?php
session_start();

include(dirname(__DIR__) . "\DataAccessLayer\RepoUser.php");

function setProfilePicture($user, $path) {
  $user['picPath']= $path;
  $user = RepoUser::UpdatePicture($user);
  $_SESSION['user'] =$user;

}
