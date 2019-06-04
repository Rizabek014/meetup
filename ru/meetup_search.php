<?php
    $GLOBALS['filename'] = 'meetup_search';

    include ('Database.php');
    include ('nav.php');
    $result = NULL;
    if(isset($_POST['find']))
    {
        $search = $_POST['search_field'];
        $sql = "SELECT * FROM meetups WHERE name LIKE '%". $search . "%' OR location LIKE '%". $search . "%' OR address LIKE '%". $search . "%'";
        $result = mysqli_query($db,$sql);
    }
    $meetup = mysqli_query($db, "SELECT * FROM meetups");
    $image = mysqli_query($db, "SELECT * FROM image");

    if(isset($_POST['sphere_search']))
    {
        $sphere = $_POST['sphere'];
        $sql = "SELECT * FROM meetups WHERE sphere = '$sphere'";
        $result = mysqli_query($db,$sql);
    }

?>
<main id="main" class="main-page">

    <section id="speakers" class="wow fadeInUp">
        <div class="container">
            <div class="section-header">
                <h2>Результат Поиска</h2>
            </div>
            <form action="meetup_search.php" method="post">
                <div class="form-group">
                    <label>Сферы</label>
                    <select class="form-control" name = "sphere">
                        <option value="" selected disabled hidden>Выбрать здесь</option>
                        <option value="it">IT</option>
                        <option value="hackaton">Хакатон</option>
                        <option value="marathon">Марафон</option>
                        <option value="sport">Спорт</option>
                        <option value="mobile">Мобильные данные</option>
                        <option value="data science">Data Science</option>
                        <option value="activities">Мероприятия</option>
                        <option value="other">Другое</option>
                    </select>
                </div>
                <div class="text-center" style="margin:20px 0 10px 0;">
                    <button type="submit" class="btn" name="sphere_search">Искать</button>
                </div>
            </form>
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
                        <?php endif; endwhile; endif; ?>
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