<?php
include('../BusinessLogicLayer/registration.php');
global $Username;
global $Password;
if(isset($_POST))
{
  print_r($_POST);
    echo "Signing in :.....";
    $result = SignIn($_POST['user'],$_POST['pass']);
    if($result)
      echo "<script type='text/javascript'>
      alert('Sign in successful!')
      </script>";
}
?>
