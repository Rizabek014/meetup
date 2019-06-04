<?php
    $GLOBALS['filename'] = 'profile';

    include ('Server.php');
    include ('Database.php');

    $twitter = '';
    $facebook = '';
    $google = '';
    $instagram = '';

    if(isset($_COOKIE["type"]))
    {
        $user_id = $_COOKIE['type'];
        $user = mysqli_query($db, "SELECT * FROM user WHERE user_id = '$user_id'");
        $users = mysqli_fetch_array($user);
        $user_name = $users['user_name'];
        $is_admin = $users['is_admin'];
    }

    if(isset($_GET['edit']))
    {
        $meetup_id = $_GET['edit'];

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
        $meetup_id= $record['meetup_id'];
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Meetup</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/favicon1.png" rel="icon">
    <link href="img/apple-touch-icon1.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/venobox/venobox.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/sign.css" rel="stylesheet">

</head>

<body>

<!--==========================
  Header
============================-->
<header id="header" class="header-fixed">
    <div class="container">

        <div id="logo" class="pull-left">
            <h1><a href="index.php">Meet<span>UP</span></a></h1>
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li class="buy-tickets"><a href="user_details.php"><?php echo $user_name ?></a></li>
                <li class="buy-tickets"><a href="Logout.php">Выйти</a></li>
            </ul>
        </nav><!-- #nav-menu-container -->
    </div>
</header><!-- #header -->

<input type="hidden" name="organizer_id" value="<?php echo $user_id?>">
<main id="main" class="main-page">

    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
        <div class="container">
            <div class="section-header">
                <h2>Редактировать Meetup</h2>
                <p>Создайте собственное удивительное сообщество.</p>
            </div>

            <div class="row" >
                <div class="col-md-3"></div>
                <div class="col-md-6" style="height: 1150px;">
                    <div class="details" >
                        <div class="social"></div>
                        <form method="post" action = "Server.php" enctype="multipart/form-data">
                            <input type="hidden" name="meetup_id" value="<?php echo $meetup_id;?>">
                            <input type="hidden" name="organizer_id" value="<?php echo $organizer_id;?>">
                            <div class="form-group" >
                                <label>Название</label>
                                <input class="form-control" type="text" name="name" value="<?php echo $name;?>" required>
                            </div>
                            <div class="form-group">
                                <label>Описание</label>
                                <textarea class="form-control" rows="5" cols="50" name="description" required ><?php echo $description;?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Дата</label>
                                <input class="form-control" type="date" name="date" value="<?php echo $date;?>" required>
                            </div>
                            <div class="form-group">
                                <label>Время</label>
                                <input class="form-control" type="time" name="time" value="<?php echo $time;?>" required>
                            </div>
                            <div class="form-group">
                                <label>Город</label>
                                <input class="form-control" type="text" name="location" value="<?php echo $location;?>" required>
                            </div>
                            <div class="form-group">
                                <label>Адресс</label>
                                <input class="form-control" type="text" name="address" value="<?php echo $address;?>" required>
                            </div>
                            <div class="social">
                                <label>Социальные сети:</label><br>
                                <i class="fa fa-twitter" onclick="twitter()"></i>Twitter: <input type="url" name = "social[]" class="form-control" value="<?= $twitter?>">
                                <i class="fa fa-facebook" onclick="facebook()"></i>acebook: <input type="url" name = "social[]" class="form-control" value="<?= $facebook?>">
                                <i class="fa fa-google-plus" onclick="google_plus()"></i>Google Plus: <input type="url" name = "social[]" class="form-control" value="<?= $google?>">
                                <i class="fa fa-instagram" onclick="instagram()"></i>Instagram: <input type="url" name = "social[]" class="form-control" value="<?= $instagram?>">
                            </div>
                            <div class="form-group">
                                <label>Сфера</label>
                                <input class="form-control" type="text" name="sphere" value="<?php echo $sphere;?>" required>
                            </div>

                            <div class="form-group" >
                                <label>Изображение</label>
                                <input class="form-control" type="file" name="image">
                            </div>

                            <div class="text-center" style="margin:20px 0 10px 0;">
                                <button type="submit" name = "update" class = "btn">Сохранить</button>
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
<?php include ('footer.php'); ?>
</body>
</html>
