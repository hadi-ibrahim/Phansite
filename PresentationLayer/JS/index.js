$('.login-page .message a').click(function(){
  $('.login-page form').animate({height: "toggle", opacity: "toggle"}, "slow");
});

$('.verify-acc-btn').click(function(){
  $('.verify-acc').animate({height: "toggle", opacity: "toggle"}, "slow");
});

$('.change-pic-btn').click(function(){
  $('.change-pic ').animate({height: "toggle", opacity: "toggle"}, "slow");
});

function scrollToElement(selector) {
  let tag = $(selector);
  $('html,body').animate({
      scrollTop: tag.offset().top
  }, 'slow');
}
// =================== signup ===================//
$(".register-form").validate({
    rules: {
        username: {
            required: true,
            rangelength: [3,40]
        },

        password: {
            required: true,
            rangelength: [7, 70]
        }

    },
    messages: {
        username: {
            required: "Please enter your username",
            minLength: "Your username must be between 3 and 40 characters"
        },
        password: {
            required: "Please enter a password",
            minlength: "Your password must be between 7 and 15 characters long"
        }
    },
    submitHandler: function () {
        console.log("Form submit event started");
        $('input, .email-validity').empty();

        const postForm = {
            'username': $('.register-form input[name="username"]').val(),
            'password': $('.register-form input[name="password"]').val(),
            'action': 'signup'
        };

        $.ajax({
            type: 'POST',
            url: '../PHP/services.php',
            data: postForm,
            dataType: 'json',

            success: function (response) {
                if (!response.success) {
                    if (response.error) {
                      $('.email-validity').addClass("invalid");
                      $('.email-validity').html(response.error);
                  }
                } else {
                  $('#email-validity').addClass("valid");
                  $('#email-validity').html( response.posted );
                  $('#loginModal').modal('toggle');

                  $('#profile-selector img').removeClass("deactivated");
                  if(response.user.picPath != null)
                    $('#profile-selector img').attr('src', '../Assets/img/profilePics/' + response.user.picPath);
                  else
                    $('#profile-selector img').attr('src', '../Assets/img/profilePics/profile.png');

                  $('#profile-selector #dropdownMenuButton').text(response.user.username);
                  $('#profile-selector').removeClass('deactivated');
                  $('#login-signup').addClass("deactivated");

                  console.log(response.user);
                }
            },
            error: function(e) {
              console.log("error");
              console.log(e);
            },
            complete: function () {
                $('input, .register-form .submit-btn').prop("disabled", false);
                $("#divLoader").removeClass("loader");
                $('.overlay').addClass('hidden');
                console.log("Ajax call completed");
            }

        });
        console.log("Form submit event ended");
        return false;
    }
});


// =============== validate username =============== //
$('.register-form input[name="username"]').blur(function() {
  const postForm = {
      'username': $('.register-form input[name="username"]').val(),
      'action': 'validateUsername'
  };
  console.log("focus out event !")

  $.ajax({
      type: 'POST',
      url: '../PHP/services.php',
      data: postForm,
      dataType: 'json',
      success: function (response) {
        console.log(response);
          if (!response.success) {
              $('.email-validity').removeClass("valid");
              $('.email-validity').addClass("invalid");
              $('.email-validity').text(response.error);
              $('.register-form .submit-btn').prop("disabled", true);
              console.log(response.error);

          } else{
            $('.email-validity').removeClass("invalid");
            $('.email-validity').addClass("valid");
            $('.email-validity').text(response.posted);
            $('.register-form .submit-btn').prop("disabled", false);
          }

      },
      error: function (e) {
        $('.register-form .submit-btn').prop("disabled", false);
          alert("System currently unavailable, try again later.");
          console.log("Ajax call error");
          console.log(e);
      }

  });
  console.log("Form submit event ended");
  return false;
});

// ============ view profile  ===============//
$(".view-profile-btn").click( function() {
  const postForm = {
      'action': 'GetSelfProfile',
  };
  $.ajax({
      type: 'POST',
      url: '../PHP/services.php',
      data: postForm,
      dataType: 'json',

      success: function (response) {
        html ="";
        src="../Assets/img/profilePics/";

        console.log(response);

        if(response.user.isVerified == 1 ) {
          $(".verify-account").addClass("deactivated");
          html+='<i class="fas fa-check-circle" data-toggle="tooltip" data-placement="bottom" data-html="true"; title="Verified"></i>';
        }
        if(response.user.isAdmin == 1) {
          html+='<i class="fas fa-user-shield" data-toggle="tooltip" data-placement="bottom" data-html="true" ; title="Admin"></i>';
        }

        $(".badges").html(html);

        if(response.user.picPath!=null)
          src+= response.user.picPath;
        else
          src += "profile.png";

        $(".profile-in-modal img").attr("src", src);
        $(".profile-in-modal .profile-username").html(response.user.username);

        console.log("Ajax call success");
      },
      error: function (e) {
          alert("System currently unavailable, try again later.");
          console.log("Ajax call error");
          console.log(e);
      }
    });
});


