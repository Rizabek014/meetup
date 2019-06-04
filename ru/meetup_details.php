<?php
$GLOBALS['filename'] = 'meetups';

include ('Database.php');
include ('nav.php');

$index = 0;
$is_member = false;
$is_organizer = false;
$members_name = array();
$members_logo = array();
$is_logged_in = isset($_COOKIE["type"]);
$flag=false;

if(isset($_GET['meetup']))
{
    $meetup_id = $_GET['meetup'];

    $rec = mysqli_query($db, "SELECT * FROM meetups WHERE meetup_id = $meetup_id" );
    $record = mysqli_fetch_array($rec);

    $name = $record['name'];
    $description = $record['description'];
    $date = $record['date'];
    $time = $record['time'];
    $location = $record['location'];
    $address = $record['address'];
    $social = $record['social'];
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
        if($user['user_id'] == $member['user_id'])
        {
            if(empty($user['logo'])) $members_logo[$index] = 'avatar.png';
            else $members_logo[$index] = $user['logo'];
            $index++;
            array_push($members_name, $user['user_name']);
        }


        if($member['user_id'] == $user_id)
        {
            $is_member = true;
            $member_id = $member['member_id'];
        }
    }
}

$social_array = explode(" ", $social);
foreach ($social_array as $socials)
    foreach ($social_array as $socials)
    {
        if(strpos($socials, 'twitter')) $twitter = $socials;
        if(strpos($socials, 'facebook')) $facebook = $socials;
        if(strpos($socials, 'google')) $google = $socials;
        if(strpos($socials, 'instagram')) $instagram = $socials;
    }

