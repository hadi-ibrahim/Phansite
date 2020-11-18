<?php

function Upload($target_file, $imageFileType, $uploadOk) {
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

      echo "The file ". htmlspecialchars($target_file). " has been uploaded.";
      return 1;

    } else echo "there was an error uploading file.";
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
