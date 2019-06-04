<?php
    include ('Server.php');
    include ('Database.php');

    if(isset($_COOKIE["type"]))
    {
        $user_id = $_COOKIE['type'];
        $user = mysqli_query($db, "SELECT * FROM user WHERE user_id = '$user_id'");
        $users = mysqli_fetch_array($user);
        $user_name = $users['user_name'];
        $is_admin = $users['is_admin'];
    }
    if(isset($_GET['next']))
        {
            $meetup_id = $_GET['next'];
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Создать Meetup</title>
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
          <li class="buy-tickets"><a href="sign_up.php">Выйти</a></li>
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
          <h2>Создать Meetup</h2>
          <p>Создай собственное удивительное сообщество.</p>
        </div>

        <div class="row" >
          <div class="col-md-3"></div>
          <div class="col-md-6" style="height: 400px;">
            <div class="details" >
                <div class="social"></div>
                <form method="post" action = "Server.php" enctype="multipart/form-data">
                    <input type = "hidden" name = "meetup_id" value="<?php echo $meetup_id ?>">
                    <input type = "hidden" name = "user_id" value="<?php echo $user_id ?>">
                    <div class="form-group" >
                        <label>Изображение</label>
                        <input class="form-control" type="file" name="files[]" multiple>
                    </div>                    
                    <div class="text-center" style="margin:20px 0 10px 0;">
                        <button type="submit" class="btn" name="save">Сохранить</button>
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
