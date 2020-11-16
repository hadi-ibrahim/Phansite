<?php // TODO: implement profile lookup using AJAX ?>
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="loginModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-body profile-page" id="user-profile">
              <div class="container">
                <?php
                if($_SESSION['user']['picPath']!= NULL)
                  echo '<img src="../Assets/img/profilePics/'.$_SESSION['user']['picPath'] .'" >';
                else echo '<img src="../Assets/img/profilePics/profile.png">';
                  echo '<h1>' . $_SESSION['user']['username'] . '</h1>
                  <form action="../Scripts/upload.php" method="post" enctype="multipart/form-data">
                    change profile picture:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Upload Image" name="submit">
                  </form>                  ';
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
