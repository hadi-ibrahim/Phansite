<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-body profile-page" id="user-profile">
              <div class="container">
                <div class= "badges">
                </div>

                <div class= "profile-in-modal">
                  <img src="../Assets/img/profilePics/profile.png"/>
                    <h1 class="profile-username"></h1>
                </div>
                <p class="profile-notification"></p>
                <p class="message"> <a class ="change-pic-btn" href="#"> Change Profile Picture </a> </p>
                <form class ="change-pic" action="../PHP/uploadProfile.php" method="post" enctype="multipart/form-data">
                  <input type="file" name="fileToUpload">
                  <button type="submit" name="submit" class= "upload-profile-btn"> Change </button>
                </form>
                <div class= "verify-acc">
                  <p class="message verify-acc-btn"> <a href="#"> Verify account </a> </p>
                  <form class ="verify-acc" action="../PHP/uploadVerification.php" method="post" enctype="multipart/form-data">
                    <p class = "message"> Upload a picture of your id, an admin will verify it shortly.</p>
                    <input type="file" name="fileToUpload">
                    <button type="submit" name="submit"> Verify </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
