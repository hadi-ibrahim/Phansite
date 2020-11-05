<?php
include('../../BusinessLogicLayer/registration.php');

if(isset($_POST))
{
    echo "Signing up :.....";
    print_r($_POST);
    $result = SignUp($_POST['fname'], $_POST['lname'], $_POST['email'],$_POST['pass'], $_POST['username'], NULL ,0, 0);
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
