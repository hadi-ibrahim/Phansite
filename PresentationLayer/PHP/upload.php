<?php

function Upload($target_file, $imageFileType, $uploadOk) {
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
    }
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 10000000) {
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

      return 1;

    } else
     return 0;
  }
}

function DeleteOldImageIfExists($old, $new){
  if($old!= $new)
    unlink($old);
}

function RenameFileByProfileName($file_to_rename) {
  $fullFileName =explode(".",$file_to_rename);
  $fullFileName[0]= $_SESSION['user']['username'];
  return implode(".", $fullFileName);
}

?>
