<?php
session_start();

require_once(dirname(__DIR__) . "\DataAccessLayer\ConnectionManager.php");
require_once(dirname(__DIR__) . "\DataAccessLayer\RepoUser.php");
function SignUp( $Username,$Password)
{
  $user = RepoUser::Create($Username, password_hash($Password, PASSWORD_BCRYPT, ['cost' => 10]));
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
