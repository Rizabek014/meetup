<?php
    include ('Database.php');

    $user_id = 0;
    $is_admin = false;
    $is_member = false;
    $is_organizer = false;
    $members_name = array();

    if(isset($_COOKIE["type"]))
    {
        $user_id = $_COOKIE['type'];
        $user = mysqli_query($db, "SELECT * FROM user WHERE user_id = '$user_id'");
        $users = mysqli_fetch_array($user);
        $user_name = $users['user_name'];
        $is_admin = $users['is_admin'];
    }

    if(isset($_GET['meetup']))
    {
        $meetup_id = $_GET['meetup'];

        $rec = mysqli_query($db, "SELECT * FROM meetups WHERE meetup_id = $meetup_id" );
        $record = mysqli_fetch_array($rec);

        $name = $record['name'];
        $description = $record['description'];
        $date = $record['date'];
        $location = $record['location'];
        $sphere = $record['sphere'];
        $organizer_id = $record['organizer_id'];
        $meetup_id = $record['meetup_id'];
        $is_approved = $record['is_approved'];
    }

    $sql_image = "SELECT * FROM image WHERE meetup_id = $meetup_id";
    $result_image = mysqli_query($db, $sql_image);

    $sql_comment = "SELECT * FROM comment WHERE meetup_id = $meetup_id";
    $result_comment = mysqli_query($db, $sql_comment);

    $users = mysqli_query($db,"SELECT * FROM user ");
    $user = mysqli_fetch_array($users);

    $members = mysqli_query($db, "SELECT * FROM member WHERE meetup_id = $meetup_id");

    foreach ($users as $user)
    {
        if($user['user_id'] == $organizer_id)
        {
            $organizer_name = $user['user_name'];
        }

        foreach ($members as $member)
        {
            if($user['user_id'] == $member['user_id']) array_push($members_name, $user['user_name']);

            if($member['user_id'] == $user_id)
            {
                $member_id = $member['member_id'];
                $is_member = true;
                $is_rated = $member['is_rated'];
            }
        }
    }

    if($organizer_id == $user_id) $is_organizer = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>TheEvent - Bootstrap Event Template</title>
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
          <li><a href="#venue">Photos from location</a></li>
          <li><a href="#hotels">Hotels</a></li>
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
          <h2>Meetup Details</h2>
        </div>

        <div class="row">
          <div class="col-md-6">
              <?php
              while($row_img = mysqli_fetch_array($result_image))
              {
                  echo "<img src = 'images/".$row_img['path']."' class='img-fluid'>";
              }
              ?>
          </div>

          <div class="col-md-6">
            <div class="details">
                <h2><?= $name ?></h2>
                <p><?= $date ?></p>
                <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-linkedin"></i></a>
                </div>
                <p><?= $location ?></p>
                <h2>Meetup description</h2>
                <p><?= $description ?></p>
                <h3>Organizer</h3>
                <?= $organizer_name . "<br>";?>

                <h6>List of Members</h6>
                <?php
                foreach ($members_name as $names)
                {
                    echo $names." ";
                }
                ?>
            </div>
          </div>
        </div>
        <?php if($is_organizer || $is_admin):?>
            <a href="edit.php?edit=<?= $meetup_id ?>" class="edit_btn" >Edit</a>
            <a href="AdminServer.php?del=<?= $meetup_id ?>" class="del_btn">Delete</a>
            <?php if($is_admin && !$is_approved): ?>
                <a href="AdminServer.php?approve=<?= $meetup_id ?>" class="edit_btn">Approve</a>
            <?php endif;?>
            <?php if($is_admin && $is_approved): ?>
                <a href="AdminServer.php?disapprove=<?= $meetup_id ?>" class="edit_btn">Disapprove</a>
            <?php endif;?>
        <?php elseif ($is_member && isset($_COOKIE["type"])): ?>
            <a href="Server.php?unjoin=<?= $user_id ?>&unjointo=<?= $meetup_id ?>" class="btn-primary">Unjoin</a>
        <?php elseif (isset($_COOKIE["type"]) && !$is_member): ?>
            <a href="Server.php?join=<?= $user_id ?>&jointo=<?= $meetup_id ?>" class="btn-primary">Join</a>
        <?php endif;?>
        <?php if($is_member && !$is_rated): ?>
            <form action="Server.php" method="post">
                <input type = "hidden" name = "meetup_id" value = "<?php echo $meetup_id;?>">
                <input type = "hidden" name = "member_id" value = "<?php echo $member_id;?>">
                <input type = "range" name = "points" min = "0" max = "100">
                <input type = "submit" name = "submit_points">
            </form>
        <?php endif;?>
      </div>
    </section>

    <section id="speakers-details" class="wow fadeIn">
        <div class="container">
            <div class="section-header">
                <h2>Comments</h2>
            </div>

            <div class="row">
                <form method = "post" action="Server.php">
                    <input type = "hidden" name = "meetup_id" value="<?php echo $meetup_id;?>">
                    <input type = "hidden" name = "user_id" value="<?php echo $user_id;?>">
                    <div class="col-md-6">
                        <div class="details">
                            <?php
                            while($row_comment = mysqli_fetch_array($result_comment))
                            {
                               foreach ($users as $user)
                                {
                                    if($user['user_id'] == $row_comment['user_id'])
                                    {
                                        echo $user['user_name']."<br>";
                                        echo $row_comment['comment']."<br>";
                                    }
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <input type = "text" name = "comment">
                    <button type="submit" name = "submit_comment" class = "btn">Submit</button>
                </form>
            </div>
        </div>
      </section>
  </main>

    <!--==========================
      Venue Section
    ============================-->
    <section id="venue" class="section-with-bg wow fadeInUp">

      <div class="container-fluid">

        <div class="section-header">
          <h2>Event Venue</h2>
          <p>Event venue location info and gallery</p>
        </div>

        <div class="row no-gutters">
          <div class="col-lg-6 venue-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>

          <div class="col-lg-6 venue-info">
            <div class="row justify-content-center">
              <div class="col-11 col-lg-8">
                <h3>Downtown Conference Center, New York</h3>
                <p>Iste nobis eum sapiente sunt enim dolores labore accusantium autem. Cumque beatae ipsam. Est quae sit qui voluptatem corporis velit. Qui maxime accusamus possimus. Consequatur sequi et ea suscipit enim nesciunt quia velit.</p>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="container-fluid venue-gallery-container">
        <div class="row no-gutters">

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/1.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/1.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/2.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/2.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/3.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/3.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/4.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/4.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/5.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/5.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/6.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/6.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/7.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/7.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="venue-gallery">
              <a href="img/venue-gallery/8.jpg" class="venobox" data-gall="venue-gallery">
                <img src="img/venue-gallery/8.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

        </div>
      </div>

    </section>

    <!--==========================
      Hotels Section
    ============================-->
    <section id="hotels" class="wow fadeInUp">

      <div class="container">
        <div class="section-header">
          <h2>Hotels</h2>
          <p>Her are some nearby hotels</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="hotel">
              <div class="hotel-img">
                <img src="img/hotels/1.jpg" alt="Hotel 1" class="img-fluid">
              </div>
              <h3><a href="#">Hotel 1</a></h3>
              <div class="stars">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
              <p>0.4 Mile from the Venue</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="hotel">
              <div class="hotel-img">
                <img src="img/hotels/2.jpg" alt="Hotel 2" class="img-fluid">
              </div>
              <h3><a href="#">Hotel 2</a></h3>
              <div class="stars">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-full"></i>
              </div>
              <p>0.5 Mile from the Venue</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="hotel">
              <div class="hotel-img">
                <img src="img/hotels/3.jpg" alt="Hotel 3" class="img-fluid">
              </div>
              <h3><a href="#">Hotel 3</a></h3>
              <div class="stars">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
              <p>0.6 Mile from the Venue</p>
            </div>
          </div>

        </div>
      </div>

    </section>


<!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <img src="img/logo1.png" alt="Meetup">
            <p>Meetups have developed over the last few years as a way for people who have a common interest, often having met and communicated over the Internet, to get together in real life. Meetups can take many forms but they are usually quite informal and often fun. </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="fa fa-angle-right"></i> <a href="index.php">Home</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="about.php">About us</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="#speakers">Meetups</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="https://www.meetup.com/terms/">Terms of service</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="https://www.meetup.com/privacy/">Privacy policy</a></li>
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
              Manas Str. 34/1<br>
              Almaty, 050040 <br>
              Kazakhstan <br>
              <strong>Phone:</strong> +7 7087082628<br>
              <strong>Email:</strong> apushev.ye@gmail.com<br>
            </p>

            <div class="social-links">
              <a href="https://vk.com/tumakatason" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="https://vk.com/tumakatason" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="https://vk.com/tumakatason" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="https://vk.com/tumakatason" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="https://vk.com/tumakatason" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Meetup</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
        -->
        Designed by <a href="https://vk.com/iconiceternal" target="_blank">Eternal Gang</a>
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