if($organizer_id == $user_id) $is_organizer = true;
?>
<main id="main" class="main-page">
    <!--==========================
      Speaker Details Section
    ============================-->
    <div id="meetup_details">
        <section id="speakers-details" class="section-with-bg wow fadeIn">
            <div class="container">
                <div class="section-header">
                    <h2><?= $name ?></h2>
                    <p><?php if(!$is_approved)echo "Ждут подтверждения"; ?></p>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <?php
                        while($row_img = mysqli_fetch_array($result_image))
                        {
                            echo "<img src = '../images/".$row_img['file_name']."' class='img-fluid'>";
                            break;
                        }
                        ?><br><br>
                        <div class="details text-center">
                            <h4 style="display:inline-block; margin-right:20px;"><?= $date.',  '. $time?></h4>
                            <div style="display:inline-block; position:relative;"  class="social">
                                <a href="<?= $twitter ?>"><i class="fa fa-twitter"></i></a>
                                <a href="<?= $facebook ?>"><i class="fa fa-facebook"></i></a>
                                <a href="<?= $google ?>"><i class="fa fa-google-plus"></i></a>
                                <a href="<?= $instagram ?>"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="details">
                            <div class="row">
                                <div class="col-md-5">
                                    <h4><b>Организатор:</b><?= " " . $organizer_name;?></h4>
                                    <h4><b>Местоположение:</b> <?= $location.', '.$address ?></h4>
                                </div>
                                <div class="col-md-7">
                                    <?php if($is_organizer || $is_admin):?>
                                        <a href="edit.php?edit=<?= $meetup_id ?>" class="edit_btn" >Редактировать</a>
                                        <a href="AdminServer.php?del=<?= $meetup_id ?>" class="del_btn">Удалить</a>
                                        <?php if($is_admin && !$is_approved): ?>
                                            <a href="AdminServer.php?approve=<?= $meetup_id ?>" class="edit_btn">Подтверждение</a>
                                        <?php endif;?>
                                        <?php if($is_admin && $is_approved): ?>
                                            <a href="AdminServer.php?disapprove=<?= $meetup_id ?>" class="edit_btn">Отклонить</a>
                                        <?php endif;?>
                                    <?php elseif ($is_member && $is_logged_in): ?>
                                        <input onclick="location.href='Server.php?unjoin=<?= $user_id ?>&unjointo=<?= $meetup_id ?>'" type="button" class="btn" value="Отписаться" style="float:right;">
                                    <?php elseif ($is_logged_in && !$is_member): ?>
                                        <input onclick="location.href='Server.php?join=<?= $user_id ?>&jointo=<?= $meetup_id ?>'" type="button" class="btn" value="Вступить" style="float:right;">
                                    <?php endif;?>
                                    <h4><b>Баллы:</b><?=" " . $points?></h4>
                                    <?php if($is_member): ?>
                                        <form action="Server.php" method="post" class="text-center">
                                            <input type = "hidden" name = "meetup_id" value = "<?php echo $meetup_id;?>">
                                            <input type = "hidden" name = "user_id" value = "<?php echo $user_id;?>">
                                            <input type = "hidden" name = "is_rated" value = "<?php echo $is_rated;?>">
                                            <h4 style="float:left;"><b>Ваша оценка:</b></h4>
                                            <input type = "range" name = "points" min = "0" max = "100">
                                            <input type = "submit" name = "submit_points" class="btn" style="float:right;">
                                        </form>
                                    <?php endif;?>
                                </div>
                            </div>

                            <h2>Описание: </h2>
                            <p><?= $description ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div id="menu"></div>
    <section id="speakers-details" class=" wow fadeIn">
        <div class="container">
            <div class="row text-center" >
                <div class="col-md-4"><button id="hidden_button" onclick="show('list_of_members')"><h4 id="1"><b>Список участников</b></h4></button></div>
                <div class="col-md-4 border-left"><button id="hidden_button" onclick="show('Gallery')"><h4 id="2"><b>Галерея</b></h4></button></div>
                <div class="col-md-4 border-left"><button id="hidden_button" onclick="show('discussion')"><h4 id="3"><b>Обсуждение</b></h4></button></div>
            </div><hr>

            <div id = "list_of_members" style="display: block" >
                <div class="text-center">
                    <div class="row">
                        <div class="col-md-3">
                            <h4><b>Орагнизатор:</b><?= " " . $organizer_name;?></h4>
                            <h4><b>Местоположение:</b> <?= $location.', '.$address ?></h4>
                        </div>
                        <div class="col-md-9">
                            <div class="list-group">
                                <?php if (count($members_name)>0)
                                {
                                    foreach ( $members_name as $logo => $names){ echo "<a class='list-group-item'><span class='pull-left'><img src = '../profiles/". $members_logo[$logo] ."' class='img-fluid' id='avatar_small'></span><b><h4 style='margin: 35px 0px 0px 100px;'>"." ".$names."</h4></b>";
                                        if($is_coming == '1') echo "<b><span class='pull-right' style='margin-top: -29px;'>Придет</span></b>";
                                        if($is_coming == '2') echo "<b><span class='pull-right' style='margin-top: -29px;'>Не придет</span></b>";
                                        }
                                }else{echo "<a href='#main' class='list-group-item'><b><h3 style='margin: 35px 0px 0px 100px;color: red;'>Вы можете стать первым участником. Не упусти свой шанс.</h3></b>";}

                                ?></a>
                                <a class='list-group-item'><b><h4></h4></b>
                                    <?php if ($is_member && $is_logged_in): ?>
                                        <input onclick="location.href='Server.php?unjoin=<?= $user_id ?>&unjointo=<?= $meetup_id ?>'" type="button" class="btn" value="Отписаться" style="float:center;">
                                    <?php elseif ($is_logged_in && !$is_member): ?>
                                        <input onclick="location.href='Server.php?join=<?= $user_id ?>&jointo=<?= $meetup_id ?>'" type="button" class="btn" value="Вступить" style="float:center;">
                                    <?php endif;?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id = "Gallery" style="display: none" >
                <!--==========================
                  Venue Section
                ============================-->
                <section id="speakers" class="  ">
                    <div class="container-fluid venue-gallery-container">
                        <div class="container">
                            <div class="section-header">
                                <h2>Галерея</h2>
                                <p>Посмотрите нашу галерею из последних событий</p>
                            </div>
                        </div>
                        <div class="row text-center">
                            <?php
                            while($row_img = mysqli_fetch_array($result_image)): ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="speaker">
                                        <a href="images/<?=$row_img['file_name']?>" class="venobox" data-gall="venue-gallery">
                                            <img src ="../images/<?=$row_img['file_name']?>"  class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                                <?php $flag=true; endwhile; if ($flag===false):

                            endif;?>
                        </div>
                    </div>
                </section>
            </div>




            <div id = "discussion" style="display: none" >
                <div id="comments">
                    <section id="speakers-details" class="section-with-bg">
                        <div  class="container-fluid">
                            <div class="section-header">
                                <h2>Комментарии</h2>
                            </div>
                            <div class="row"><div class="col-md-3"></div>
                                <div class="col-md-6 col-md-offset-2 col-sm-12">
                                    <div class="comment-wrapper">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                Панель комментариев
                                            </div>
                                            <div class="panel-body">
                                                <form method = "post" action="Server.php" style="margin: 0 auto;">
                                                    <input type = "hidden" name = "meetup_id" value="<?php echo $meetup_id;?>">
                                                    <input type = "hidden" name = "user_id" value="<?php echo $user_id;?>">                         <div class="clearfix"></div>
                                                    <textarea class="form-control" placeholder="Коментарии..." rows="3" name = "comment" id = "comment_field"></textarea>
                                                    <br><button type="submit" name = "submit_comment" class="btn btn-info pull-right">Отправить</button>            <br><br>
                                                    <hr>

                                                    <ul class="media-list">
                                                        <?php
                                                        while($row_comment = mysqli_fetch_array($result_comment))
                                                        {
                                                            foreach ($users as $user)
                                                            {
                                                                if($user['user_id'] == $row_comment['user_id'])
                                                                {
                                                                    echo "<li class='media'><span class='pull-left'><img src='../profiles/avatar.png' id='avatar_small'></span><div class='media-body' style='margin-left:15px;'><span class='text-muted pull-right'>";?><?php if($user_id == $row_comment['user_id'])
                                                                {
                                                                    echo "<input type = 'hidden' name = 'comment_id' value = '".$row_comment['comment_id']."'>";
                                                                    echo "<button type = 'submit' name = 'delete_comment' class='btn btn-danger btn-sm'>Удалить комментарий</button>";
                                                                }
                                                                    echo "
                                            </span>
                                            <strong class='text-success'>".$user['user_name'].":</strong><br><small class='text-muted'>30 min ago</small><p style='width:100%;'>".$row_comment['comment']."</p>";

                                                                }
                                                                echo "</li>";
                                                            }
                                                        }
                                                        if($is_logged_in):
                                                        ?>
                                                    </ul>

                                                    <?php endif;?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


                </div>
            </div></section>

