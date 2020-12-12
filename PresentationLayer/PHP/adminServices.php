<?php
session_start();
require("upload.php");
require('../../BusinessLogicLayer/registration.php');
require('../../BusinessLogicLayer/profileManagement.php');

if(isset($_POST)){
  if($_POST['action'] == "GetAllPendingVerifications") {

    $form_data = array();
    $error= '';

    $verifications= GetPendingVerifications();

    if($verifications == NULL) {
      $error = "Error: couldn't load  pending verification";
    }
    else {
      $form_data['verifications'] = $verifications;
      $form_data['success'] = true;
    }

    if (strlen($error) > 0) {
        $form_data['success'] = false;
        $form_data['error'] = $error;
    }

    echo json_encode($form_data);
  }


  else if($_POST['action'] ==  "GetAllUserVerificationImages") {
    $form_data = array();
    $error= '';

    $images= GetUserVerificationRequests($_POST['username']);

    if($images == NULL) {
      $error = "Error: couldn't load user images";
    }
    else {
      $form_data['images'] = $images;
      $form_data['success'] = true;
    }

    if (strlen($error) > 0) {
        $form_data['success'] = false;
        $form_data['error'] = $error;
    }

    echo json_encode($form_data);
  }



  else if ($_POST['action'] == 'verifyUser') {
    $form_data = array();
    $error= '';

    Verify($_POST['username']);
    $form_data['success'] = true;

    echo json_encode($form_data);

  }

}
