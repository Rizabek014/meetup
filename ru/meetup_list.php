<?php
    $GLOBALS['filename'] = 'meetup_search';

    include ('Database.php');
    include ('nav.php');
    $result = NULL;
    if(isset($_GET['user_id']))
    {
        $user_id = $_GET['user_id'];
        $sql = "SELECT * FROM meetups WHERE organizer_id = '$user_id'";
        $result = mysqli_query($db,$sql);
        $results = mysqli_query($db,$sql);
    }
    $image = mysqli_query($db, "SELECT * FROM image");

?>
<main id="main" class="main-page">
    <section id="speakers" class="wow fadeInUp">
        <div class="container">
            <div class="section-header">
                <h2>Мои Meetup'ы</h2>
            </div>
            <h2>Подтвержденные </h2>
            <div class="row">
                <?php
                    while ($tuple = mysqli_fetch_array($result)):
                        if($tuple['is_approved']):
                ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="speaker">
                            <?php
                                $check = true;
                                foreach ($image as $images) {
                                    if ($images['meetup_id'] == $tuple['meetup_id'] && $check)
                                    {
                                        $check = false;
                                        echo "<img class='img-fluid' src='../images/" . $images['file_name'] . "'>";
                                    }
                                }
                            ?>
                            <div class="details">
                                <h3 class='clickable-row' data-href="meetup_details.php?meetup=<?php echo $tuple['meetup_id']; ?>"><?php echo $tuple['name']; ?></h3>
                                <p><?php echo $tuple['location']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    endif;
                    endwhile;
                ?>
            </div>
            <h2>Ждут Подтверждения </h2>
            <div class="row">
                <?php
                while ($tuple = mysqli_fetch_array($results)):
                    if(!$tuple['is_approved']):
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="speaker">
                                <?php
                                $check = true;
                                foreach ($image as $images) {
                                    if ($images['meetup_id'] == $tuple['meetup_id'] && $check)
                                    {
                                        $check = false;
                                        echo "<img class='img-fluid' src='../images/" . $images['file_name'] . "'>";
                                    }
                                }
                                ?>
                                <div class="details">
                                    <h3 class='clickable-row' data-href="meetup_details.php?meetup=<?php echo $tuple['meetup_id']; ?>"><?php echo $tuple['name']; ?></h3>
                                    <p><?php echo $tuple['location']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    endif;
                endwhile;
                ?>
            </div>
        </div>
    </section>
</main>
<?php include ('footer.php'); ?>
</body>
</html>
<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>