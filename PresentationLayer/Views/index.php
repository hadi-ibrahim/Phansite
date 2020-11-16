<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <link rel="stylesheet" href="../Assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/Earwig%20Factory.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Electrolize">
    <link rel="stylesheet" href="../Assets/css/p5hatty.css">
    <link rel="stylesheet" href="../Assets/css/styles.css">
    <link rel="stylesheet" href="../Assets/css/popup.css">
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top">
        <div class="container"><a class="navbar-brand" href="index.php"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarResponsive"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Phorum</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">phan-vote</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">phan-request</a></li>
                </ul>
                <ul class="nav navbar-nav ml-auto">
                  <?php if(!isset($_SESSION['user']))
                    echo '<li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#loginModal">Login/signup</a></li>';
                    else{
                    echo '<div class="dropdown">';
                      if($_SESSION['user']['picPath'] != NULL)
                            echo '<img class= "profile" src="../Assets/img/' . $_SESSION['user']['picPath'] . '"/>';
                      else
                            echo '<img class= "profile" src="../Assets/img/profile.png"/>';
                            echo '
                            <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                              . $_SESSION['user']['username'] . '
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="logout.php">Logout</a>
                              <a class="dropdown-item" href="#">View Profile</a>
                            </div>
                          </div>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <header class="d-flex justify-content-center align-items-end masthead text-center hero-section">
        <div class="masthead-content">
            <div class="container"><img class="logo" src="../Assets/img/phantomThievesLogo.png">
                <h1 class="masthead-heading mb-0 calling-card">PHANsiTE</h1>
                <h2 class="masthead-subheading mb-0 section-link" onclick="scrollToElement('section')"></h2>
            </div>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5"><img class="rounded-circle img-fluid right-shadow section-link" src="../Assets/img/phorum.jpg"></div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4 p5">Phorum</h2>
                        <p class="phantom-text">Connect with millions of people around the world, and share your thoughts and opinions about anything you'd like&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5"><img class="rounded-circle img-fluid left-shadow section-link" src="../Assets/img/vote.jpg"></div>
                </div>
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5">
                        <h2 class="display-4 p5">Phan-Vote</h2>
                        <p class="phantom-text">Join others in an opinion debate about the latest controversial issues, and check the general public's point of view</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5"><img class="rounded-circle img-fluid right-shadow section-link" src="../Assets/img/phanRequest.png"></div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4 p5">Phan-request</h2>
                        <p class="phantom-text">No more deception, hypocrisy and corruption. Send us your request anonymously to change corrupt hearts<br><br><br><br></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer >
        <div class="container">
            <p class="text-center text-white m-0 small">Copyright&nbsp;© Phansite 2020</p>
        </div>
    </footer>
    <?php include "popup.php" ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
    $('.message a').click(function(){
      $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });

    function scrollToElement(selector) {
      let tag = $(selector);
      $('html,body').animate({
          scrollTop: tag.offset().top
      }, 'slow');
    }
  </script>
</body>
</html>