</main>




<?php include ('footer.php'); ?>

</body>
</html>

<script>
    function edit_button() {
        var field = document.getElementById("edit_field");
        var comment = document.getElementById("comment_field");
        var edit_button = document.getElementById("edit_button");
        if (field.style.display === "none") {
            field.style.display = "block";
            comment.style.display = "none";
            edit_button.innerHTML = "cancel";
        } else {
            field.style.display = "none";
            comment.style.display = "block";
            edit_button.innerHTML = "edit";
        }
    }
    function show(elementId) {
        var field = document.getElementById(elementId);
        var lists = ['list_of_members','Gallery','discussion'];
        var list_Element = [document.getElementById(lists[0]),document.getElementById(lists[1]),document.getElementById(lists[2])]
        if(elementId===lists[0]){
            field.style.display = "block";
            document.getElementById('1').style.textDecoration = "underline";
            document.getElementById('2').style.textDecoration = "";
            document.getElementById('3').style.textDecoration = "";
            list_Element[1].style.display = "none";
            list_Element[2].style.display = "none";
        }
        if(elementId===lists[1]){
            document.getElementById('1').style.textDecoration = "";
            document.getElementById('2').style.textDecoration = "underline";
            document.getElementById('3').style.textDecoration = "";
            field.style.display = "block";
            list_Element[0].style.display = "none";
            list_Element[2].style.display = "none";
        }
        if(elementId===lists[2]){
            document.getElementById('1').style.textDecoration = "";
            document.getElementById('2').style.textDecoration = "";
            document.getElementById('3').style.textDecoration = "underline";
            field.style.display = "block";
            list_Element[0].style.display = "none";
            list_Element[1].style.display = "none";
        }
    }
</script>