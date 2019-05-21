<?php
    $GLOBALS['filename'] = 'meetups';

    include ('Database.php');
    include ('nav.php');

    $is_admin = false;
    $is_member = false;
    $is_organizer = false;
    $members_name = array();
    $is_logged_in = isset($_COOKIE["type"]);

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
        $points = $record['points'];
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
                $is_member = true;
                $member_id = $member['member_id'];
            }
        }
    }

    if($organizer_id == $user_id) $is_organizer = true;
?>
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
                  echo "<img src = 'images/".$row_img['file_name']."' class='img-fluid'>";
                  break;
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
        <?php elseif ($is_member && $is_logged_in): ?>
            <a href="Server.php?unjoin=<?= $user_id ?>&unjointo=<?= $meetup_id ?>" class="btn-primary">Unjoin</a>
        <?php elseif ($is_logged_in && !$is_member): ?>
            <a href="Server.php?join=<?= $user_id ?>&jointo=<?= $meetup_id ?>" class="btn-primary">Join</a>
        <?php endif;?>
          <p>Points: <?= $points?></p>
        <?php if($is_member): ?>
            <form action="Server.php" method="post">
                <input type = "hidden" name = "meetup_id" value = "<?php echo $meetup_id;?>">
                <input type = "hidden" name = "user_id" value = "<?php echo $user_id;?>">
                <input type = "hidden" name = "is_rated" value = "<?php echo $is_rated;?>">
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
            <?php while($row_img = mysqli_fetch_array($result_image)): ?>
                <div class="col-lg-3 col-md-4">
                    <div class="venue-gallery">
                        <a href="images/<?=$row_img['file_name']?>" class="venobox" data-gall="venue-gallery">
                             <img src ="images/<?=$row_img['file_name']?>"  class="img-fluid">
                        </a>
                    </div>
                </div>
            <?php endwhile;?>
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

<?php include ('footer.php'); ?>
</body>

</html>
