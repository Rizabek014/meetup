<?php
$GLOBALS['filename'] = 'profile';
session_start();
include ('Database.php');
include("nav.php");
include('today_is_meetup.php');

$meetup_array = array();
$meetup_sphere = array();

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
    $is_warned = $users['is_warned'];
}

$tz_object = new DateTimeZone('Asia/Almaty');
$datetime = new DateTime();
$datetime->setTimezone($tz_object);
$dating = $datetime->format('Y\-m\-d');

$member = mysqli_query($db, "SELECT meetup_id FROM member WHERE user_id = '$user_id'");
$newsletter = mysqli_query($db, "SELECT newsletter_id FROM newsletter WHERE email = '$email'");
$is_subscribed = mysqli_fetch_array($newsletter);

while($member_of = mysqli_fetch_array($member))
{
    $meetup_id = $member_of['meetup_id'];
    $meetup = mysqli_query($db, "SELECT * FROM meetups WHERE meetup_id = '$meetup_id'");
    $meetups = mysqli_fetch_array($meetup);
    array_push($meetup_sphere, $meetups['sphere']);
    array_push($meetup_array, $meetups);
}

if(!isset($_COOKIE["type"])) header('location: index.php');


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
                <h2>Профиль пользователя</h2>
                <?php if($is_admin): ?>
                    <p><a href="AdminPage.php">Admin</a></p>
                <?php else:?>
                    <p>Укажите наиболее достоверную информацию, чтобы мы могли оставаться на связи.</p>
                <?php endif;?>
            </div>
            <?php if($is_warned) echo '<div class="alert alert-warning text-center" role="alert"><b style="color:#856404">You are warned </b><br></div>';
            if($is_date && !$is_coming){
                echo "<form method='post' action='Server.php'> <input type='hidden' name = 'member_id' value='".$member_id."'>";
                echo '<div class="text-center" role="alert">';
                echo "<b>Сегодня meetup:</b><a  href='meetup_details.php?meetup=". $today_meetup_id."'> $today_meetup_name</a><br>";
                echo "<button type='submit' name = 'today_approve' class='btn-sm btn-success'>Приду</button>  ";
                echo "    <button type='submit' name = 'today_reject' class='btn-sm btn-danger'>Не приду</button></div></form>";
            }
            ?>
            <br>

            <div class="row" >
                <div class="col-md-5">
                    <div class="text-center">
                        <?php
                        if(!empty($image)) echo "<img class='img-fluid' id='avatar' src='../profiles/" . $image. "'>";
                        else
                            echo "<img src = '../profiles/avatar.png' id='avatar'><br>
                            У вас нет фото профиля"
                        ?>
                        <div class="form-group" style="margin-top:30px;">
                            <?php if(!empty($meetup_array)): ?>
                                <label>Meetup'ы в которых вы участвуете:</label>
                                <?php
                                foreach ($meetup_array as $row)
                                {
                                    echo "<a href='meetup_details.php?meetup=". $row['meetup_id']."'> ".$row['name']. "</a>,";
                                }
                            endif;?>
                        </div>
                        <form method="post" action="Server.php">
                            <input type="hidden" name = "newsletter" value="<?= $email ?>">
                            <input type="hidden" name = "newsletter_sphere" value="<?= $sphere ?>">
                            <input type="hidden" name = "header" value="location: user_profile.php">
                            <?php if(is_null($is_subscribed)): ?>
                                <div class="col-auto">
                                    <button type="submit" name="submit_newsletter">Подписаться на рассылку</button>
                                </div>
                            <?php else:?>
                                <input type="hidden" name="newsletter_id" value="<?= $is_subscribed['newsletter_id'] ?>">
                                <div class="col-auto">
                                    <button type="submit" name="delete_newsletter">Отписаться от рассылки</button>
                                </div>
                            <?php endif;?>
                        </form>
                    </div>
                </div>
                <div class="col-md-7" id = "height"  style="border-left:1px solid grey">
                    <div class="details" >
                        <div class="social"><h2>Профиль</h2></div>
                        <div class="form-group" >
                            <label>Имя пользователя: </label>
                            <u><?= $user_name ?></u>
                        </div>
                        <div class="form-group">
                            <label>Электронная почта: </label>
                            <u><?= $email ?></u>
                        </div>
                        <div class="form-group">
                            <label>Номер телефона: </label>
                            <u><?= $phone ?></u>
                        </div>
                        <?php if(strlen($address)): ?>
                            <div class="form-group">
                                <label>Адресс: </label>
                                <u><?= $address ?></u>
                            </div>
                        <?php endif;?>
                    </div>
                    <div style="margin: 0 0 10px 0;">
                        <button type="submit" name = "my_meetups" class = "btn" onclick="location.href='meetup_list.php?user_id=<?php echo $user_id ?>'">Мои Meetup</button>
                    </div>
                    <div style="margin: 0 0 10px 0;">
                        <button type="submit" name = "user_update" class = "btn" onclick="location.href='user_edit.php?user_edit=<?php echo $user_id ?>'">Редактировать</button>
                    </div>
                    <div style="margin: 0 0 10px 0;">
                        <button type="submit" name = "user_delete" class = "btn btn-danger" onclick="location.href='Server.php?user_delete=<?php echo $user_id ?>'">Удалить профиль</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include("footer.php");?>
</body>
</html>