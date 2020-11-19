<?php // TODO: implement profile lookup using AJAX ?>
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="loginModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-body profile-page" id="user-profile">
              <div class="container">
                <?php
                if($_SESSION['user']['isVerified'] == 1)
                  echo '<i class="fas fa-check-circle"  data-toggle="tooltip"
                           data-placement="bottom" data-html="true" ;
                           title="Verified"></i>';
                if($_SESSION['user']['isAdmin'] == 1)
                  echo '<i class="fas fa-user-shield" data-toggle="tooltip"
                            data-placement="bottom" data-html="true" ;
                            title="admin"></i>';

                if($_SESSION['user']['picPath']!= NULL)
                  echo '<img src="../Assets/img/profilePics/'.$_SESSION['user']['picPath'] .'" >';
                else echo '<img src="../Assets/img/profilePics/profile.png">';
                echo '<h1>' . $_SESSION['user']['username'] . '</h1>
                <p class="message"> <a class ="change-pic-btn" href="#"> Change Profile Picture </a> </p>
                <form class ="change-pic" action="../Scripts/uploadProfile.php" method="post" enctype="multipart/form-data">
                  <input type="file" name="fileToUpload" id="fileToUpload">
                  <button type="submit" name="submit"> Change </button>
                </form>';
                if($_SESSION['user']["isVerified"] == 0)
                  echo '<p class="message verify-acc-btn"> <a href="#"> Verify account </a> </p>
                  <form class ="verify-acc" action="../Scripts/uploadVerification.php" method="post" enctype="multipart/form-data">
                    <p class = "message"> Upload a picture of your id, an admin will verify it shortly.</p>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <button type="submit" name="submit"> Verify </button>
                  </form>';
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
