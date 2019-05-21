<?php
    $GLOBALS['filename'] = 'profile';
    session_start();
    include ('Database.php');
    include("nav.php");

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
<main id="main" class="main-page">
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
            <div class="col-md-5"><?= "<img class='img-fluid' src='profiles/" . $image. "'>"?></div>
            <div class="col-md-7" id = "height">
                <div class="details" >
                    <div class="social"><h2>Profile</h2></div>
                    <div class="form-group" >
                        <label>Name: </label>
                        <u><?= $user_name ?></u>
                    </div>
                    <div class="form-group">
                        <label>Email: </label>
                        <u><?= $email ?></u>
                    </div>
                    <div class="form-group">
                            <label>Phone number: </label>
                            <u><?= $phone ?></u>
                    </div>
                    <?php if(strlen($address)): ?>
                    <div class="form-group">
                            <label>Address: </label>
                            <u><?= $address ?></u>
                    </div>
                    <?php endif;?>
                </div>
                <div class = "input-group">
                    <a href="user_edit.php?user_edit=<?php echo $user_id ?>" class="edit_btn" >Edit</a>
                </div>
            </div>
        </div>
     </div>
    </section>
</main>
<?php include("footer.php");?>
</body>
</html>