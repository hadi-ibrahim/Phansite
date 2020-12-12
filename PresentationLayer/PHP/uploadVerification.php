<?php
session_start();
require("upload.php");
require('../../BusinessLogicLayer/profileManagement.php');

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

Upload($target_file, $imageFileType, $uploadOk);
RequestVerification($_SESSION['user'], $file);

header("Location: ../Views/index.html");
exit();
