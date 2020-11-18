<?php
require("upload.php");
require('../../BusinessLogicLayer/profileManagement.php');

$target_dir = "../Assets/img/profilePics/";
$file = RenameFileByProfileName($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . ($file);
$image_path = $_SESSION['user']['picPath'];
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$uploadOk = 1;

if($image_path!= NULL)
  $oldPicture= $target_dir . $image_path;

if(Upload($target_file, $imageFileType, $uploadOk)){
  SetProfilePicture($_SESSION['user'], $file);
  DeleteOldImageIfExists($oldPicture, $target_file);
}

header("Location: ../Views/index.php");
exit();
