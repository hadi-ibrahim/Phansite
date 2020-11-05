<?php
session_start();

include(dirname(__DIR__) . "\DataAccessLayer\RepoUser.php");
function SignUp($FirstName, $LastName, $Email, $Password, $Username, $PicPath, $IsAdmin, $IsVerified)
{
    if(RepoUser::Create($FirstName, $LastName, $Email, $Password, $Username, $PicPath, $IsAdmin, $IsVerified))
      return true;
    return false;
}
function SignIn($Username , $Password) {
  $user = RepoUser::Login($Username, $Password);
  if(!isset($user))
  echo "<script type='text/javascript'>
  alert('Login failed. Try again')
  </script>";
  return $user;
}
