<?php
session_start();
require("upload.php");
require('../../BusinessLogicLayer/registration.php');
require('../../BusinessLogicLayer/profileManagement.php');
require('../../BusinessLogicLayer/votingManagement.php');


if(isset($_POST)){
  // ================================ signup
  if($_POST["action"] =="signup") {

    $form_data = array();
    $error = '';
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!isset($username) || !isset($password))
      $error="All fields are required.";
    else if (strlen($username) < 3  || strlen($username) > 45)
      $error="Username must be between 3 and 45 characters.";
    else if (strlen($password) < 7 || strlen($password) > 70 )
      $error="Password must be between 7 and 70 characters.";
    else if(UsernameExist($username)) {
      $error="Email already in use.";
    }
    else {
      $result = SignUp($username, $password);
      if ($result) {
          $form_data['success'] = true;
          $form_data['posted'] = 'Sign up successful!';
          $form_data['user'] = $result;
      } else $error = 'Error signing up. Please try again later.';
    }

    if (strlen($error) > 0) {
        $form_data['success'] = false;
        $form_data['error'] = $error;
    }
    echo json_encode($form_data);

  }

  else if($_POST["action"] == "logout") {
    LogOut();
    echo json_encode(1);
  }
// ===================================== validate username
  else if($_POST["action"] =="validateUsername") {

    $form_data = array();
    $error= '';
    $username = $_POST['username'];
    if (strlen($username) < 3  || strlen($username) > 45)
      $error="Username must be between 3 and 45 characters.";
    else if(UsernameExist($username))
      $error="Email already in use.";

    else {
      $form_data['success'] = true;
      $form_data['posted'] = 'Valid username!';
    }

    if (strlen($error) > 0) {
        $form_data['success'] = false;
        $form_data['error'] = $error;
    }

    echo json_encode($form_data);
  }

// ============================= upload profile pic
  else if($_POST["action"] =="uploadProfile") {
    $form_data = array();
    $error= '';
    $target_dir = "../Assets/img/profilePics/";
    $file = RenameFileByProfileName($_FILES['fileToUpload']["name"]);
    $target_file = $target_dir . ($file);
    $image_path = $_SESSION['user']['picPath'];
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);
    $uploadOk = 1;
    $oldPicture = NULL;
    if($image_path!= NULL)
      $oldPicture= $target_dir . $image_path;

    if(Upload($target_file, $imageFileType, $uploadOk)){
      SetProfilePicture($_SESSION['user'], $file);
      DeleteOldImageIfExists($oldPicture, $target_file);
      $form_data['user'] = $_SESSION['user'];
      $form_data['success'] = true;

    }
    else {
      $error ="Could not upload file. Try again";
    }

    if (strlen($error) > 0) {
        $form_data['success'] = false;
        $form_data['error'] = $error;
    }

    echo json_encode($form_data);
  }
// ====================================== view self profile
  else if($_POST['action'] == "GetSelfProfile") {
    $form_data = array();
    $error= '';

    $user = RepoUser::GetByUsername($_SESSION['user']['username']);
    if($user == NULL) {
      $error = "Error: couldn't load logged in user";
    }
    else {
      $form_data['user'] = $user;
      $form_data['success'] = true;
    }

    if (strlen($error) > 0) {
        $form_data['success'] = false;
        $form_data['error'] = $error;
    }

    echo json_encode($form_data);
  }
// ====================================== login

else if($_POST["action"] =="login") {

    $form_data = array();
    $error= '';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = SignIn($username, $password) ;

    if($result == NULL) {
      $error = "Invalid Username or password !";
    }

    else {
      $form_data['success'] = true;
      $form_data['user'] = $result;
    }

    if (strlen($error) > 0) {
        $form_data['success'] = false;
        $form_data['error'] = $error;
    }

    echo json_encode($form_data);
  }

  // ====================================== check if user is logged in

  else if($_POST["action"] =="isLoggedIn") {

      $form_data = array();
      $error= '';

      $result = $_SESSION['user'];

      if($result == NULL) {
        $error = "not logged in";
      }

      else {
        $form_data['success'] = true;
        $form_data['user'] = $result;
      }

      if (strlen($error) > 0) {
          $form_data['success'] = false;
          $form_data['error'] = $error;
      }

      echo json_encode($form_data);
    }

// ================================== upload pic to verify
    else if($_POST["action"] =="uploadVerification") {
      $form_data = array();
      $error= '';
      $target_dir = "../Assets/img/Verification/"
                      . $_SESSION['user']['username']."/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
      $file = $_FILES["fileToUpload"]["name"];
      $target_file = $target_dir . ($file);
      $image_path = $_SESSION['user']['picPath'];
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $uploadOk = 1;


      if (Upload($target_file, $imageFileType, $uploadOk)){
        RequestVerification($_SESSION['user'], $file);
        $form_data['success'] = true;

      }
      else {
        $error ="Could not upload file. Try again";
      }

      if (strlen($error) > 0) {
          $form_data['success'] = false;
          $form_data['error'] = $error;
      }

      echo json_encode($form_data);
    }

    // ================================   get all voting polls
    else if($_POST['action'] == "GetAllVotingPolls") {

      $form_data = array();
      $error= '';

      $votingPolls= GetVotingPolls();

      if($votingPolls == NULL) {
        $error = "Error: couldn't load  pending verification";
      }
      else {
        $form_data['polls'] = $votingPolls;
        $form_data['success'] = true;
      }

      if (strlen($error) > 0) {
          $form_data['success'] = false;
          $form_data['error'] = $error;
      }

      echo json_encode($form_data);
    }
}

?>
