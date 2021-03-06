<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>About</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon1.png" rel="icon">
  <link href="img/apple_touch_icon1.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/venobox/venobox.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: TheEvent
    Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header" class="header-fixed">
    <div class="container">

      <div id="logo" class="pull-left">
          <h1><a href="index.php">Meet<span>UP</span></a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
             <?php if (!isset($_COOKIE["type"])): ?>
             <li class="buy-tickets"><a href="sign_in.php">Sign in</a></li>
            <li class="buy-tickets"><a href="sign_up.php">Sign up</a></li>
            <?php else:?>
          <li class="buy-tickets"><a href="user_details.php"><?php echo $user_name ?></a></li>
          <li class="buy-tickets"><a href="Logout.php">Log out</a></li>
            <?php endif ?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <main id="main" class="main-page">

    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
      <div class="container">
        <div class="section-header">
          <h2>Our team</h2>
          <p>Detailed information about our team.</p>
        </div>

        <div class="row">
                      <div class="col-md-1"></div>

          <div class="col-md-5">
            <img src="img/team/1.jpg" style="width: 300px; height:300px;" alt="Speaker 1" class="img-fluid">
          </div>

        <div class="col-md-6">
            <div class="details">
              <h2>Apushev Yelaman</h2>
              <div class="social">
                <a href="https://vk.com/apushev_yelaman"><i class="fa fa-vk"></i></a>
                <a href="https://vk.com/apushev_yelaman"><i class="fa fa-facebook"></i></a>
                <a href="https://vk.com/apushev_yelaman"><i class="fa fa-google-plus"></i></a>
                <a href="https://vk.com/apushev_yelaman"><i class="fa fa-instagram"></i></a>
              </div>
              <p>An enthusiastic individual who is seeking a placement position to enable skills of IT  development.</p>
 
              <p>I am working as backend developer in ""</p> 

              <p>Last years, I worked as a tutor in “IT school” in IITU, currently works as backend developer in “KazDream” LLC
                </p>
            </div>
          </div>            
        </div>
          <br><br><br>
        <div class="row">
            <div class="col-md-1"></div>
          <div class="col-md-5">
            <img src="img/team/2.jpg" style="width: 300px; height:300px;" alt="Speaker 1" class="img-fluid">
          </div>

            <div class="col-md-6">
            <div class="details">
              <h2>Kabzhanov Rizabek</h2>
              <div class="social">
                <a href="https://vk.com/tumakatason"><i class="fa fa-vk"></i></a>
                <a href="https://vk.com/tumakatason"><i class="fa fa-facebook"></i></a>
                <a href="https://vk.com/tumakatason"><i class="fa fa-google-plus"></i></a>
                <a href="https://vk.com/tumakatason"><i class="fa fa-instagram"></i></a>
              </div>
              <p>An enthusiastic individual who is seeking a placement position to enable skills of IT  development.</p>
 
              <p>I am working as backend developer in ""</p> 

              <p>Last years, I worked as a tutor in “IT school” in IITU, currently works as backend developer in “KazDream” LLC
                </p>
            </div>
          </div>
            

            
            
          
        </div>
          <br><br><br>
                  <div class="row">
                      <div class="col-md-1"></div>
          <div class="col-md-5">
            <img src="img/team/3.jpg" style="width: 300px; height:300px;" alt="Speaker 1" class="img-fluid">
          </div>

          
            
        <div class="col-md-6">
            <div class="details">
              <h2>Zharas Mergazy</h2>
              <div class="social">
                <a href="https://vk.com/id185467790"><i class="fa fa-vk"></i></a>
                <a href="https://vk.com/id185467790"><i class="fa fa-facebook"></i></a>
                <a href="https://vk.com/id185467790"><i class="fa fa-google-plus"></i></a>
                <a href="https://vk.com/id185467790"><i class="fa fa-instagram"></i></a>
              </div>
              <p>An enthusiastic individual who is seeking a placement position to enable skills of IT  development.</p>
 
              <p>I am working as backend developer in ""</p> 

              <p>Last years, I worked as a tutor in “IT school” in IITU, currently works as backend developer in “KazDream” LLC
                </p>
            </div>
          </div>
            
            
          
        </div>
      </div>

    </section>

  </main>
    
  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <img src="img/logo.png" alt="TheEvenet">
            <p>In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor et totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="#">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">About us</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Services</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>TheEvent</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
        -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/venobox/venobox.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
</body>

</html>
