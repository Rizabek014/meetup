<?php
    $GLOBALS['filename'] = 'profile';
    include ('Database.php');
    include("nav.php");
    include("login_registration.php");
?>
<main id="main">
    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
      <div class="container">
        <div class="section-header" style="margin-top:50px;">
          <h2>User Profile</h2>
          <p>Join our awesome community.</p>
        </div>

        <div class="row" >
          <div class="col-md-5"></div>
          <div class="col-md-7" style="height: 500px;">
            <div class="details" >
                <div class="social"></div>
                <form method="post" action="sign_up.php">
                    <?php include('Errors.php'); ?>
                    <div class="form-group" >
                        <label>Username</label>
                        <input class="form-control" type="text" name="user_name" value='<?php echo $user_name; ?>'>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password_1">
                    </div>
                    <div class="form-group">
                        <label>Confirm password</label>
                        <input class="form-control" type="password" name="password_2">
                    </div>
                    <div class="form-group">
                        <label>Phone number</label>
                        <input class="form-control" type="text" name="phone">
                    </div>
                    <div class="text-center" style="margin:20px 0 10px 0;">
                        <button type="submit" class="btn" name="reg_user">Update</button>
                    </div>
                </form>                
            </div>
              
          </div>
            <div class="col-md-3">
            
          </div>
          
        </div>
      </div>

    </section>
</main>
<?php include("footer.php");?>
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