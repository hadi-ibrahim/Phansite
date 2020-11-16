<?php
include('../../BusinessLogicLayer/profileManagement.php');


$target_dir = "../Assets/img/profilePics/";
if($_SESSION['user']['picPath']!= NULL)
  $oldPicture= $target_dir . $_SESSION['user']['picPath'];
$fullFileName =explode(".",$_FILES["fileToUpload"]["name"]);
$fullFileName[0]= $_SESSION['user']['username'];
$_FILES["fileToUpload"]["name"] = implode(".", $fullFileName);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

echo "================================================== " . $_FILES["fileToUpload"]["name"];

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
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    SetProfilePicture($_SESSION['user'], $_FILES["fileToUpload"]["name"]);
    unlink($oldPicture);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
header("Location: ../Views/index.php");
exit();
?>
