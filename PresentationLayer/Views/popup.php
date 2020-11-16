<?php // TODO: implement login using AJAX ?>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-body login-page" id="login">
                <div class="form">
                  <form class="register-form" method="POST" action="../Scripts/SignUp.php">
                    <input type="text" placeholder="username" name= "username" required="true"/>
                    <input type="password" placeholder="password" name = "password" required="true"/>
                    <button type="submit" name="signUPpButton" value="submit">Sign up</button>
                    <p class="message">Already registered? <a href="#">Sign In</a></p>
                  </form>
                  <form class="login-form" method="POST" action="../Scripts/SignIn.php">
                    <input type="text" placeholder="username" name = "username"/>
                    <input type="password" placeholder="password" name="password"/>
                    <button type="submit" name="LoginButton" value="submit" >login</button>
                    <p class="message">Not registered? <a href="#">Create an account</a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
