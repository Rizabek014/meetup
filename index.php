<?php
    $GLOBALS['filename'] = 'index';

    include ('Database.php');
    include ('nav.php');

    $result = NULL;

    if(isset($_POST['find']))
    {
        $search = $_POST['search_field'];
        $sql = "SELECT * FROM meetups WHERE name LIKE '%". $search . "%' OR location LIKE '%". $search . "%'";
        $result = mysqli_query($db,$sql);
        $GLOBALS['result']= mysqli_query($db,$sql);
        header("Location: meetup_search.php");
    }

    $meetup = mysqli_query($db, "SELECT * FROM meetups");
    $image = mysqli_query($db, "SELECT * FROM image");

?>

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">
    <div class="intro-container wow fadeIn">
      <h1 class="mb-4 pb-0">Find your<br><span>Meetup</span> here</h1>
      <p class="mb-4 pb-0">Join to our wonderfull meetups and improve yourself</p>
      <a href="https://www.youtube.com/watch?v=KaQoj4mmY5E" class="venobox play-btn mb-4" data-vbtype="video"
        data-autoplay="true"></a>
      <a href="#about" class="about-btn scrollto">About The Event</a>
    </div>
  </section>

  <main id="main">

    <!--==========================
      About Section
    ============================-->
    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <h3>Most popular Events</h3>
          </div>
          <div class="col-lg-9">
            <ul class="nav-menu nav-tabs">
              <li class="menu-active" name = 'it'><a href="#about">#IT</a></li>
              <li class="menu-active"><a href="#about">#hackathon</a></li>
              <li class="menu-active"><a href="#about">#marathon</a></li>
              <li class="menu-active"><a href="#about">#google</a></li>
              <li class="menu-active"><a href="#about">#sport</a></li>
              <li class="menu-active"><a href="#about">#activities</a></li>
              <li class="menu-active"><a href="#about">#cooking</a></li>
              <li class="menu-active"><a href="#about">#mobile</a></li>
              <li class="menu-active"><a href="#about">#Data science</a></li>
            </ul>
          </div>
        </div>
      </div>

    </section>

    <section id="speakers" class="wow fadeInUp">
        <div class="container">
            <div class="row">
                <?php
                    if(isset($result)):
                        while ($tuple = mysqli_fetch_array($result)):
                            if($tuple['is_approved'] == 1):
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="speaker">
                        <?php
                        $check = true;
                        foreach ($image as $images) {
                            if ($images['meetup_id'] == $tuple['meetup_id'] && $check)
                            {
                                $check = false;
                                echo "<img class='img-fluid' src='images/" . $images['file_name'] . "'>";
                            }
                        }
                        ?>
                        <div class="details">
                            <h3 class='clickable-row' data-href="meetup_details.php?meetup=<?php echo $tuple['meetup_id']; ?>"><?php echo $tuple['name']; ?></h3>
                            <p><?php echo $tuple['location']; ?></p>
                            <div class="social">
                                <a href=""><i class="fa fa-twitter"></i></a>
                                <a href=""><i class="fa fa-facebook"></i></a>
                                <a href=""><i class="fa fa-google-plus"></i></a>
                                <a href=""><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; endwhile; endif; ?>
            </div>
        </div>
    </section>
    <!--==========================
      Speakers Section
    ============================-->
    <section id="speakers" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Explore Meetups</h2>
          <p>Here are some of our events</p>
        </div>

        <div class="row">
            <?php
                  while ($row = mysqli_fetch_array($meetup)):
                      if ($row['is_approved'] == 1) :
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="speaker">
                    <?php
                    $check = true;
                        foreach ($image as $images) {
                             if ($images['meetup_id'] == $row['meetup_id'] && $check) {
                                 $check = false;
                                 echo "<img class='img-fluid' src='images/" . $images['file_name'] . "'>";
                             }
                        }
                    ?>
                    <div class="details">
                        <h3 class='clickable-row' data-href="meetup_details.php?meetup=<?php echo $row['meetup_id']; ?>"><?php echo $row['name']; ?></h3>
                        <p><?php echo $row['location']; ?></p>
                        <div class="social">
                            <a href=""><i class="fa fa-twitter"></i></a>
                            <a href=""><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-google-plus"></i></a>
                            <a href=""><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; endwhile;?>
        </div>
      </div>
    </section>


    <!--==========================
      Gallery Section
    ============================-->
    <section id="gallery" class="wow fadeInUp">

      <div class="container">
        <div class="section-header">
          <h2>Gallery</h2>
          <p>Check our gallery from the recent events</p>
        </div>
      </div>

      <div class="owl-carousel gallery-carousel">
        <a href="img/gallery/1.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/1.jpg" alt=""></a>
        <a href="img/gallery/2.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/2.jpg" alt=""></a>
        <a href="img/gallery/3.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/3.jpg" alt=""></a>
        <a href="img/gallery/4.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/4.jpg" alt=""></a>
        <a href="img/gallery/5.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/5.jpg" alt=""></a>
        <a href="img/gallery/6.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/6.jpg" alt=""></a>
        <a href="img/gallery/7.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/7.jpg" alt=""></a>
        <a href="img/gallery/8.jpg" class="venobox" data-gall="gallery-carousel"><img src="img/gallery/8.jpg" alt=""></a>
      </div>

    </section>

    <!--==========================
      Sponsors Section
    ============================-->
    <section id="supporters" class="section-with-bg wow fadeInUp">

      <div class="container">
        <div class="section-header">
          <h2>Sponsors</h2>
        </div>

        <div class="row no-gutters supporters-wrap clearfix">

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="supporter-logo">
              <img src="img/supporters/iitu.png" class="img-fluid" alt="">
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="supporter-logo">
              <img src="img/supporters/unicef.png" class="img-fluid" alt="">
            </div>
          </div>
        
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="supporter-logo">
              <img src="img/supporters/3.png" class="img-fluid" alt="">
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="supporter-logo">
              <img src="img/supporters/4.png" class="img-fluid" alt="">
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="supporter-logo">
              <img src="img/supporters/5.png" class="img-fluid" alt="">
            </div>
          </div>
        
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="supporter-logo">
              <img src="img/supporters/6.png" class="img-fluid" alt="">
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="supporter-logo">
              <img src="img/supporters/7.png" class="img-fluid" alt="">
            </div>
          </div>
          
          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="supporter-logo">
              <img src="img/supporters/8.png" class="img-fluid" alt="">
            </div>
          </div>

        </div>

      </div>

    </section>

    <!--==========================
      F.A.Q Section
    ============================-->
    <section id="faq" class="wow fadeInUp">

      <div class="container">

        <div class="section-header">
          <h2>F.A.Q </h2>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-9">
              <ul id="faq-list">

                <li>
                  <a data-toggle="collapse" class="collapsed" href="#faq1"> How Meetup Works? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq1" class="collapse" data-parent="#faq-list">
                    <p>
                      Discover groups.
                      See who’s hosting local events for all the things you love.
                    </p>
                  </div>
                </li>
      
                <li>
                  <a data-toggle="collapse" href="#faq2" class="collapsed">How to create Meetup? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq2" class="collapse" data-parent="#faq-list">
                    <p>
                      First of all, you have to sign in. Then, click "Create meetup" button. Finally you have to wait for approvement.
                    </p>
                  </div>
                </li>
      
                <li>
                  <a data-toggle="collapse" href="#faq3" class="collapsed">Why you should attend Meetups? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq3" class="collapse" data-parent="#faq-list">
                    <p>
                      Everyone who attends will have similar interests<br>
                      They are a great way of meeting new people<br>
                      You will get ideas and inspiration from speakers and other attendees<br>
                      You are certain to pick up tips that you can implement in your own business<br>
                      By sharing what you are struggling with you may well find some helpful advice<br>
                      It’s an opportunity to spend some time in the real world, away from your laptop…    
                    </p>
                  </div>
                </li>
      
                <li>
                  <a data-toggle="collapse" href="#faq4" class="collapsed"> What is a Meetup? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq4" class="collapse" data-parent="#faq-list">
                    <p>
                      Meetups have developed over the last few years as a way for people who have a common interest, often having met and communicated over the Internet, to get together in real life. Meetups can take many forms but they are usually quite informal and often fun.
                    </p>
                  </div>
                </li>
      
                <li>
                  <a data-toggle="collapse" href="#faq5" class="collapsed">Why can't I find my new Meetup? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq5" class="collapse" data-parent="#faq-list">
                    <p>
                      When you first create a new Meetup, our Community Experience Team reviews it for content. We want to make sure it meets our Meetup guidelines, and other standards we have for events. Our members’ experience is crucial to us - from the types of Meetups available to join, to watching out for the obvious stuff like everyone’s safety. We typically approve new groups within 10 minutes, at which point we announce your group to all local members with matching interests.
                    </p>
                  </div>
                </li>
      
                <li>
                  <a data-toggle="collapse" href="#faq6" class="collapsed">How do I download/print my Meetup attendee list? <i class="fa fa-minus-circle"></i></a>
                  <div id="faq6" class="collapse" data-parent="#faq-list">
                    <p>
                      Once you've scheduled your Meetup and people have RSVP'd, you can download a spreadsheet of your attendees.<br> To download a list of your attendees on desktop and mobile web:<br>
                      Navigate to the event's page.<br>
                      Select Organizer tools and choose Manage RSVPs.<br>
                      Select tools and choose Download attendees.<br>
                      This will download your RSVP list to a spreadsheet document, where you can sort and print their names.
                    </p>
                  </div>
                </li>
      
              </ul>
          </div>
        </div>

      </div>

    </section>

    <!--==========================
      Subscribe Section
    ============================-->
    <section id="subscribe">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h2>Newsletter</h2>
          <p>Subscribe to our newsletter which will send you wonderfull news about meetups.</p>
        </div>

        <form method="POST" action="#">
          <div class="form-row justify-content-center">
            <div class="col-auto">
              <input type="text" class="form-control" placeholder="Enter your Email">
            </div>
            <div class="col-auto">
              <button type="submit">Subscribe</button>
            </div>
          </div>
        </form>

      </div>
    </section>
      

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">

      <div class="container">

        <div class="section-header">
          <h2>Contact Us</h2>
          <p>You are very welcome to contact us by any question.</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>050040 Almaty, Manas Str. 34/1</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+77087082628">+7 7087082628</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:apushev.ye@gmail.com">apushev.ye@gmail.com</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form action="Server.php" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="send-email">Send Message</button></div>
          </form>
        </div>

      </div>
    </section><!-- #contact -->

  </main>

  <?php include ('footer.php'); ?>

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

<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>