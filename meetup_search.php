<?php
    $GLOBALS['filename'] = 'meetup_search';
    
    include ('Database.php');
    include ('nav.php');


    $result = NULL;
    if(isset($_POST['find']))
    {
        $search = $_POST['search_field'];
        $sql = "SELECT * FROM meetups WHERE name LIKE '%". $search . "%' OR location LIKE '%". $search . "%'";
        $result = mysqli_query($db,$sql);
        $GLOBALS['result']=mysqli_query($db,$sql);
    }

    $meetup = mysqli_query($db, "SELECT * FROM meetups");
    $image = mysqli_query($db, "SELECT * FROM image");


    
?>
<main id="main">
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
        </main>
    </body>
    <?php include ('footer.php'); ?>

</html>