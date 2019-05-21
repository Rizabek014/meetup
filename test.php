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

    $meetup_name = array();
    $meetup_sphere = array();
    $member = mysqli_query($db, "SELECT meetup_id FROM member WHERE user_id = '$user_id'");
    $newsletter = mysqli_query($db, "SELECT newsletter_id FROM newsletter WHERE email = '$email'");
    $is_subscribed = mysqli_fetch_array($newsletter);

    while($member_of = mysqli_fetch_array($member))
    {
        $meetup_id = $member_of['meetup_id'];
        $meetup = mysqli_query($db, "SELECT * FROM meetups WHERE meetup_id = '$meetup_id'");
        $meetups = mysqli_fetch_array($meetup);
        array_push($meetup_sphere, $meetups['sphere']);
    }

    $spheres = array_count_values($meetup_sphere);
    $sphere = array_search(max($spheres), $spheres);
?>
<main id="main" class="main-page">
    <!--==========================
      User Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
     <div class="container">
        <div class="section-header">
          <h2>User Profile</h2>
          <p>Enter the most reliable information, so we can stay in touch.</p>
        </div>
        <div class="row" >
            <div class="col-md-5">
                <?php if(!empty($image)) echo "<img class='img-fluid' src='profiles/" . $image. "'>"; else echo "You don't have profile photo";?>
                <div class="form-group">
                    <label>List of name of joined meetups:</label>
                    <?php foreach ($meetup_name as $name) echo $name; ?>
                </div>
                <form method="post" action="Server.php">
                    <input type="hidden" name = "newsletter" value="<?= $email ?>">
                    <input type="hidden" name = "newsletter_sphere" value="<?= $sphere ?>">
                    <input type="hidden" name = "header" value="location: user_profile.php">
                    <?php if(is_null($is_subscribed)): ?>
                        <div class="col-auto">
                            <button type="submit" name="submit_newsletter">Subscribe to notification</button>
                        </div>
                    <?php else:?>
                        <input type="hidden" name="newsletter_id" value="<?= $is_subscribed['newsletter_id'] ?>">
                        <div class="col-auto">
                            <button type="submit" name="delete_newsletter">Unsubscribe to notification</button>
                        </div>
                    <?php endif;?>
                </form>
            </div>
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
                <div style="margin: 0 0 10px 0;">
                    <button type="submit" name = "user_update" class = "btn btn-danger" onclick="location.href='user_edit.php?user_edit=<?php echo $user_id ?>'">Edit Profile</button>
                </div>
                <div class="form-group">
                    <label>List of name of joined meetups:</label>
                    <?php
                        foreach ($meetup as $row)
                        {
                            echo "<a href='meetup_details.php?meetup=". $row['meetup_id']."'> ".$row['name']. "</a>";
                        }
                    ?>
                </div>
                <form method="post" action="Server.php">
                    <input type="hidden" name = "newsletter" value="<?= $email ?>">
                    <input type="hidden" name = "newsletter_sphere" value="<?= $sphere ?>">
                    <input type="hidden" name = "header" value="location: user_profile.php">
                    <?php if(is_null($is_subscribed)): ?>
                        <div class="col-auto">
                            <button type="submit" name="submit_newsletter">Subscribe to notification</button>
                        </div>
                    <?php else:?>
                        <input type="hidden" name="newsletter_id" value="<?= $is_subscribed['newsletter_id'] ?>">
                        <div class="col-auto">
                            <button type="submit" name="delete_newsletter">Unsubscribe to notification</button>
                        </div>
                    <?php endif;?>
                </form>
            </div>
        </div>
     </div>
    </section>
</main>
<?php include("footer.php");?>
</body>
</html>