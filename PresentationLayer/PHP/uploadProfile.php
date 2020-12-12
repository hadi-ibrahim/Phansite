<?php
session_start();
require("upload.php");
require('../../BusinessLogicLayer/profileManagement.php');

$target_dir = "../Assets/img/profilePics/";
$file = RenameFileByProfileName($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . ($file);
$image_path = $_SESSION['user']['picPath'];
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$imageFileType = strtolower($imageFileType);
$uploadOk = 1;

if($image_path!= NULL)
  $oldPicture= $target_dir . $image_path;

if(Upload($target_file, $imageFileType, $uploadOk)){
  SetProfilePicture($_SESSION['user'], $file);
  DeleteOldImageIfExists($oldPicture, $target_file);
}

header("Location: ../Views/index.html");
exit();