// =============== logout =================//
$(".logout-btn-toggle").click( function() {
  const postForm = {
      'action': 'logout',
  };
  $.ajax({
      type: 'POST',
      url: '../PHP/services.php',
      data: postForm,
      dataType: 'json',

      success: function (response) {
        console.log("logged out");

        $('#profile-selector img').addClass("deactivated");
        $('#profile-selector img').removeAttr("src");


        $('#profile-selector').addClass('deactivated');
        $('#login-signup').removeClass("deactivated");

          console.log("Ajax call success");
      },
      error: function (e) {
          alert("System currently unavailable, try again later.");
          console.log("Ajax call error");
          console.log(e);
      }
    });
});

// ================= login =================//
$(".login-btn").click( function(e) {
  e.preventDefault();
  console.log("LOGIN INITIATED");
  const postForm = {
    'username': $('.login-form input[name="username"]').val(),
    'password': $('.login-form input[name="password"]').val(),
    'action': 'login'
    };
  $.ajax({
      type: 'POST',
      url: '../PHP/services.php',
      data: postForm,
      dataType: 'json',

      success: function (response) {
        console.log(response);
        if (!response.success) {
            if (response.error) {
              $('.login-validity').addClass("invalid");
              $('.login-validity').html(response.error);
          }
        } else {
          $('#login-validity').addClass("valid");
          $('#login-validity').html( response.posted );
          $('#loginModal').modal('toggle');

          $('#profile-selector img').removeClass("deactivated");
          if(response.user.picPath != null){
            $('#profile-selector img').attr('src', '../Assets/img/profilePics/' + response.user.picPath);
          }
          else
            $('#profile-selector img').attr('src', '../Assets/img/profilePics/profile.png');

          $('#profile-selector #dropdownMenuButton').text(response.user.username);
          $('#profile-selector').removeClass('deactivated');
          $('#login-signup').addClass("deactivated");

      }
    },
    error: function (e) {
          alert("System currently unavailable, try again later.");
          console.log("Ajax call error");
          console.log(e);
      }
    });
});

//  ================ upload profile pic

    $('.change-pic').on('submit',(function(e) {
      e.preventDefault();
      var formData = new FormData(document.querySelector(".change-pic"));
      formData.append("action", "uploadProfile");
      $.ajax({
          type:'POST',
          url:"../PHP/services.php",
          data:formData,
          cache:false,
          contentType: false,
          processData: false,

          success:function(response){
            console.log(response);
            result = JSON.parse(response);

            if (result.success){
              console.log("uploaded");
              $('.profile-in-modal img').attr('src', '../Assets/img/profilePics/' + result.user.picPath);
              $('#profile-selector img').attr('src', '../Assets/img/profilePics/' + result.user.picPath);
              $(".upload-validity").addClass("valid");
              $(".upload-validity").removeClass("invalid");
              $(".upload-validity").html("Profile updated");
          }
          else {
            $(".upload-validity").addClass("invalid");
            $(".upload-validity").removeClass("valid");
            $(".upload-validity").html("Failed to update profile picture");
          }

          },
          error: function(data){
            $(".upload-validity").addClass("invalid");
            $(".upload-validity").removeClass("valid");
            $(".upload-validity").text("Failed to update profile picture");
            console.log("ERROR" + data);
          },
          complete: function (){
            $('.profile-page input').val("");
          }
      });
  }));
  //  ================ upload verification pic

      $('.verify-acc').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(document.querySelector(".verify-acc"));
        formData.append("action", "uploadVerification");
        $.ajax({
            type:'POST',
            url:"../PHP/services.php",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,

            success:function(response){
              $(".upload-validity").addClass("valid");
              $(".upload-validity").removeClass("invalid");
              $(".upload-validity").html("Picture sent for validation")
            },
            error: function(data){
              $(".upload-validity").addClass("invalid");
              $(".upload-validity").removeClass("valid");
              $(".upload-validity").html("Failed to send picture for validation");
              console.log("ERROR" + data);
            },
            complete: function (){
              $('.profile-page input').val("");
            }
        });
    }));

// ============================ check session if logged in
$(document).ready(function() {
    const postForm = {
      'action': 'isLoggedIn'
      };
    $.ajax({
        type: 'POST',
        url: '../PHP/services.php',
        data: postForm,
        dataType: 'json',

        success: function (response) {
          console.log(response);
          if (response.success) {
            $('#profile-selector img').removeClass("deactivated");
            if(response.user.picPath != null){
              $('#profile-selector img').attr('src', '../Assets/img/profilePics/' + response.user.picPath);
            }
            else
              $('#profile-selector img').attr('src', '../Assets/img/profilePics/profile.png');

            $('#profile-selector #dropdownMenuButton').text(response.user.username);
            $('#profile-selector').removeClass('deactivated');
            $('#login-signup').addClass("deactivated");

        }
      },
      error: function (e) {
        console.log("No user logged in");
        }
      });
  });