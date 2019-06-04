<?php include ('login_registration.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="../img/favicon1.png" rel="icon">
  <link href="../img/apple-touch-icon1.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../lib/animate/animate.min.css" rel="stylesheet">
  <link href="../lib/venobox/venobox.css" rel="stylesheet">
  <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/sign.css" rel="stylesheet">

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
          <li class="buy-tickets"><a href="sign_in.php">Войти</a></li>
          <li class="buy-tickets"><a href="sign_up.php">Зарегистрироваться</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <main id="main" class="main-page">

    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
      <div class="container">
        <div class="section-header">
          <h2>Зарегистрироваться</h2>
          <p>Присоединяйтесь к нашему удивительному сообществу.</p>
        </div>

        <div class="row" >
          <div class="col-md-3"></div>
          <div class="col-md-6" style="height: 600px;">
            <div class="details" >
                <div class="social"></div>
                <form method="post" action="sign_up.php">
                    <?php include('Errors.php'); ?>
                    <div class="form-group" >
                        <label>Имя пользователя:</label>
                        <input class="form-control" type="text" name="user_name" value="<?php echo $user_name; ?>">
                    </div>
                    <div class="form-group">
                        <label>Электронная почта</label>
                        <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label>Пароль</label>
                        <input class="form-control" type="password" name="password_1">
                    </div>
                    <div class="form-group">
                        <label>Подтвердить пароль</label>
                        <input class="form-control" type="password" name="password_2">
                    </div>
                    <div class="form-group">
                        <label>Номер телефона</label>
                        <input class="form-control" type="text" name="phone">
                    </div>
                    <div class="text-center" style="margin:20px 0 10px 0;">
                        <button type="submit" class="btn" name="reg_user">Зарегистрироваться</button>
                    </div>
                    <p class="text-center">
                        Уже зарегистрированы? <a href="sign_in.php">Войти</a>
                    </p>
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
