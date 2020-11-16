<?php
include('../../BusinessLogicLayer/registration.php');

if(isset($_POST))
{
    echo "Signing up :.....";
    print_r($_POST);
    $result = SignUp( $_POST['username'],$_POST['password']);
    if($result)
      echo "<script type='text/javascript'>
      alert('Sign up successful!')
      </script>";
    else
      echo "<script type='text/javascript'>
      alert('Unable to create new user. check information.')
      </script>";
}
?>
