<?php
    $GLOBALS['filename'] = 'profile';
    session_start();
    include ('Database.php');
    include("nav.php");
    include("login_registration.php");
    if(isset($_COOKIE["type"]))
    {
        $user_id = $_COOKIE['type'];
        $user = mysqli_query($db, "SELECT * FROM user WHERE user_id = '$user_id'");
        $users = mysqli_fetch_array($user);
        $user_name = $users['user_name'];
        $email = $users['email'];
        $address = $users['address'];
        $image = $users['logo'];
        $phone = $users['phone'];
        $is_admin = $users['is_admin'];
    }
?>
<main id="main">
    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
     <div class="container">
        <div class="section-header">
          <h2>Sign Up</h2>
          <p>Join our awesome community.</p>
        </div>

        <div class="row" >
          <div class="col-md-5"><input type = "file" name = "logo"></div>
          <div class="col-md-7" id = "height">
            <div class="details" >
                <div class="social"></div>
                <form method = "post" action = "Server.php">
                    <?php if (isset($_SESSION['message'])): ?>
                    <div class = "alert alert-danger">
                        <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        ?>
                    </div>
                    <?php endif ?>
                    
                    <div class="form-group" >
                        <label>Username</label>
                        <input class="form-control" type="text" name = "user_name" value="<?php echo $user_name; ?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name = "email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label>Phone number</label>
                        <input class="form-control" type="text" name="phone" value="<?php echo $phone; ?>">
                    </div>
                    <div class="text-center" style="margin:20px 0 10px 0;">
                        <input type="button" class="btn" onclick="change_password()" value="Change password">
                    </div>
                    <div id = "password_field" style="display: none">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input class="form-control" type="password" name="current_password">
                        </div>
                        <div class="form-group">
                            <label>New password</label>
                            <input class="form-control" type="password" name="new_password1">
                        </div>
                        <div class="form-group">
                            <label>Confirm new password</label>
                            <input class="form-control" type="password" name="new_password2">
                        </div>
                    </div>
                    <div class="text-center" style="margin:20px 0 10px 0;">
                        <button type="submit" name = "user_update" class = "btn">Save</button>
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
<script>
    function change_password() {
        var field = document.getElementById("password_field");
        if (field.style.display === "none") {
            field.style.display = "block";
            document.getElementById("height").style.height="600px";
            $( "p" ).text( "cancel" );
        } else {
            field.style.display = "none";
            document.getElementById("height").style.height="400px";
            $( "p" ).text( "change" );
        }

    }
</script>

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