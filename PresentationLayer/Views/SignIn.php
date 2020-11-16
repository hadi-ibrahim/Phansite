<?php
include('../../BusinessLogicLayer/registration.php');

if(isset($_POST))
{
  print_r($_POST);
    echo "Signing in :.....";
    $result = SignIn($_POST['username'],$_POST['password']);
    if($result)
      echo "<script type='text/javascript'>
      alert('Sign in successful!')
      </script>";
}
?>
