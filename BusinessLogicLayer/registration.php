<?php
session_start();

include(dirname(__DIR__) . "\DataAccessLayer\RepoUser.php");
function SignUp($FirstName, $LastName, $Email, $Password, $Username, $PicPath, $IsAdmin, $IsVerified)
{
  $user = RepoUser::Create($FirstName, $LastName, $Email, password_hash($Password, PASSWORD_BCRYPT, ['cost' => 10]), $Username, $PicPath, $IsAdmin, $IsVerified);
    if($user) {
      $_SESSION['user']= $user;
      return $user;
    }
    return NULL;
}

function SignIn($Username , $Password) {
  $user = RepoUser::Get($Username);
  if(!password_verify($Password,$user['password'])) {
    echo "<script type='text/javascript'>
    alert('Login failed. Try again')
    </script>";
    return NULL;
  }
  $_SESSION['user']= $user;
  return $user;
}

function LogOut() {
  unset($_SESSION['user']);
}
