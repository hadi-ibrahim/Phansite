<?php
include('../../BusinessLogicLayer/registration.php');

LogOut();
echo "<script type='text/javascript'>
alert('Logout successful!')
</script>";
header("Location: ../Views/index.html");
exit();

?>
